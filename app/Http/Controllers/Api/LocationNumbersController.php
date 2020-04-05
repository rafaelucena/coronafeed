<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Location;
use Doctrine\ORM\EntityManager;

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
            'confirmed' => $locationNumbers->getConfirmed(),
            'deaths' => $locationNumbers->getDeaths(),
            'cured' => $locationNumbers->getCured(),
        ];
    }
}
