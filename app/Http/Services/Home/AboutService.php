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

    public function __construct()
    {
        $this->setUp();
    }

    public function setUp()
    {
        $this->setTitle('Rio de Janeiro');
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
}