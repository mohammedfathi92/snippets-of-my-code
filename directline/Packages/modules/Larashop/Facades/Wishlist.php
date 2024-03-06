<?php

namespace Packages\Modules\Larashop\Facades;

use Illuminate\Support\Facades\Facade;
use Packages\Modules\Larashop\Classes\Wishlist as WishlistClass;

class Wishlist extends Facade
{

    protected static function getFacadeAccessor()
    {
        return WishlistClass::class;
    }

}