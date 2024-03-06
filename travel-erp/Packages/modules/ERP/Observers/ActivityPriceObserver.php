<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\ActivityPrice;

class ActivityPriceObserver
{

    /**
     * @param ActivityPrice $erp
     */
    public function created(ActivityPrice $erp)
    {
    }
}