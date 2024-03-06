<?php

namespace Packages\Modules\Larashop\Providers;

use Packages\Foundation\Providers\BaseInstallModuleServiceProvider;
use Packages\Modules\Larashop\database\migrations\CreateLarashopTable;
use Packages\Modules\Larashop\database\migrations\CreateOrdersTable;
use Packages\Modules\Larashop\database\migrations\CreateRatingsTable;
use Packages\Modules\Larashop\database\migrations\CreateWishlistsTable;
use Packages\Modules\Larashop\database\seeds\LarashopDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $migrations = [
        CreateRatingsTable::class,
        CreateLarashopTable::class,
        CreateOrdersTable::class,
        CreateWishlistsTable::class,
    ];

    protected $module_public_path = __DIR__ . '/../public';

    protected function booted()
    {
        $this->createSchema();

        $ecommerceSeeder = new LarashopDatabaseSeeder();
        $ecommerceSeeder->run();
    }
}
