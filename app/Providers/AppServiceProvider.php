<?php

namespace App\Providers;

use App\Models\Options;
use Illuminate\Support\Facades\View;
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
        // هنگام کار در محیط تست
        if (\App::environment('testing'))
        {
            $result = 'theme1';
        }
        else
        {
            // 1. from options table and first record database and accessible by all blades
            $result = Options::first()->theme;
        }

        View::share('activeTheme',$result);


    }
}
