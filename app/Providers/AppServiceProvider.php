<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->share('user', Auth::user());
        // view()->share('signedIn', Auth::check());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
