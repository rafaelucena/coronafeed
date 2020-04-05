<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use App\Http\Models\LocationType;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /** @var EntityManager */
    private $em;

    public function __construct()
    {
        $this->em = app('em');
    }

    /**
     * @param Location $location
     * @return array
     */
    public function show(Location $location): array
    {
        return [
            'name' => $location->getName(),
        ];
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return array
     */
    public function update(Request $request, Location $location): array
    {
        $old = [
            'name' => $location->getName(),
        ];

        $location->setName($request->input('name'));

        $this->em->persist($location);
        $this->em->flush();

        return [
            'new' => [
                'name' => $location->getName(),
            ],
            'old' => $old,
        ];
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return array
     */
    public function store(Request $request): array
    {
        $location = new Location();

        $locationParent = $this->em->getRepository(Location::class)->findOneBy(['slug' => $request->input('parent')]);
        $locationType = $this->em->getRepository(LocationType::class)->findOneBy(['slug' => $request->input('type')]);

        $location->setName($request->input('name'));
        $location->setParent($locationParent);
        $location->setLocationType($locationType);

        $this->em->persist($location);
        $this->em->flush();

        return [
            'name' => $location->getName(),
        ];
    }
}
