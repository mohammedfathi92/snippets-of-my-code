<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\Service;

class ServiceObserver
{

    /**
     * @param Service $erp
     */
    public function created(Service $erp)
    {
    }
}