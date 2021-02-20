<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Cache;

class CacheLibrary
{
    public function put($key, $value, $ttl = null)
    {
        if ($value !== null && $value !== []) {
            Cache::put($key, $value, $ttl ?? config('cache.ttl'));
        }
    }

    public function get($key)
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        return null;
    }

    public function has($key)
    {
        return Cache::has($key);
    }

    public function forget($key)
    {
        Cache::forget($key);
    }
}
