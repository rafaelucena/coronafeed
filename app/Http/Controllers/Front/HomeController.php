<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use App\Http\Services\HomeService;
use App\Http\Services\LocationService;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $test = 'what now';
    }

    public function index()
    {
        $form = new HomeService();
        return view('front.home.index', ['form' => $form]);
    }

    public function location(Location $location)
    {
        $form = new LocationService($location);
        return view('front.home.index', ['form' => $form]);
    }
}
