<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Coupon;

class CouponObserver
{

    /**
     * @param Coupon $coupon
     */
    public function created(Coupon $coupon)
    {
    }
}