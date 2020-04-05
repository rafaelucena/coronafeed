<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;
use App\Http\Models\LocationHistory;

class ChartsService
{
    /** @var array **/
    private $dates;

    /** @var array **/
    private $confirmed;

    /** @var array **/
    private $deaths;

    /** @var array **/
    private $cured;

    /** @var array */
    private $days;

    public function __construct(Location $location)
    {
        $history = $location->getLocationHistory();
        // \Debugbar::info($test);
    }

    public function getDates()
    {
        return $this->dates;
    }

    public function getConfirmed()
    {
        return $this->confirmed;
    }

    public function getDeaths()
    {
        return $this->deaths;
    }

    public function getCured()
    {
        return $this->cured;
    }

    public function getDays()
    {
        return $this->days;
    }
}
