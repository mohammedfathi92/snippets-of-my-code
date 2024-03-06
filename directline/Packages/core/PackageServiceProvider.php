<?php

namespace Packages;

use Packages\Modules\ModulesServiceProvider;
use Packages\Foundation\FoundationServiceProvider;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(FoundationServiceProvider::class);

        //load modules last thing
        if (class_exists(ModulesServiceProvider::class)) {
            $this->app->register(ModulesServiceProvider::class);
        }
    }
}
