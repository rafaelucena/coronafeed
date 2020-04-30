<?php

namespace App\Http\Services;

use App\Http\Models\Language;
use App\Http\Models\Location;
use App\Http\Models\LocationSlug;
use App\Http\Services\Location\AboutService;
use App\Http\Services\Location\ChartsService;
use App\Http\Services\Location\MapsService;
use App\Http\Services\Location\MenuService;
use App\Http\Services\Location\ViewService;

class LocationService
{
    public $menu;

    public $about;

    public $charts;

    public $maps;

    public function __construct(LocationSlug $locationSlug)
    {
        /** @var Location */
        $location = $locationSlug->getLocation();
        /** @var Language */
        $language = $locationSlug->getLanguage();

        $this->view = new ViewService($language);
        $this->menu = new MenuService($language);
        $this->about = new AboutService($locationSlug);
        $this->charts = new ChartsService($location);
        $this->maps = new MapsService($language);
    }
}