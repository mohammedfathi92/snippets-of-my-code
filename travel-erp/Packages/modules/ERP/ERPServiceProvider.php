<?php

namespace Packages\Modules\ERP;

use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Models\Category;
use Packages\Modules\ERP\Providers\ERPAuthServiceProvider;
use Packages\Modules\ERP\Providers\ERPObserverServiceProvider;
use Packages\Modules\ERP\Providers\ERPRouteServiceProvider;
use Packages\Modules\ERP\Providers\MorphMapServiceProvider;

use Packages\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ERPServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ERP');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'ERP');

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
        $this->mergeConfigFrom(__DIR__ . '/config/erp.php', 'erp');

        $this->app->register(ERPRouteServiceProvider::class);
        $this->app->register(ERPAuthServiceProvider::class);
        $this->app->register(ERPObserverServiceProvider::class);
        $this->app->register(MorphMapServiceProvider::class);

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('ERP', ERP::class);
        });
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(Category::class);
    }
}
