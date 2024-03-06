<?php

namespace Modules\Components\CMS\Facades;

use Illuminate\Support\Facades\Facade;

class SEOMeta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seotools.metatags';
    }
}
