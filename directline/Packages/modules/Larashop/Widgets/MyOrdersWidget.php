<?php

namespace Packages\Modules\Larashop\Widgets;

use \Packages\Modules\Larashop\Models\Order;

class MyOrdersWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $orders = Order::where('user_id', user()->id)->count();
        return ' <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>' . $orders . '</h3>
                        <p>'.trans('Larashop::labels.widget.my_order').'</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="' . url('e-commerce/orders/my') . '" class="small-box-footer">
                        '.trans('Packages::labels.more_info').'
                    </a>
                </div>';
    }

}