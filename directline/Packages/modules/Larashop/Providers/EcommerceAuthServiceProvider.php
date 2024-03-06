<?php

namespace Packages\Modules\Larashop\Providers;

use Packages\Modules\Larashop\Models\Product;
use Packages\Modules\Larashop\Models\SKU;
use Packages\Modules\Larashop\Policies\ProductPolicy;
use Packages\Modules\Larashop\Policies\RatingPolicy;
use Packages\Modules\Larashop\Policies\SKUPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Trexology\ReviewRateable\Models\Rating;

class LarashopAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        SKU::class => SKUPolicy::class,
        Rating::class => RatingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}