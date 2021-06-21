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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // هنگام کار در محیط تست
        // $result = 'theme1' محیط را می گیرد و اگه محیط تست بود آنگاه مقدار تم فعال را برابر با تم 1 می گذارد یعنی
        // که برای تم فعال هست می گذارد $result میره از اولین رکورد مقدار تم را می گیرد و در متغیر  Options در غیر این صورت از جدول
        if (\App::environment('testing'))
        {
            $result = 'theme1';
        }
        else
        {
            // ها blade و گرفتن تم از اولین رکورد و قابل دسترس بودن برای تمام  Options رفتن به جدول
            $result = Options::first()->theme;
        }

        // ها قابل دسترس می کند blade را برای تمام  (activeTheme) تم فعال
        View::share('activeTheme',$result);
    }
}
