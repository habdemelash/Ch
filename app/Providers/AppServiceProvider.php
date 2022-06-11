<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Config\app;
use ConsoleTVs\Charts\Registrar as Charts;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\EventsChart::class,
            \App\Charts\UsersChart::class,
            \App\Charts\HelpmesChart::class,
            \App\Charts\SiteChart::class,
            \App\Charts\NewsChart::class,
        ]);
        \Carbon\Carbon::setLocale('en');
    }
}
