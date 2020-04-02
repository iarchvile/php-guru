<?php

namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;

class CacheManager implements CacheManagerInterface
{

    /**
     * @inheritDoc
     */
    public function publicCacheKey(?string $route = null) :string
    {
        return md5(request()->fullUrl());
    }

    /**
     * @inheritDoc
     */
    public function clearKey(string $key) :bool
    {
        return Cache::forget($key);
    }

    /**
     * @inheritDoc
     */
    public function flushTags($tags) :void
    {
        Cache::tags($tags)->flush();
    }


}
