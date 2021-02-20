<?php

namespace App\Providers;

use App\Http\Repositories\LocationRepository;
use App\Http\Repositories\WeatherRepository;
use App\Models\Location;
use App\Models\Weather;
use Illuminate\Support\ServiceProvider;

class ContainerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(WeatherRepository::class, Weather::class);
        $this->app->bind(LocationRepository::class, Location::class);
    }
}
