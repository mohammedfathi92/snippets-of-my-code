<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\Expense;

class ExpenseObserver
{

    /**
     * @param Expense $erp
     */
    public function created(Expense $erp)
    {
    }
}