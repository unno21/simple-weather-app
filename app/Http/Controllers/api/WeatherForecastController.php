<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\WeatherRepository;
use App\Http\Requests\Weather\GetWeatherRequest;
use App\Http\Resources\Weather\GetWeatherResource;

class WeatherForecastController extends Controller
{
    private $weatherRepository;

    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    public function getCurrentForecast(GetWeatherRequest $request)
    {
        $city = $request->input('city');
        $countryCode = $request->input('country_code');
        $currentForecast = $this->weatherRepository->currentForecast($city, $countryCode);
        return GetWeatherResource::make($currentForecast);
    }

    public function getFiveDayForecast(GetWeatherRequest $request)
    {
        $city = $request->input('city');
        $countryCode = $request->input('country_code');
        $fiveDayForecast = $this->weatherRepository->fiveDayForecast($city, $countryCode);
        return GetWeatherResource::collection($fiveDayForecast);
    }
}
