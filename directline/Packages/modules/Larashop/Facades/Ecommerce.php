<?php

namespace Packages\Modules\Larashop\Facades;

use Illuminate\Support\Facades\Facade;

class Larashop extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Packages\Modules\Larashop\Classes\Larashop::class;
    }
}