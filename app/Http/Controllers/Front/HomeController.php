<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class HomeController extends Controller
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
        return view('front.home.index', ['data' => []]);
    }
}
