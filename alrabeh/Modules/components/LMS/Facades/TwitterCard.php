<?php

namespace Modules\Components\LMS\Facades;

use Illuminate\Support\Facades\Facade;

class TwitterCard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seotools.twitter';
    }
}
