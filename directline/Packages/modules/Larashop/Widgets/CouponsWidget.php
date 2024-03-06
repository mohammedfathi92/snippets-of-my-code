<?php

namespace Packages\Modules\Larashop\Widgets;

use \Packages\Modules\Larashop\Models\Coupon;

class CouponsWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $coupons = Coupon::count();
        return ' <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>' . $coupons . '</h3>
                        <p>'.trans('Larashop::labels.widget.coupon').'</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-gift"></i>
                    </div>
                    <a href="' . url('e-commerce/coupons') . '" class="small-box-footer">
                        '.trans('Packages::labels.more_info').'
                    </a>
                </div>';
    }

}