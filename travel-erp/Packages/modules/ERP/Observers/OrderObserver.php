<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\Order;

class OrderObserver
{

    /**
     * @param Order $erp
     */
    public function created(Order $erp)
    {
    }
}