<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;
use App\Http\Models\LocationHistory;
use Doctrine\Common\Collections\ArrayCollection;

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
        $locationHistoryArray = $location->getLocationHistory();
        $this->setDates($locationHistoryArray);
        $this->setConfirmed($locationHistoryArray);
        $this->setDeaths($locationHistoryArray);

        // \Debugbar::info($this);
    }

    public function getDates()
    {
        return $this->dates;
    }

    public function setDates(ArrayCollection $locationHistoryArray)
    {
        $this->dates = [];
        foreach ($locationHistoryArray as $locationHistory) {
            $this->dates[] = $locationHistory->getDate()->format('Y-m-d');
        }
    }

    public function getConfirmed()
    {
        return $this->confirmed;
    }

    public function setConfirmed(ArrayCollection $locationHistoryArray)
    {
        $this->confirmed = [];
        foreach ($locationHistoryArray as $locationHistory) {
            $this->confirmed[] = $locationHistory->getConfirmed();
        }
    }

    public function getDeaths()
    {
        return $this->deaths;
    }

    public function setDeaths(ArrayCollection $locationHistoryArray)
    {
        $this->deaths = [];
        foreach ($locationHistoryArray as $locationHistory) {
            $this->deaths[] = $locationHistory->getDeaths();
        }
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
