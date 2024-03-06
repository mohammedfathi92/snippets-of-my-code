<?php

namespace Packages\Modules\Payment\Cash\Providers;

use Packages\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'Packages-payment-cash';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
