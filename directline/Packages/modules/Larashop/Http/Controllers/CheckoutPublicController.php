<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\PublicBaseController;
use Packages\Modules\CMS\Traits\SEOTools;
use Packages\Modules\Larashop\Traits\CheckoutControllerCommonFunctions;
use Illuminate\Http\Request;

class CheckoutPublicController extends PublicBaseController
{
    use CheckoutControllerCommonFunctions, SEOTools;

    public $urlPrefix = '';

    protected $Packages_middleware_except = [];
    protected $Packages_middleware = ['auth'];

    /**
     * CheckoutPublicController constructor.
     */
    public function __construct()
    {
        $this->Packages_middleware = \Filters::do_filter('Packages_middleware', $this->Packages_middleware, request());

        $this->middleware($this->Packages_middleware, ['except' => $this->Packages_middleware_except]);

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

        $item = [
            'title' => 'Checkout',
            'meta_description' => 'Checkout',
            'url' => url('checkout'),
            'type' => 'checkout'
        ];

        $this->setSEO((object)$item);

        return view('templates.checkout')->with(compact('enable_shipping'));
    }

    public function showOrderSuccessPage()
    {
        $item = [
            'title' => 'Congratulations',
            'meta_description' => 'Order success page',
            'url' => url('shop'),
            'type' => 'order-success'
        ];

        $this->setSEO((object)$item);

        return view('templates.checkout_success');
    }
}