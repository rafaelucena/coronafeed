<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;
use App\Http\Models\LocationHistory;
use App\Http\Models\LocationNumbers;
use Doctrine\Common\Collections\ArrayCollection;

class ChartsService
{
    /** @var array **/
    private $lineChart = [
        'dates' => [
            'label' => 'Datas',
            'list' => [],
        ],
        'confirmed' => [
            'label' => 'Confirmados',
            'list' => [],
        ],
        'deaths' => [
            'label' => 'Mortes',
            'list' => [],
        ],
        'cured' => [
            'label' => 'Curados',
            'list' => [],
        ],
    ];

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $locationNumbers = $location->getLocationNumbers();
        $locationHistoryArray = $location->getLocationHistory();

        $this->setLineChart($locationHistoryArray);
    }

    /**
     * @return array
     */
    public function getLineChart(): array
    {
        return $this->lineChart;
    }

    /**
     * @param ArrayCollection $locationHistoryArray
     * @return void
     */
    public function setLineChart(ArrayCollection $locationHistoryArray): void
    {
        foreach ($locationHistoryArray as $locationHistory) {
            $this->lineChart['dates']['list'][] = $locationHistory->getDate()->format('Y-m-d');
            $this->lineChart['confirmed']['list'][] = $locationHistory->getConfirmed();
            $this->lineChart['deaths']['list'][] = $locationHistory->getDeaths();
            $this->lineChart['cured']['list'][] = $locationHistory->getCured();
        }
    }
}
