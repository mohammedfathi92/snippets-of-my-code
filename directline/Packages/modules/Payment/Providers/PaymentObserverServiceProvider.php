<?php

namespace Packages\Modules\Payment\Providers;

use Packages\Modules\Payment\Models\Invoice;
use Packages\Modules\Payment\Policies\InvoicePolicy;
use Illuminate\Support\ServiceProvider;

class PaymentObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {

        Invoice::observe(InvoicePolicy::class);
    }
}