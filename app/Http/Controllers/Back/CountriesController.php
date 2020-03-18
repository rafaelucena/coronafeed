<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Services\HomeService;

class CountriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $test = 'what now';
    }

    public function index()
    {
        // $form = new HomeService();
        return view('back.countries.index', ['form' => '']);
    }

    public function add()
    {
        // $form = new HomeService();
        return view('back.countries.add', ['form' => '']);
    }
}
