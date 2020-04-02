<?php

namespace App\Providers;

use App\Services\Cache\CacheManager;
use App\Services\Cache\CacheManagerInterface;
use App\Services\Goods\Repositories\EloquentGoodsRepository;
use App\Services\Goods\Repositories\GoodsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerBindings()
    {
        $this->app->bind(GoodsRepositoryInterface::class, EloquentGoodsRepository::class);
        $this->app->bind(CacheManagerInterface::class, CacheManager::class);
    }
}
