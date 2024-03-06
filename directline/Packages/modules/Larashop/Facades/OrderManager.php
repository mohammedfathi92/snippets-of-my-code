<?php

namespace Packages\Modules\Larashop\Facades;

use Illuminate\Support\Facades\Facade;

class OrderManager extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Packages\Modules\Larashop\Classes\OrderManager::class;
    }
}