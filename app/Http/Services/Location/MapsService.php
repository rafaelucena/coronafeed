<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;

class MapsService
{
    /** @var array **/
    private $world;

    /** @var EntityManager */
    private $em;

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->em = app('em');
        $this->setWorld($location);
    }

    /**
     * @param Location $location
     * @return void
     */
    public function setWorld(Location $location)
    {
        $locationsList = $this->em->getRepository(Location::class)->findBy(
            ['locationType' => $location->getLocationType()],
            ['name' => 'ASC']
        );

        $this->world = [];
        foreach ($locationsList as $locationItem) {
            $activeCases = $locationItem->getLocationNumbers()->getConfirmed() - $locationItem->getLocationNumbers()->getDeaths() - $locationItem->getLocationNumbers()->getCured();
            $this->world[] = [
                [
                    'v' => $locationItem->getCode(),
                    'f' => $locationItem->getName(),
                ],
                $activeCases,
                'Casos ativos: ' . $activeCases,
            ];
        }
    }

    public function getWorld()
    {
        return $this->world;
    }
}