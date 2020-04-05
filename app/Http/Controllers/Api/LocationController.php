<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use Doctrine\ORM\EntityManager;

class LocationController extends Controller
{
    /** @var EntityMAnager */
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
        $old = $location->getName();

        $location->setName($request->input('name'));

        $manager = app('em');

        $manager->persist($location);
        $manager->flush();

        return [
            'new' => [
                'name' => $location->getName(),
            ],
            'old' => $old,
        ];
    }
}
