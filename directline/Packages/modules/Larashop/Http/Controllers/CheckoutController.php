<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\Traits\CheckoutControllerCommonFunctions;
use Illuminate\Http\Request;

class CheckoutController extends BaseController
{
    use CheckoutControllerCommonFunctions;

    public $urlPrefix = 'e-commerce/';

    /**
     * CartController constructor.
     */

    public function __construct()
    {
        $this->title = 'Larashop::module.checkout.title';
        $this->title_singular = 'Larashop::module.checkout.title_singular';
        $this->setViewSharedData(['urlPrefix' => $this->urlPrefix]);
        parent::__construct();
    }

    /**
     * @return mixed
     */
    private function canAccessCheckout()
    {
        if (!user()->hasPermissionTo('Larashop::checkout.access')) {
            abort(403);
        }
    }

    public function index(Request $request)
    {
        $cart_items = \ShoppingCart::getItems();

        if (sizeof($cart_items) == 0) {
            return redirectTo('cart');
        }

        $enable_shipping = false;

        if (\Shipping::hasShippableItems($cart_items)) {
            $enable_shipping = true;
        }

        \ShoppingCart::setAttribute('enable_shipping', $enable_shipping);

        $this->canAccessCheckout();

        \Assets::add(asset('assets/Packages/plugins/smartwizard/css/smart_wizard.min.css'));
        \Assets::add(asset('assets/Packages/plugins/smartwizard/css/smart_wizard_theme_arrows.css'));
        \Assets::add(asset('assets/Packages/plugins/smartwizard/js/jquery.smartWizard.min.js'));

        $this->setViewSharedData(['title', 'Checkout']);

        return view('Larashop::checkout.checkout')->with(compact('enable_shipping'));
    }

    public function showOrderSuccessPage()
    {
        $this->setViewSharedData(['title', 'Congratulations !']);
        return view('Larashop::orders.order-success');
    }

}