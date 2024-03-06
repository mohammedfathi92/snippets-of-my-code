<?php

namespace Packages\Modules\Larashop\Widgets;

use \Packages\Modules\Larashop\Models\Order;

class OrdersWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $orders = Order::count();
        return ' <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>' . $orders . '</h3>
                        <p>'.trans('Larashop::labels.widget.orders').'</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="' . url('e-commerce/orders') . '" class="small-box-footer">
                       '.trans('Packages::labels.more_info').'
                    </a>
                </div>';
    }

}