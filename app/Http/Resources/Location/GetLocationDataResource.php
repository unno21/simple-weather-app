<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Resources\Json\JsonResource;

class GetLocationDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'historical_sites' => VenuesDataResource::collection($this['venues']),
            'location' => [
                'name' => $this['geocode']['feature']['displayName'],
                'lat' => $this['geocode']['feature']['geometry']['center']['lat'],
                'long' => $this['geocode']['feature']['geometry']['center']['lng'],
            ]
        ];
    }
}
