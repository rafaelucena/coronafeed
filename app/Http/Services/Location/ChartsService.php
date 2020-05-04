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

    /** @var array */
    private $pieChart = [
        'active-cases' => [
            'label' => 'Casos ativos',
            'value' => 0,
        ],
        'deaths' => [
            'label' => 'Mortes',
            'value' => 0,
        ],
        'cured' => [
            'label' => 'Curados',
            'value' => 0,
        ],
    ];

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $locationNumbers = $location->getLocationNumbers();
        $locationHistoryArray = $location->getLocationHistory(0);

        $this->setLineChart($locationHistoryArray);
        $this->setPieChart($locationNumbers);
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
        foreach (array_reverse($locationHistoryArray->toArray()) as $locationHistory) {
            $this->lineChart['dates']['list'][] = $locationHistory->getDate()->format('d/m/Y');
            $this->lineChart['confirmed']['list'][] = $locationHistory->getConfirmed();
            $this->lineChart['deaths']['list'][] = $locationHistory->getDeaths();
            $this->lineChart['cured']['list'][] = $locationHistory->getCured();
        }
    }

    /**
     * @return array
     */
    public function getPieChart(): array
    {
        return $this->pieChart;
    }

    /**
     * @param LocationNumbers $locationNumbers
     * @return void
     */
    public function setPieChart(LocationNumbers $locationNumbers): void
    {
        $this->pieChart['active-cases']['value'] = $locationNumbers->getConfirmed() - $locationNumbers->getDeaths() - $locationNumbers->getCured();
        $this->pieChart['deaths']['value'] = $locationNumbers->getDeaths();
        $this->pieChart['cured']['value'] = $locationNumbers->getCured();
    }
}
