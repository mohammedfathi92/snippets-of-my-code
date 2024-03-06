<?php

namespace Modules\Components\CMS\Providers;

use Modules\Foundation\Providers\BaseInstallModuleServiceProvider;
use Modules\Components\CMS\database\migrations\AddFeaturedImageLink;
use Modules\Components\CMS\database\migrations\CmsTables;
use Modules\Components\CMS\database\seeds\CMSDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $migrations = [
        CmsTables::class,
        AddFeaturedImageLink::class
    ];

    protected function booted()
    {
        $this->createSchema();

        $cmsDatabaseSeeder = new CMSDatabaseSeeder();

        $cmsDatabaseSeeder->run();
    }
}
