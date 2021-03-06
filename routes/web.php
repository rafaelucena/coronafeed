<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', 'Front\HomeController@index');
Route::get('/', function() {
    return Redirect::to('/pt/brasil', 302);
});

Route::get('/{locationSlug}', 'Front\HomeController@redirect');

Route::get('/{language}/{slug}', 'Front\HomeController@location');

// Route::get('admin', 'Back\DashboardController@index');

// Route::get('admin/countries', 'Back\CountriesController@index');

// Route::get('admin/countries/add', 'Back\CountriesController@add');
