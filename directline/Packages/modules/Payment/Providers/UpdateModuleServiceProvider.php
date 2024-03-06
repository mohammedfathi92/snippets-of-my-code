<?php

namespace Packages\Modules\Payment\Providers;

use Packages\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'Packages-payment';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
