<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use App\Http\Services\HomeService;
use App\Http\Services\LocationService;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LocationController extends Controller
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
        ];
        // $form = new LocationService($location);
        // return view('front.home.index', ['form' => $form]);
    }

    public function update(Request $request, Location $location)
    {
        // return $request->all;
        $location->setName($request->input('name'));

        $manager = app('em');

        $manager->persist($location);
        $manager->flush();

        return [
            'name' => $location->getName(),
        ];
        // $form = new LocationService($location);
        // return view('front.home.index', ['form' => $form]);
    }
}
