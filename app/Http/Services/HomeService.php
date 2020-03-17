<?php

namespace App\Http\Services;

use App\Http\Services\Home\AboutService;

class HomeService
{
    public $about;

    public function __construct()
    {
        $this->setUp();
    }

    public function setUp()
    {
        $this->about = new AboutService();
    }
}