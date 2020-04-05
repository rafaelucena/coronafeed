<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use App\Http\Services\HomeService;
use App\Http\Services\LocationService;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class LocationNumbersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        $form = new HomeService();
        return view('front.home.index', ['form' => $form]);
    }

    public function show(Location $location)
    {
        return [
            'name' => $location->getName(),
            'confirmed' => $location->getLocationNumbers()->getConfirmed(),
            'deaths' => $location->getLocationNumbers()->getDeaths(),
            'cured' => $location->getLocationNumbers()->getCured(),
        ];
        // $form = new LocationService($location);
        // return view('front.home.index', ['form' => $form]);
    }

    public function update(Request $request, Location $location)
    {
        // private $newCases;
        // private $confirmed;
        // private $deaths;
        // private $cured;
        
        // return $request->all;
        $numbers = $location->getLocationNumbers();

        $oldData = [
            'new_cases' => $numbers->getNewCases(),
            'confirmed' => $numbers->getConfirmed(),
            'deaths' => $numbers->getDeaths(),
            'cured' => $numbers->getCured(),
        ];
        
        $numbers->setNewCases($request->input('new_cases'));
        $numbers->setConfirmed($request->input('confirmed'));
        $numbers->setDeaths($request->input('deaths'));
        $numbers->setCured($request->input('cured'));
        
        $manager = app('em');

        $manager->persist($numbers);
        $manager->flush();

        return [
            'name' => $location->getName(),
            'new' => [
                'new_cases' => $numbers->getNewCases(),
                'confirmed' => $numbers->getConfirmed(),
                'deaths' => $numbers->getDeaths(),
                'cured' => $numbers->getCured(),
            ],
            'old' => $oldData,
        ];
        // $form = new LocationService($location);
        // return view('front.home.index', ['form' => $form]);
    }
}
