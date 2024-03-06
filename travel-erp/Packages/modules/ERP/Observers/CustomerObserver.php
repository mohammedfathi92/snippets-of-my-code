<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\UserErp;

class CustomerObserver
{

    /**
     * @param UserErp $erp
     */
    public function created(UserErp $erp)
    {
    }
}