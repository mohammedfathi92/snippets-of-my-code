<?php

namespace Packages\Modules\ERP\Providers;

use Packages\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Packages\Modules\ERP\database\migrations\ERPTables;
//use Packages\Modules\ERP\database\migrations\CountriesCitiesTables;
use Packages\Modules\ERP\database\seeds\ERPDatabaseSeeder;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        ERPTables::class,
       // CountriesCitiesTables::class
    ];

    protected function booted()
    {
        $this->dropSchema();

        $erpDatabaseSeeder = new ERPDatabaseSeeder();
        
        $erpDatabaseSeeder->rollback();
    }
}
