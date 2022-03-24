<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::if('admin', function() {
            return auth()->user() && auth()->user()->is_admin;
        });

        Blade::if('beekeeper', function() {
            return auth()->user() && !is_null(auth()->user()->beekeeper);
        });
    }
}
