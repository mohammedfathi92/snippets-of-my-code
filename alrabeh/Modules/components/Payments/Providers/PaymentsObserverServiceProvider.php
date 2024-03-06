<?php

namespace Modules\Components\Payments\Providers;

use Modules\Components\Payments\Models\Bar;
use Modules\Components\Payments\Observers\BarObserver;
use Illuminate\Support\ServiceProvider;

class PaymentsObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {

        Bar::observe(BarObserver::class);
    }
}
