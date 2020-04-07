<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;
use LaravelDoctrine\ORM\Facades\EntityManager;

class MenuService
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
        foreach ($locationsList as $locationItem) {
            $this->list[] = [
                'id' => $locationItem->getSlug(),
                'label' => $locationItem->getName(),
            ];
        }
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }
}
