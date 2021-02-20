<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\WeatherForecastController;
use App\Http\Controllers\api\LocationController;

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

Route::group(['prefix' => 'weather'], function (){
    Route::get('current', [WeatherForecastController::class, 'getCurrentForecast']);
    Route::get('five-days', [WeatherForecastController::class, 'getFiveDayForecast']);
});

Route::group(['prefix' => 'locations'], function (){
    Route::get('/', [LocationController::class, 'getLocations']);
    Route::get('/data', [LocationController::class, 'getLocationData']);
    Route::get('/image', [LocationController::class, 'getImageOfVenue']);
});

