<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

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
        // تمرير إعدادات الموقع لجميع الـ views
        View::composer('*', function ($view) {
            $settings = SiteSetting::getSettings();
            $view->with([
                'siteName' => $settings->site_name,
                'siteLogo' => $settings->site_logo ? \Storage::url($settings->site_logo) : '/assets/images/logo.svg'
            ]);
        });
    }
}
