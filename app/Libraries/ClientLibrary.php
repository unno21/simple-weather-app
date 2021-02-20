<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Http;

class ClientLibrary
{
    public function get($url, $query = [])
    {
        return Http::get($url, $query);
    }

    public function put($url, $data = [])
    {
        return Http::put($url, $data);
    }

    public function patch($url, $data = [])
    {
        return Http::patch($url, $data);
    }

    public function delete($url, $data = [])
    {
        return Http::delete($url, $data);
    }

    public function post($url, $data = [])
    {
        return Http::post($url, $data);
    }
}
