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
        [
            'min' => 1,
            'max' => 500,
            'assign' => 1,
        ],
        [
            'min' => 501,
            'max' => 1000,
            'assign' => 2,
        ],
        [
            'min' => 1001,
            'max' => 5000,
            'assign' => 3
        ],
        [
            'min' => 5001,
            'max' => 10000,
            'assign' => 4,
        ],
        [
            'min' => 10001,
            'max' => 50000,
            'assign' => 5,
        ],
        [
            'min' => 50001,
            'max' => 100000,
            'assign' => 6,
        ],
        [
            'min' => 100001,
            'max' => 250000,
            'assign' => 7,
        ],
        [
            'min' => 250001,
            'max' => 500000,
            'assign' => 8,
        ],
        [
            'min' => 500001,
            'max' => 1000000,
            'assign' => 9,
        ],
        [
            'min' => 1000001,
            'max' => null,
            'assign' => 10,
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
                    'scale' => $this->getScale($locationNumbers->getDeaths()),
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
    private function getScale(int $value): int
    {
        foreach (self::SCALE as $scale) {
            if ($value >= $scale['min'] && (empty($scale['max']) || $value <= $scale['max'])) {
                return $scale['assign'];
            }
        }

        return $scale['assign'];
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