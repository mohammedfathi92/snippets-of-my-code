<?php

namespace Modules\Components\LMS\Providers;

use Modules\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Modules\Components\LMS\database\migrations\LmsTables;
use Modules\Components\LMS\database\seeds\LMSDatabaseSeeder;


class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        LmsTables::class
    ];

    protected function booted()
    {

        $this->dropSchema();

        $lmsDatabaseSeeder = new LMSDatabaseSeeder();
        $lmsDatabaseSeeder->rollback();
    }
}
