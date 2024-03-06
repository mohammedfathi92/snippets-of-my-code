<?php

namespace Packages\Modules\ERP\Facades;

use Illuminate\Support\Facades\Facade;

class ERP extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Packages\Modules\ERP\Classes\ERP::class;
    }
}