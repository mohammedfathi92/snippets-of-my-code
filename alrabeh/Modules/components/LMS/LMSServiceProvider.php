<?php

namespace Modules\Components\LMS;

use Modules\Components\LMS\Facades\LMS;
use Modules\Components\LMS\Facades\Student;
use Modules\Components\LMS\Facades\Logs;
use Modules\Components\LMS\Facades\Coupon;
use Modules\Components\LMS\Facades\Subscriptions;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Facades\Favourite;
use Modules\Components\LMS\Facades\QuizLogs;
use Modules\Components\LMS\Providers\LMSAuthServiceProvider;
use Modules\Components\LMS\Providers\LMSObserverServiceProvider;
use Modules\Components\LMS\Providers\LMSRouteServiceProvider;
use Modules\Components\LMS\Providers\MorphMapServiceProvider;
use Modules\Components\LMS\Providers\GlobalSharedDataAuthServiceProvider;

use Modules\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LMSServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */

    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LMS');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'LMS');

        // Load migrations
//        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->registerCustomFieldsModels();


    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $helpers = \File::glob(__DIR__ . '/Helpers/*.php');

        foreach ($helpers as $helper) {
            require_once $helper;
        }
        $this->mergeConfigFrom(__DIR__ . '/config/lms.php', 'lms');

        $this->app->register(LMSRouteServiceProvider::class);
        $this->app->register(LMSAuthServiceProvider::class);
        $this->app->register(LMSObserverServiceProvider::class);
        $this->app->register(MorphMapServiceProvider::class);
        $this->app->register(GlobalSharedDataAuthServiceProvider::class);

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('LMS', LMS::class);
            $loader->alias('Student', Student::class);
            $loader->alias('Logs', Logs::class);
            $loader->alias('Subscriptions', Subscriptions::class);
            $loader->alias('Coupon', Coupon::class);
            $loader->alias('Favourite', Favourite::class);
            $loader->alias('QuizLogs', QuizLogs::class);
            
            
            
        });
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(Course::class);
    }
}
