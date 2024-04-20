<?php

namespace App\Providers;

use App\Services\CarService;
use App\Services\Contracts\iCarService;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(iCarService::class, CarService::class);
    }
}
