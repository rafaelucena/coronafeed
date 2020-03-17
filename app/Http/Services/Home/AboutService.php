<?php

namespace App\Http\Services\Home;

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

    public function __construct()
    {
        $this->setUp();
    }

    public function setUp()
    {
        $this->setTitle('Rio de Janeiro');
        $this->setDescription('Uma das primeiras cidades brasileiras a ter o vírus detectado');
        $this->setButton('Assine nossas notícias!');
        $this->setCounters([
            'suspected' => [
                'count' => 3562,
                'label' => 'Suspeitos',
            ],
            'confirmed' => [
                'count' => 1243,
                'label' => 'Confirmados',
            ],
            'deaths' => [
                'count' => 57,
                'label' => 'Mortos',
            ],
            'cured' => [
                'count' => 386,
                'label' => 'Curados',
            ],
        ]);
        $this->setEstimations([
            'confirmed' => [
                'average' => 56,
                'label' => 'Confirmados',
            ],
            'deaths' => [
                'average' => 31,
                'label' => 'Mortos',
            ],
            'cured' => [
                'average' => 70,
                'label' => 'Curados',
            ],
        ]);
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

    public function setCounters(array $counters)
    {
        $this->counters = $counters;
    }

    public function getEstimations()
    {
        return $this->estimations;
    }

    public function setEstimations(array $estimations)
    {
        $this->estimations = $estimations;
    }
}