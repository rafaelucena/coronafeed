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

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $locationHistoryArray = $location->getLocationHistory();
        $this->setDates($locationHistoryArray);
        $this->setConfirmed($locationHistoryArray);
        $this->setDeaths($locationHistoryArray);
        $this->setCured($locationHistoryArray);
    }

    /**
     * @return array
     */
    public function getDates(): array
    {
        return $this->dates;
    }

    /**
     * @param ArrayCollection $locationHistoryArray
     * @return void
     */
    public function setDates(ArrayCollection $locationHistoryArray): void
    {
        $this->dates = [];
        foreach ($locationHistoryArray as $locationHistory) {
            $this->dates[] = $locationHistory->getDate()->format('Y-m-d');
        }
    }

    /**
     * @return array
     */
    public function getConfirmed(): array
    {
        return $this->confirmed;
    }

    /**
     * @param ArrayCollection $locationHistoryArray
     * @return void
     */
    public function setConfirmed(ArrayCollection $locationHistoryArray): void
    {
        $this->confirmed = [];
        foreach ($locationHistoryArray as $locationHistory) {
            $this->confirmed[] = $locationHistory->getConfirmed();
        }
    }

    /**
     * @return array
     */
    public function getDeaths(): array
    {
        return $this->deaths;
    }

    /**
     * @param ArrayCollection $locationHistoryArray
     * @return void
     */
    public function setDeaths(ArrayCollection $locationHistoryArray): void
    {
        $this->deaths = [];
        foreach ($locationHistoryArray as $locationHistory) {
            $this->deaths[] = $locationHistory->getDeaths();
        }
    }

    /**
     * @return array
     */
    public function getCured(): array
    {
        return $this->cured;
    }

    /**
     * @param ArrayCollection $locationHistoryArray
     * @return void
     */
    public function setCured(ArrayCollection $locationHistoryArray): void
    {
        $this->cured = [];
        foreach ($locationHistoryArray as $locationHistory) {
            $this->cured[] = $locationHistory->getCured();
        }
    }
}
