<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\TransportPrice;

class TransportPriceObserver
{

    /**
     * @param TransportPrice $erp
     */
    public function created(TransportPrice  $erp )
    {
    }
}