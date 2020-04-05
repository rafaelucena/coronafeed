<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class LocationNumbersController extends Controller
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
        $locationNumbers = $location->getLocationNumbers();

        return [
            'name' => $location->getName(),
            'new_cases' => $locationNumbers->getNewCases(),
            'confirmed' => $locationNumbers->getConfirmed(),
            'deaths' => $locationNumbers->getDeaths(),
            'cured' => $locationNumbers->getCured(),
            'updated' => $locationNumbers->getUpdated()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return array
     */
    public function update(Request $request, Location $location): array
    {
        $locationNumbers = $location->getLocationNumbers();

        $old = [
            'new_cases' => $locationNumbers->getNewCases(),
            'confirmed' => $locationNumbers->getConfirmed(),
            'deaths' => $locationNumbers->getDeaths(),
            'cured' => $locationNumbers->getCured(),
            'updated' => $locationNumbers->getUpdated()->format('Y-m-d H:i:s'),
        ];

        $locationNumbers->setNewCases($request->input('new_cases'));
        $locationNumbers->setConfirmed($request->input('confirmed'));
        $locationNumbers->setDeaths($request->input('deaths'));
        $locationNumbers->setCured($request->input('cured'));

        $this->em->persist($location);
        $this->em->flush();

        return [
            'name' => $location->getName(),
            'new' => [
                'new_cases' => $locationNumbers->getNewCases(),
                'confirmed' => $locationNumbers->getConfirmed(),
                'deaths' => $locationNumbers->getDeaths(),
                'cured' => $locationNumbers->getCured(),
                'updated' => $locationNumbers->getUpdated()->format('Y-m-d H:i:s'),
            ],
            'old' => $old,
        ];
    }
}
