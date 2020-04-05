<?php

namespace App\Http\Services;

use App\Http\Models\Location;
use App\Http\Services\Location\AboutService;
use App\Http\Services\Location\ChartsService;

class LocationService
{
    public $about;

    public $charts;

    public function __construct(Location $location)
    {
        $this->about = new AboutService($location);
        $this->charts = new ChartsService($location);
    }
}