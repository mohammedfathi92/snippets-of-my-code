<?php

namespace Modules\Components\CMS\Providers;

use Modules\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'corals-cms';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
