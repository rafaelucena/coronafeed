<?php

namespace App\Http\Services\Location;

use App\Http\Models\Language;
use App\Http\Models\Location;
use App\Http\Models\LocationNumbers;
use App\Http\Models\LocationSlug;
use App\Http\Models\LocationType;

class MapsService
{
    private const SCALE = [
        'common' => [
            [
                'min' => 1,
                'max' => 500,
                'assign' => 1,
                'label' => '1 - 500',
            ],
            [
                'min' => 501,
                'max' => 1000,
                'assign' => 2,
                'label' => '501 - 1k',
            ],
            [
                'min' => 1001,
                'max' => 5000,
                'assign' => 3,
                'label' => '1k - 5k',
            ],
            [
                'min' => 5001,
                'max' => 10000,
                'assign' => 4,
                'label' => '5k - 10k',
            ],
            [
                'min' => 10001,
                'max' => 50000,
                'assign' => 5,
                'label' => '10k - 50k',
            ],
            [
                'min' => 50001,
                'max' => 100000,
                'assign' => 6,
                'label' => '50k - 100k',
            ],
            [
                'min' => 100001,
                'max' => 250000,
                'assign' => 7,
                'label' => '100k - 250k',
            ],
            [
                'min' => 250001,
                'max' => 500000,
                'assign' => 8,
                'label' => '250k - 500k',
            ],
            [
                'min' => 500001,
                'max' => 1000000,
                'assign' => 9,
                'label' => '500k - 1m',
            ],
            [
                'min' => 1000001,
                'max' => null,
                'assign' => 10,
                'label' => '1m+',
            ],
        ],
        'deaths' => [
            [
                'min' => 1,
                'max' => 50,
                'assign' => 1,
                'label' => '1 - 50',
            ],
            [
                'min' => 51,
                'max' => 100,
                'assign' => 2,
                'label' => '51 - 100',
            ],
            [
                'min' => 101,
                'max' => 500,
                'assign' => 3,
                'label' => '101 - 500',
            ],
            [
                'min' => 501,
                'max' => 1000,
                'assign' => 4,
                'label' => '500 - 1k',
            ],
            [
                'min' => 1001,
                'max' => 5000,
                'assign' => 5,
                'label' => '1k - 5k',
            ],
            [
                'min' => 5001,
                'max' => 10000,
                'assign' => 6,
                'label' => '5k - 10k',
            ],
            [
                'min' => 10001,
                'max' => 25000,
                'assign' => 7,
                'label' => '10k - 25k',
            ],
            [
                'min' => 25001,
                'max' => 50000,
                'assign' => 8,
                'label' => '25k - 50k',
            ],
            [
                'min' => 50001,
                'max' => 100000,
                'assign' => 9,
                'label' => '50k - 100k',
            ],
            [
                'min' => 100001,
                'max' => null,
                'assign' => 10,
                'label' => '100k+',
            ],
        ],
    ];

    /** @var array **/
    private $world;

    /** @var EntityManager */
    private $em;

    /** @var Language */
    private $language;

    /**
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->em = app('em');
        $this->language = $language;
        $this->setWorld();
    }

    /**
     * @return void
     */
    private function setWorld(): void
    {
        $locationType = $this->em->getRepository(LocationType::class)->findOneBy([
            'slug' => 'pais',
        ]);

        $qry = app('em')->createQueryBuilder();
        $qry->select('losl')
            ->from(LocationSlug::class, 'losl')
            ->join(Language::class, 'la', 'WITH', 'la = losl.language AND la = :language')
            ->join(Location::class, 'lo', 'WITH', 'lo = losl.location')
            ->where('lo.locationType = :type');

        $qry->setParameters(array(
            'language' => $this->language,
            'type' => $locationType,
        ));

        $locationSlugs = $qry->getQuery()->getResult();

        $this->world = [];
        /** @var LocationSlug */
        foreach ($locationSlugs as $locationSlug) {
            $locationItem = $locationSlug->getLocation();
            if (empty($locationItem->getCode()) === true) {
                continue;
            }

            /** @var LocationNumbers */
            $locationNumbers = $locationItem->getLocationNumbers();
            $item = [
                'location' => [
                    'v' => $locationItem->getCode(),
                    'f' => $locationSlug->getName(),
                ],
                'confirmed' => [
                    'scale' => $this->getScale($locationNumbers->getConfirmed()),
                    'value' => $locationNumbers->getConfirmed(),
                ],
                'cured' => [
                    'scale' => $this->getScale($locationNumbers->getCured()),
                    'value' => $locationNumbers->getCured(),
                ],
                'deaths' => [
                    'scale' => $this->getScale($locationNumbers->getDeaths(), 'deaths'),
                    'value' => $locationNumbers->getDeaths(),
                ],
            ];
            $this->world[] = $item;
        }
    }

    /**
     * @param integer $value
     * @return integer
     */
    private function getScale(int $value, string $type = ''): int
    {
        $scales = [];
        if (empty(self::SCALE[$type])) {
            $scales = self::SCALE['common'];
        } else {
            $scales = self::SCALE[$type];
        }

        foreach ($scales as $scale) {
            if ($value >= $scale['min'] && (empty($scale['max']) || $value <= $scale['max'])) {
                return $scale['assign'];
            }
        }

        return $scale['assign'];
    }

    /**
     * @return array
     */
    public function getScales(string $type = ''): array
    {
        if (empty($type)) {
            return self::SCALE;
        }

        if (empty(self::SCALE[$type]) === false) {
            return self::SCALE[$type];
        }

        return [];
    }

    /**
     * @return array
     */
    public function getWorld(): array
    {
        \Debugbar::info(json_encode($this->world));
        return $this->world;
    }
}