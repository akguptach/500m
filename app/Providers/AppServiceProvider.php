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
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('header', \App\View\Components\layout\header::class);
        Blade::component('sidebar', \App\View\Components\layout\sidebar::class);
        Blade::component('footer', \App\View\Components\layout\footer::class);
    }
}
