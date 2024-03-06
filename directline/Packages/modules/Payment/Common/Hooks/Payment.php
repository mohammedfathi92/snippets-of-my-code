<?php

namespace Packages\Modules\Payment\Common\Hooks;

use Packages\Modules\Payment\DataTables\MyInvoicesDataTable;
use Packages\Modules\Subscriptions\Middleware\SubscriptionMiddleware;
use Packages\Modules\Subscriptions\Classes\Subscription as SubscriptionsClass;


class Payment
{
    /**
     * Subscription constructor.
     */
    function __construct()
    {
    }


    public function show_available_currencies_menu()
    {

        $menu = '<li class="nav-currency" >';
        foreach (currency()->getActiveCurrencies() as $currency) {
            $menu .= '<a class="label nav-link badge text-white ';
            $class = strtolower(session('currency')) == strtolower($currency['code']) ? 'label-primary badge-success' : 'label-default badge-secondary';
            $menu .= $class . '" style = "font-size: 100%;font-weight: 400;"  href = "' . request()->url() . '?currency=' . $currency['code'] . '" >' . $currency['symbol'] . '</a>&nbsp;';
        }
        $menu .= '</li >';

        echo $menu;
    }

    public function show_nav_currencies_menu()
    {

        $menu = '<div class="nav-currency" >';
        foreach (currency()->getActiveCurrencies() as $currency) {
            $menu .= '<a class="label nav-link  text-white ';
            $class = strtolower(session('currency')) == strtolower($currency['code']) ? 'label-primary ' : 'label-default ';
            $menu .= $class . '" style = "font-size: 100%;font-weight: 400;"  href = "' . request()->url() . '?currency=' . $currency['code'] . '" >' . $currency['symbol'] . '</a>&nbsp;';
        }
        $menu .= '</div >';

        echo $menu;
    }
}

