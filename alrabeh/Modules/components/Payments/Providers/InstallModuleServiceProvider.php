<?php

namespace Modules\Components\Payments\Providers;

use Modules\Foundation\Providers\BaseInstallModuleServiceProvider;
use Modules\Components\Payments\database\migrations\PaymentsTables;
use Modules\Components\Payments\database\seeds\PaymentsDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $module_public_path = __DIR__ . '/../public';

    protected $migrations = [
        PaymentsTables::class
    ];

    protected function booted()
    {
        $this->createSchema();

        $paymentsDatabaseSeeder = new PaymentsDatabaseSeeder();

        $paymentsDatabaseSeeder->run();
    }
}
