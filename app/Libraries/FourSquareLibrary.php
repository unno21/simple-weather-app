<?php

namespace App\Libraries;

class FourSquareLibrary
{
    private $client;

    public function __construct(ClientLibrary $client)
    {
        $this->client = $client;
    }

    public function getLocationPhoto($venueId, $params)
    {
        $url = sprintf('%s/%s/%s', config('four-square.api_url'), $venueId, 'photos');
        $response = $this->client->get($url, $params);
        $response->throw();
        $responseData = $response->json();
        $photos = $responseData['response']['photos'];
        if ($photos['count'] > 0) {
            return sprintf('%s%s%s', $photos['items'][0]['prefix'], '500x500', $photos['items'][0]['suffix']);
        }

        return '';
    }

    public function getLocationData($params)
    {
        try {

            $response = $this->client->get(config('four-square.api_url') . '/search', $params);
            $response->throw();
            $weatherData = $response->json();
            return $weatherData['response'];

        } catch (\Exception $exception) {
            report($exception);
            return [];
        }
    }

}
