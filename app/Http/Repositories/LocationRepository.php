<?php

namespace App\Http\Repositories;

interface LocationRepository
{
    function getAvailableLocations();
    function getLocationData($city, $countryCode);
    function getImageOfVenue($venueId);
}
