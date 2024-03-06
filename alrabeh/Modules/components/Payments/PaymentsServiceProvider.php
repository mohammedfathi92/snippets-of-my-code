<?php

namespace Modules\Components\Payments;

use Modules\Components\Payments\Facades\Payments;
use Modules\Components\Payments\Models\Bar;
use Modules\Components\Payments\Providers\PaymentsAuthServiceProvider;
use Modules\Components\Payments\Providers\PaymentsObserverServiceProvider;
use Modules\Components\Payments\Providers\PaymentsRouteServiceProvider;

use Modules\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class PaymentsServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Payments');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'Payments');

        // Load migrations
//        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

//        $this->registerCustomFieldsModels();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/payments.php', 'payments');

        $this->app->register(PaymentsRouteServiceProvider::class);
        $this->app->register(PaymentsAuthServiceProvider::class);
        $this->app->register(PaymentsObserverServiceProvider::class);

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Payments', Payments::class);
        });
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(Bar::class);
    }
}
