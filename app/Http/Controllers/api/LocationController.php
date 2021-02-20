<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LocationRepository;
use App\Http\Requests\Location\GetLocationDataRequest;
use App\Http\Requests\Location\GetVenueImage;
use App\Http\Resources\Location\GetLocationDataResource;

class LocationController extends Controller
{
    private $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getLocations()
    {
        return $this->locationRepository->getAvailableLocations();
    }

    public function getLocationData(GetLocationDataRequest $request)
    {
        $city = $request->input('city');
        $countryCode = $request->input('country_code', config('four-square.country_code'));
        $locationData = $this->locationRepository->getLocationData($city, $countryCode);
        return GetLocationDataResource::make($locationData);
    }

    public function getImageOfVenue(GetVenueImage $request)
    {
        return $this->locationRepository->getImageOfVenue($request->input('venue_id'));
    }
}
