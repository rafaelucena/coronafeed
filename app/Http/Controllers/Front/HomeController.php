<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\HomeService;

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
        $form = new HomeService();
        return view('front.home.index', ['form' => $form]);
    }
}
