<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //for global interface segregation
        $this->app->bind('App\Interfaces\HttpStatusCodeInterface', 'App\Helpers\HttpStatusCode');
        $this->app->bind('App\Interfaces\LogSystemInterface', 'App\Helpers\LogSystemHelper');
        $this->app->bind('App\Interfaces\UtilityInterface', 'App\Helpers\UtilityHelper');
        $this->app->bind('App\Interfaces\HttpResponseHelperInterface', 'App\Helpers\HttpResponseHelper');     
    }
}
