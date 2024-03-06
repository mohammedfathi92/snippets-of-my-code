<?php

namespace Sirb\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Braintree_Configuration::environment('sandbox');
        \Braintree_Configuration::merchantId('wcjt3r2hd7zpcp2k');
        \Braintree_Configuration::publicKey('5hs7byfv9vtmnhvf');
        \Braintree_Configuration::privateKey('eae05d265c16d1343cff4fee2be58206
');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
