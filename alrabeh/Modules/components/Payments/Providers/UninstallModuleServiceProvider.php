<?php

namespace Modules\Components\Payments\Providers;

use Modules\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Modules\Components\Payments\database\migrations\PaymentsTables;
use Modules\Components\Payments\database\seeds\PaymentsDatabaseSeeder;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        PaymentsTables::class
    ];

    protected function booted()
    {
        $this->dropSchema();

        $paymentsDatabaseSeeder = new PaymentsDatabaseSeeder();

        $paymentsDatabaseSeeder->rollback();
    }
}
