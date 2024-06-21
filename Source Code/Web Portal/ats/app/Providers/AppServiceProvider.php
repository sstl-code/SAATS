<?php

namespace App\Providers;

use App\Models\SiteSettings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $data=SiteSettings::get(['setting_key','setting_value']);
      
        foreach ($data as $data1)
        {
            $data2[$data1['setting_key']]=$data1['setting_value'];
        }
        View::share('common_data', $data2);
    }
}
