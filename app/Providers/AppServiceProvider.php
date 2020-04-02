<?php

namespace App\Providers;

use App\Services\Commands\Games\Hangman\Repositories\ConsoleHangmanRepository;
use App\Services\Commands\Games\Hangman\Repositories\ConsoleHangmanRepositoryInterface;
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
        $this->app->bind(ConsoleHangmanRepositoryInterface::class, ConsoleHangmanRepository::class);
    }
}
