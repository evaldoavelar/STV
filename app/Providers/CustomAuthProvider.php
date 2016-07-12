<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Auth\CustomUserProvider;

class CustomAuthProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->extend('custom',function()
        {

            return new CustomUserProvider();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}
