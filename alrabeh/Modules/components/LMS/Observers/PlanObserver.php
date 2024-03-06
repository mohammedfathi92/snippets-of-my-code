<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Plan;

class PlanObserver
{

    /**
     * @param Plan $plan
     */
    public function created(Plan $plan)
    {
    }
}