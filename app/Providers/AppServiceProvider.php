<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('fluxStyles', function () {
            return '<link rel="stylesheet" href="' . asset('css/flux.css') . '">';
        });

        Blade::directive('fluxScripts', function () {
            return '<script src="' . asset('js/flux.js') . '"></script>';
        });
    }
}
