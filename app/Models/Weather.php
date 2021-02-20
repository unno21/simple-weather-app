<?php

namespace App\Models;

use App\Http\Repositories\WeatherRepository;
use App\Libraries\CacheLibrary;
use App\Libraries\ClientLibrary;
use Carbon\Carbon;

class Weather implements WeatherRepository
{
    private $client;

    private $cacheLibrary;

    private $carbon;

    public function __construct(ClientLibrary $client, CacheLibrary $cacheLibrary, Carbon $carbon)
    {
        $this->client = $client;
        $this->cacheLibrary = $cacheLibrary;
        $this->carbon =$carbon;
    }

    public function currentForecast($city, $countryCode)
    {
        $fiveDayForecastData = $this->fiveDayForecast($city, $countryCode);

        if (count($fiveDayForecastData) > 0) {
            $firstForecast = array_shift($fiveDayForecastData);
            $currentForecast = $firstForecast;
            $now = $this->carbon->now();

            foreach ($fiveDayForecastData as $forecast) {

                if ($now->greaterThanOrEqualTo($this->carbon->parse($currentForecast['dt_txt'])) &&
                    $now->lessThanOrEqualTo($this->carbon->parse($forecast['dt_txt']))) {

                    return $currentForecast;

                }

                $currentForecast = $forecast;

            }

            return $firstForecast;
        }

        return [];

    }

    public function fiveDayForecast($city, $countryCode)
    {
        try {

            $cacheKey = sprintf('weather-%s-%s', $city, $countryCode);
            if (!$this->cacheLibrary->has($cacheKey)) {
                $query = $this->getQueryData(['q' => sprintf('%s,%s', $city, $countryCode)]);
                $response = $this->client->get(config('weather.api_url'), $query);
                $response->throw();
                $weatherData = $response->json();
                $this->cacheLibrary->put($cacheKey, $weatherData['list']);
                return $weatherData['list'];
            }

            return $this->cacheLibrary->get($cacheKey);

        } catch (\Exception $exception) {
            report($exception);
            return [];
        }

    }

    private function getQueryData($additionalQueries = [])
    {
        return array_merge(
            ['APPID' => config('weather.api_key')],
            $additionalQueries
        );
    }
}
