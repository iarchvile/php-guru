<?php

namespace App\Listeners;

use App\Models\Goods;
use App\Services\Cache\CacheManagerInterface;
use App\Services\Cache\CacheTags;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearGoodsCache
{
    /**
     * @var CacheManagerInterface
     */
    private CacheManagerInterface $cacheManager;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CacheManagerInterface $cacheManager)
    {
        //
        $this->cacheManager = $cacheManager;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @return void
     */
    public function handle($event)
    {
        $this->cacheManager->flushTags([CacheTags::INDEX, CacheTags::SHOW]);
    }
}
