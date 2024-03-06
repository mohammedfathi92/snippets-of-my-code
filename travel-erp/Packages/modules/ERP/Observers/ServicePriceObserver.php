<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\ServicePrice;

class ServicePriceObserver
{

    /**
     * @param ServicePrice $erp
     */
    public function created(ServicePrice  $erp )
    {
    }
}