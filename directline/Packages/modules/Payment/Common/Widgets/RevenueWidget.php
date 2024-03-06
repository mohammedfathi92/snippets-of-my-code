<?php

namespace Packages\Modules\Payment\Widgets;

use \Packages\Modules\Payment\Models\Invoice;

class RevenueWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $revenue = Invoice::where('status', 'paid')->sum('total');;
        return ' <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>' . \Payments::admin_currency($revenue) . '</h3>
                        <p>' . trans('Payment::labels.widgets.revenue') . '</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="' . url('invoices') . '" class="small-box-footer">
                        ' . trans('Payment::labels.widgets.more_info') . '
                    </a>
                </div>';
    }

}