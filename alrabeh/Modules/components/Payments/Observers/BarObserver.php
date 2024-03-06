<?php

namespace Modules\Components\Payments\Observers;

use Modules\Components\Payments\Models\Bar;

class BarObserver
{

    /**
     * @param Bar $bar
     */
    public function created(Bar $bar)
    {
    }
}
