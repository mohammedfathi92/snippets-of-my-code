<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\Country;

class CountryObserver
{

    /**
     * @param Country $erp
     */
    public function created(Country $erp)
    {
    }
}