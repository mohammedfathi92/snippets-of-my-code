<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\FlightPrice;

class FlightPriceObserver
{

    /**
     * @param FlightPrice $erp
     */
    public function created(FlightPrice  $erp )
    {
    }
}