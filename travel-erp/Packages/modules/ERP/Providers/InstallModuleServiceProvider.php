<?php

namespace Packages\Modules\ERP\Providers;

use Packages\Foundation\Providers\BaseInstallModuleServiceProvider;
use Packages\Modules\ERP\database\migrations\ERPTables;
use Packages\Modules\ERP\database\migrations\AltarUsersTable;
//use Packages\Modules\ERP\database\migrations\CountriesCitiesTables;
use Packages\Modules\ERP\database\seeds\ERPDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $module_public_path = __DIR__ . '/../public';
    
    protected $migrations = [
        //CountriesCitiesTables::class,
        ERPTables::class,
        AltarUsersTable::class,
    ];

    protected function booted()
    {
        $this->createSchema();

        $erpDatabaseSeeder = new ERPDatabaseSeeder();

        $erpDatabaseSeeder->run();
    }
}
