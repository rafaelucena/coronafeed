<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use Doctrine\ORM\EntityManager;

class LocationController extends Controller
{
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
}
