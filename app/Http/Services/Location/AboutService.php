<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;
use App\Http\Models\LocationNumbers;

class AboutService
{
    /** @var string **/
    private $title;

    /** @var string **/
    private $description;

    /** @var string **/
    private $button;

    /** @var array **/
    private $counters;

    /** @var array **/
    private $estimations;

    /** @var string **/
    private $updated;

    public function __construct(Location $location)
    {
        $this->setTitle($location->getName());
        $this->setCounters($location->getLocationNumbers());
        $this->setEstimations($location->getLocationNumbers());
        $this->setUpdated($location->getLocationNumbers()->getUpdated());
        $this->setUp();
    }

    public function setUp()
    {
        $this->setDescription('Uma das primeiras cidades brasileiras a ter o vírus detectado');
        $this->setButton('Assine nossas notícias!');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getButton()
    {
        return $this->button;
    }

    public function setButton(string $button)
    {
        $this->button = $button;
    }

    public function getCounters()
    {
        return $this->counters;
    }

    public function setCounters(LocationNumbers $locationNumbers)
    {
        $counters = [
            'new-cases' => [
                'count' => $locationNumbers->getNewCases(),
                'label' => 'Novos casos',
            ],
            'confirmed' => [
                'count' => $locationNumbers->getConfirmed(),
                'label' => 'Confirmados',
            ],
            'deaths' => [
                'count' => $locationNumbers->getDeaths(),
                'label' => 'Mortos',
            ],
            'cured' => [
                'count' => $locationNumbers->getCured(),
                'label' => 'Curados',
            ],
        ];
        $this->counters = $counters;
    }

    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated->format('Y-m-d H:i:s');
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getEstimations()
    {
        return $this->estimations;
    }

    public function setEstimations(LocationNumbers $locationNumbers)
    {
        $total = $locationNumbers->getConfirmed();
        $cured = round(($locationNumbers->getCured() / $total) * 100, 0);
        $deaths = round(($locationNumbers->getDeaths() / $total) * 100, 0);
        $stillContaminated = 100 - $cured - $deaths;

        $estimations = [
            'infected' => [
                'average' => $stillContaminated,
                'label' => 'Infectados',
            ],
            'deaths' => [
                'average' => $deaths,
                'label' => 'Mortos',
            ],
            'cured' => [
                'average' => $cured,
                'label' => 'Curados',
            ],
        ];
        $this->estimations = $estimations;
    }
}
