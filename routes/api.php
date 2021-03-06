<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/local', 'Api\LocationController@store');

Route::get('/local/{location}', 'Api\LocationController@show');

// Route::put('/local/{location}', 'Api\LocationController@update');

// Route::post('/local/{location}/numbers', 'Api\LocationNumbersController@store');

Route::get('/local/{location}/numbers', 'Api\LocationNumbersController@show');

// Route::put('/local/{location}/numbers', 'Api\LocationNumbersController@update');
