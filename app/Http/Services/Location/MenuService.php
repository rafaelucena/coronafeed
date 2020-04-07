<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;
use LaravelDoctrine\ORM\Facades\EntityManager;

class MenuService
{
    /** @var array **/
    private $list;

    private $em;

    public function __construct(Location $location)
    {
        $this->em = app('em');
        $this->setList($location);
    }

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
        \Debugbar::info($this->list);
    }
}
