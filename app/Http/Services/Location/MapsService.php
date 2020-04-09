<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;

class MapsService
{
    /** @var array **/
    private $list;

    /** @var EntityManager */
    private $em;

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->em = app('em');
        $this->setList($location);
    }

    /**
     * @param Location $location
     * @return void
     */
    public function setList(Location $location)
    {
        $locationsList = $this->em->getRepository(Location::class)->findBy(
            ['locationType' => $location->getLocationType()],
            ['name' => 'ASC']
        );

        $this->list = [];
        $this->list[] = [
            'Country',
            'Numero de casos',
        ];
        foreach ($locationsList as $locationItem) {
            $this->list[] = [
                $locationItem->getCode(),
                $locationItem->getLocationNumbers()->getConfirmed(),
            ];
        }
    }

    public function getList()
    {
        return $this->list;
    }
}