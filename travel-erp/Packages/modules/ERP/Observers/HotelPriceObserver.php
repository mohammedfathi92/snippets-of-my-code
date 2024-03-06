<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\HotelPrice;

class HotelPriceObserver
{

    /**
     * @param HotelPrice $erp
     */
    public function created(HotelPrice  $erp )
    {
    }
}