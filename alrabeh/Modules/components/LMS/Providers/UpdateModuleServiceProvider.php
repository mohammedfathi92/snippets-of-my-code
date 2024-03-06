<?php

namespace Modules\Components\LMS\Providers;

use Modules\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'developnet-lms';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
