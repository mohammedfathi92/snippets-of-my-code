<?php

namespace Modules\Components\CMS\Facades;

use Illuminate\Support\Facades\Facade;

class CMS extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Components\CMS\Classes\CMS::class;
    }
}
