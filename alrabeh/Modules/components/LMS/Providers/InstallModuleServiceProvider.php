<?php

namespace Modules\Components\LMS\Providers;

use Modules\Foundation\Providers\BaseInstallModuleServiceProvider;
use Modules\Components\LMS\database\migrations\AddFeaturedImageLink;
use Modules\Components\LMS\database\migrations\LmsTables;
use Modules\Components\LMS\database\migrations\ChatTables;
use Modules\Components\LMS\database\seeds\LMSDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $migrations = [
        LmsTables::class,
        ChatTables::class,
    ];

    protected function booted()
    {
        $this->createSchema();

        $lmsDatabaseSeeder = new LMSDatabaseSeeder();

        $lmsDatabaseSeeder->run();
    }
}
