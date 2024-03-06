<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Coupon;

class CouponGroupObserver
{

    /**
     * @param Coupon $coupon_group
     */
    public function created(Coupon $coupon_group)
    {
    }
}