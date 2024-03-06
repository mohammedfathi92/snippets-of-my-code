<?php

namespace Packages\Modules\Payment\Providers;

use Packages\Foundation\Providers\BaseInstallModuleServiceProvider;
use Packages\Modules\Payment\Common\database\migrations\CreateTaxablesTable;
use Packages\Modules\Payment\Common\database\seeds\PaymentDatabaseSeeder;
use Packages\Modules\Payment\database\migrations\CreateCurrencyTable;
use Packages\Modules\Payment\database\migrations\CreateGatewayStatusTable;
use Packages\Modules\Payment\database\migrations\CreateInvoicesTable;
use Packages\Modules\Payment\database\migrations\CreateWebhookCallsTable;
use Packages\Modules\Payment\Common\database\migrations\CreateTaxClassesTable;
use Packages\Modules\Payment\Common\database\migrations\CreateTaxesTable;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{

    protected $migrations = [
        CreateInvoicesTable::class,
        CreateWebhookCallsTable::class,
        CreateGatewayStatusTable::class,
        CreateTaxClassesTable::class,
        CreateTaxesTable::class,
        CreateTaxablesTable::class,
        CreateCurrencyTable::class
    ];

    protected function booted()
    {
        $this->createSchema();

        $paymentDatabaseSeeder = new PaymentDatabaseSeeder();
        $paymentDatabaseSeeder->run();
    }
}
