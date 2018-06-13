<?php

namespace App\Modules\Registration\Profile\Providers;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        //helpers
        $this->app->bind('App\Modules\Registration\Profile\Interfaces\RequestParserInterface', 'App\Modules\Registration\Profile\Helpers\RequestParser');
        $this->app->bind('App\Modules\Registration\Profile\Interfaces\ResponseParserInterface', 'App\Modules\Registration\Profile\Helpers\ResponseParser');
        $this->app->bind('App\Modules\Registration\Profile\Interfaces\ProfileHelperInterface', 'App\Modules\Registration\Profile\Helpers\ProfileHelper');
    
        //services
        $this->app->bind('App\Modules\Registration\Profile\Interfaces\ProfileServiceInterface', 'App\Modules\Registration\Profile\Services\ProfileService');
    
        //repositories
        $this->app->bind('App\Modules\Registration\Profile\Interfaces\ProfileRepositoryInterface', 'App\Modules\Registration\Profile\Repositories\ProfileRepository');
    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
