<?php

namespace Packages\Modules\Larashop\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ShoppingCart.
 */
class ShoppingCart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shoppingcart';
    }
}
