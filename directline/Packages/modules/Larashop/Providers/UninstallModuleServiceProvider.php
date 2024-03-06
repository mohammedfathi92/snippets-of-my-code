<?php

namespace Packages\Modules\Larashop\Providers;

use Packages\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Packages\Modules\Larashop\database\migrations\CreateLarashopTable;
use Packages\Modules\Larashop\database\migrations\CreateOrdersTable;
use Packages\Modules\Larashop\database\migrations\CreateRatingsTable;

use Packages\Modules\Larashop\database\migrations\CreateWishlistsTable;
use Packages\Modules\Larashop\database\seeds\LarashopDatabaseSeeder;
use Spatie\MediaLibrary\Media;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        CreateRatingsTable::class,
        CreateLarashopTable::class,
        CreateOrdersTable::class,
        CreateWishlistsTable::class,
    ];

    protected function booted()
    {
        $this->dropSchema();
        $ecommerceDatabaseSeeder = new LarashopDatabaseSeeder();
        $ecommerceDatabaseSeeder->rollback();

        Media::whereIn('collection_name',
            ['ecommerce-category-thumbnail', 'ecommerce-brand-thumbnail', 'ecommerce-product-gallery', 'ecommerce-sku-image'])->delete();
    }
}
