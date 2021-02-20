<?php

namespace App\Models;


use App\Http\Repositories\LocationRepository;
use App\Libraries\CacheLibrary;
use App\Libraries\FourSquareLibrary;

class Location implements LocationRepository
{
    private $cacheLibrary;

    private $fourSquareLibrary;

    public function __construct(CacheLibrary $cacheLibrary, FourSquareLibrary $fourSquareLibrary)
    {
        $this->cacheLibrary = $cacheLibrary;
        $this->fourSquareLibrary = $fourSquareLibrary;
    }

    public function getAvailableLocations()
    {
        return [
            'cities' => explode(',', config('four-square.cities')),
            'country_code' => config('four-square.country_code'),
        ];
    }

    public function getLocationData($city, $countryCode)
    {
        $cacheKey = sprintf('location-%s-%s', $city, $countryCode);
        if (!$this->cacheLibrary->has($cacheKey)) {
            $params = $this->getQueryData(['near' => sprintf('%s,%s', $city, $countryCode)]);
            $response = $this->fourSquareLibrary->getLocationData($params);
            $this->cacheLibrary->put($cacheKey, $response);
            return $response;
        }

        return $this->cacheLibrary->get($cacheKey);
    }

    private function getQueryData($additionalQueries = [])
    {
        return array_merge(
            [
                'v' => config('four-square.version'),
                'client_id' => config('four-square.client_id'),
                'client_secret' => config('four-square.client_secret'),
                'categoryId' => config('four-square.category_id'),
            ],
            $additionalQueries
        );
    }

    public function getImageOfVenue($venueId)
    {
        $cacheKey = sprintf('image-%s', $venueId);
        if (!$this->cacheLibrary->has($cacheKey)) {
            $image = $this->fourSquareLibrary->getLocationPhoto($venueId, $this->getQueryData());
            $this->cacheLibrary->put($cacheKey, $image);
        }

        return $this->cacheLibrary->get($cacheKey);
    }
}
