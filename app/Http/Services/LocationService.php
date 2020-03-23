<?php

namespace App\Http\Services;

use App\Http\Models\Location;
use App\Http\Services\Location\AboutService;

class LocationService
{
    public $about;

    public function __construct(Location $location)
    {
        $this->about = new AboutService($location);
    }
}