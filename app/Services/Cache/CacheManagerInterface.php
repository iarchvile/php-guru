<?php

namespace App\Services\Cache;


interface CacheManagerInterface
{
    /**
     * @param  string|null  $route
     *
     * @return string
     */
    public function publicCacheKey(?string $route = null) :string;

    /**
     * @param  string  $key
     *
     * @return bool
     */
    public function clearKey(string $key) :bool;

    /**
     * @param $tags
     */
    public function flushTags($tags) :void;
}
