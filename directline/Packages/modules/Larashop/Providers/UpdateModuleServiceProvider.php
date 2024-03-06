<?php

namespace Packages\Modules\Larashop\Providers;

use Packages\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'Packages-ecommerce';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
