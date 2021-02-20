<?php

namespace App\Http\Resources\Weather;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GetWeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = Carbon::parse($this['dt_txt']);
        return [
            'temperature' => [
                'kelvin' => $this['main']['temp'],
                'celsius' => round($this['main']['temp'] - 273.15, 2),
                'fahrenheit' => round(($this['main']['temp'] - 273.15) * (9/5 + 32), 2),
            ],
            'weather' => [
                'name' => $this['weather'][0]['main'],
                'description' => $this['weather'][0]['description'],
                'icon' => config('weather.icon_url') . $this['weather'][0]['icon'] . '.png',
            ],
            'wind' => [
                'speed' => $this['wind']['speed'],
                'degree' => $this['wind']['deg'],
            ],
            'date' => [
                'text' => $date->format('Y-m-d'),
                'day' => substr($date->format('l'), 0, 3),
                'time' => $date->format('h:i A'),
            ],
        ];
    }
}
