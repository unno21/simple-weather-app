<?php

namespace App\Http\Repositories;

interface WeatherRepository
{
    function currentForecast($city, $countryCode);
    function fiveDayForecast($city, $countryCode);
}
