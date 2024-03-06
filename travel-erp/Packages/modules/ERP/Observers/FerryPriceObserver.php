<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\FerryPrice;

class FerryPriceObserver
{

    /**
     * @param FerryPrice $erp
     */
    public function created(FerryPrice  $erp )
    {
    }
}