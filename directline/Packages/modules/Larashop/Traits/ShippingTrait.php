<?php

namespace Packages\Modules\Larashop\Traits;

use Carbon\Carbon;
use Packages\Modules\Larashop\Classes\CartItem;


/**
 * Class CouponTrait.
 */
trait ShippingTrait
{

    public function hasShippableItems($cartItems)
    {

        foreach ($cartItems as $cartItem) {
            if ($cartItem->id->product->shipping['enabled']) {
                return true;
            }
        }
        return false;
    }

    public function getShippableItems($cartItems)
    {
        $shippable = [];
        foreach ($cartItems as $cartItem) {
            if ($cartItem->id->product->shipping['enabled']) {
                $shippable[] = $cartItem;
            }
        }
        return $shippable;
    }


}
