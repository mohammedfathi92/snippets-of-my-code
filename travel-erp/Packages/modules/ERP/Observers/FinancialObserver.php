<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\Financial;

class FinancialObserver
{

    /**
     * @param Financial $erp
     */
    public function created(Financial $erp)
    {
    }
}