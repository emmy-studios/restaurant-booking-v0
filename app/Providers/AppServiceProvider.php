<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\System\Setting;

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
        // Language Provider
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['es','en']);
        });

        // Dynamic Timezone Settings
        //$timezone = Setting::query()->value('timezone') ?: 'America/Costa_Rica'; // By Default Costa Rica
        //config(['app.timezone' => $timezone]);
        //date_default_timezone_set($timezone);
        //Carbon::setLocale(app()->getLocale());
    }
}
