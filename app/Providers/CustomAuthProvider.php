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
      /*  $this->app['auth']->extend('custom',function()
        {

            return new CustomUserProvider();
        });*/

        \Auth::provider('custom', function($app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new CustomUserProvider($app);
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
