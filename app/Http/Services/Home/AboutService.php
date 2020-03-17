<?php

namespace App\Http\Services\Home;

class AboutService
{
    private $title;

    public function __construct()
    {
        $this->setUp();
    }

    public function setUp()
    {
        $this->setTitle('Rio de Janeiro');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}