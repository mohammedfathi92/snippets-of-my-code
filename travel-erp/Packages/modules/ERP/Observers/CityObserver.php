<?php

namespace Packages\Modules\ERP\Observers;

use Packages\Modules\ERP\Models\City;

class CityObserver
{

    /**
     * @param City $erp
     */
    public function created(City $erp)
    {
    }
}