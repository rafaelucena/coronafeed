<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Services\HomeService;

class DashboardController extends Controller
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
        return view('back.index', ['form' => '']);
    }
}
