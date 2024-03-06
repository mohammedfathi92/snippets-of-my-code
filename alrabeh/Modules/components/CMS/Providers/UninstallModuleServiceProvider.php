<?php

namespace Modules\Components\CMS\Providers;

use Modules\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Modules\Components\CMS\database\migrations\CmsTables;
use Modules\Components\CMS\database\seeds\CMSDatabaseSeeder;
use Modules\Settings\Models\Module;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        CmsTables::class
    ];

    protected function booted()
    {
        $module = Module::where('code', 'corals-cms-slider')->first();
        if ($module && $module->installed) {
            \Modules::uninstall($module);
        }

        $this->dropSchema();

        $cmsDatabaseSeeder = new CMSDatabaseSeeder();
        $cmsDatabaseSeeder->rollback();
    }
}
