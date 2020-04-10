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
            $this->world[] = [
                $locationItem->getCode(),
                $locationItem->getLocationNumbers()->getConfirmed(),
            ];
        }
    }

    public function getWorld()
    {
        return $this->world;
    }
}