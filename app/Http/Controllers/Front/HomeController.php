<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Language;
use App\Http\Models\Location;
use App\Http\Models\LocationSlug;
use App\Http\Services\HomeService;
use App\Http\Services\LocationService;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $form = new HomeService();
        return view('front.home.index', ['form' => $form]);
    }

    public function location(Location $location)
    {
        $language = app('em')->getRepository(Language::class)->findOneBy(['slug' => 'portugues']);
        $form = new LocationService($location, $language);
        return view('front.home.index', ['form' => $form]);
    }

    public function locationTest(LocationSlug $locationSlug)
    {
        $location = $locationSlug->getLocation();
        $language = $locationSlug->getLanguage();

        $form = new LocationService($location, $language);
        return view('front.home.index', ['form' => $form]);
    }
}
