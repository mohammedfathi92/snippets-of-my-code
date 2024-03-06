<?php

namespace Modules\Components\Payments\Facades;

use Illuminate\Support\Facades\Facade;

class Payments extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Components\Payments\Classes\Payments::class;
    }
}
