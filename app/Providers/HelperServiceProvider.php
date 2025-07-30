<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utils\TimeZoneHelper;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Register global helper functions
        if (!function_exists('jakartaTime')) {
            function jakartaTime($datetime = null, $format = 'd/m/Y H:i')
            {
                if ($datetime === null) {
                    return TimeZoneHelper::now()->format($format);
                }
                return TimeZoneHelper::formatJakarta($datetime, $format);
            }
        }

        if (!function_exists('jakartaNow')) {
            function jakartaNow()
            {
                return TimeZoneHelper::now();
            }
        }

        if (!function_exists('timeAgo')) {
            function timeAgo($datetime)
            {
                return TimeZoneHelper::diffForHumans($datetime);
            }
        }
    }
}
