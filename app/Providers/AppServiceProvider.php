<?php

namespace App\Providers;

use App\Http\Controllers\Auth\MailruController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\VkController;
use App\Http\Controllers\Auth\YandexController;
use App\Services\OAuth\OAuthService;
use App\Services\OAuth\Repositories\MailruOAuthRepository;
use App\Services\OAuth\Repositories\OAuthRepositoryInterface;
use App\Services\OAuth\Repositories\VkOAuthRepository;
use App\Services\OAuth\Repositories\YandexOAuthRepository;
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
        $this->app
            ->when(YandexController::class)
            ->needs(OAuthRepositoryInterface::class)
            ->give(YandexOAuthRepository::class);

        $this->app
            ->when(MailruController::class)
            ->needs(OAuthRepositoryInterface::class)
            ->give(MailruOAuthRepository::class);

        $this->app
            ->when(VkController::class)
            ->needs(OAuthRepositoryInterface::class)
            ->give(VkOAuthRepository::class);
    }
}
