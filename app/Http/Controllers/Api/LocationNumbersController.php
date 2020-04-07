<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use App\Http\Models\LocationNumbers;
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
            'updated' => $locationNumbers->getUpdated()->format('d/m/Y H:i:s'),
        ];
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return array
     */
    public function update(Request $request, Location $location): array
    {
        /** @var LocationNumbers $locationNumbers */
        $locationNumbers = $location->getLocationNumbers();

        $old = [
            'new_cases' => $locationNumbers->getNewCases(),
            'confirmed' => $locationNumbers->getConfirmed(),
            'deaths' => $locationNumbers->getDeaths(),
            'cured' => $locationNumbers->getCured(),
            'updated' => $locationNumbers->getUpdated()->format('d/m/Y H:i:s'),
        ];

        $locationNumbers->setNewCases($request->input('new_cases'));
        $locationNumbers->setConfirmed($request->input('confirmed'));
        $locationNumbers->setDeaths($request->input('deaths'));
        $locationNumbers->setCured($request->input('cured'));

        $this->em->persist($locationNumbers);
        $this->em->flush();

        return [
            'name' => $location->getName(),
            'new' => [
                'new_cases' => $locationNumbers->getNewCases(),
                'confirmed' => $locationNumbers->getConfirmed(),
                'deaths' => $locationNumbers->getDeaths(),
                'cured' => $locationNumbers->getCured(),
                'updated' => $locationNumbers->getUpdated()->format('d/m/Y H:i:s'),
            ],
            'old' => $old,
        ];
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return array
     */
    public function store(Request $request, Location $location): array
    {
        $locationNumbers = new LocationNumbers();

        $locationNumbers->setNewCases($request->input('new_cases'));
        $locationNumbers->setConfirmed($request->input('confirmed'));
        $locationNumbers->setDeaths($request->input('deaths'));
        $locationNumbers->setCured($request->input('cured'));
        $locationNumbers->setLocation($location);

        $this->em->persist($locationNumbers);
        $this->em->flush();

        return [
            'name' => $location->getName(),
            'new_cases' => $locationNumbers->getNewCases(),
            'confirmed' => $locationNumbers->getConfirmed(),
            'deaths' => $locationNumbers->getDeaths(),
            'cured' => $locationNumbers->getCured(),
            'updated' => $locationNumbers->getUpdated()->format('d/m/Y H:i:s'),
        ];
    }
}
