<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;
use App\Http\Models\LocationType;

class MapsService
{
    private const SCALE = [
        [
            'min' => 1,
            'max' => 500,
            'assign' => 0,
        ],
        [
            'min' => 501,
            'max' => 1000,
            'assign' => 1,
        ],
        [
            'min' => 1001,
            'max' => 5000,
            'assign' => 2
        ],
        [
            'min' => 5001,
            'max' => 10000,
            'assign' => 3,
        ],
        [
            'min' => 10001,
            'max' => 50000,
            'assign' => 4,
        ],
        [
            'min' => 50001,
            'max' => 100000,
            'assign' => 5,
        ],
        [
            'min' => 100001,
            'max' => 250000,
            'assign' => 6,
        ],
        [
            'min' => 250001,
            'max' => 500000,
            'assign' => 7,
        ],
        [
            'min' => 500001,
            'max' => 1000000,
            'assign' => 8,
        ],

    ];

    /** @var array **/
    private $world;

    /** @var EntityManager */
    private $em;

    /**
     * @param Location $location
     */
    public function __construct()
    {
        $this->em = app('em');
        $this->setWorld();
    }

    /**
     * @param Location $location
     * @return void
     */
    private function setWorld(): void
    {
        $locationType = $this->em->getRepository(LocationType::class)->findOneBy([
            'slug' => 'pais',
        ]);
        $locationsList = $this->em->getRepository(Location::class)->findBy(
            ['locationType' => $locationType],
            ['name' => 'ASC']
        );

        $this->world = [];
        foreach ($locationsList as $locationItem) {
            if (empty($locationItem->getCode()) === true) {
                continue;
            }

            $this->world[] = [
                [
                    'v' => $locationItem->getCode(),
                    'f' => $locationItem->getName(),
                ],
                $this->getScale($locationItem->getLocationNumbers()->getConfirmed()),
                // $locationItem->getLocationNumbers()->getConfirmed(),
                'Casos confirmados: ' . $locationItem->getLocationNumbers()->getConfirmed(),
            ];
        }
    }

    /**
     * @param integer $value
     * @return integer
     */
    private function getScale(int $value): int
    {
        foreach (self::SCALE as $scale) {
            if ($value >= $scale['min'] && $value <= $scale['max']) {
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
        return $this->world;
    }
}