<?php

namespace Packages\Modules\Larashop\Providers;

use Packages\Modules\Larashop\Models\Product;
use Packages\Modules\Larashop\Models\SKU;
use Packages\Modules\Larashop\Observers\ProductObserver;
use Packages\Modules\Larashop\Observers\SKUObserver;
use Illuminate\Support\ServiceProvider;

class LarashopObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        SKU::observe(SKUObserver::class);
    }
}