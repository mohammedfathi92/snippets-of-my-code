<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\Facades\Shop;
use Packages\Modules\Larashop\Models\Product;
use Illuminate\Http\Request;

class ShopController extends BaseController
{
    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $this->title = 'Larashop::module.shop.title';
        $this->title_singular = 'Larashop::module.shop.title';

        parent::__construct();
    }

    /**
     * @param $permission
     */
    private function canAccess($permission)
    {
        if (!user()->hasPermissionTo($permission)) {
            abort(403);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->canAccess('Larashop::shop.access');

        $grid_items = Shop::getProducts($request);

        $grid_item_view = 'Larashop::shop.grid_item';

        return view('Larashop::shop.grid')->with(compact('grid_item_view', 'grid_items'));
    }

    public function show(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            abort(404);

        }
        $this->canAccess('Larashop::shop.access');

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $product->name])]);

        return view('Larashop::shop.show')->with(compact('product'));
    }

    public function settings(Request $request)
    {
        $this->canAccess('Larashop::settings.access');

        $this->setViewSharedData(['title_singular' => 'eCommerce Settings']);

        $settings = config('ecommerce.settings');

        return view('Larashop::shop.settings')->with(compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        try {
            $this->canAccess('Larashop::settings.access');

            $settings = $request->except('_token');

            foreach ($settings as $key => $value) {
                \Settings::set($key, $value, 'Larashop');
            }

            flash(trans('Packages::messages.success.saved', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, 'eCommerceSettings', 'savedSettings');
        }

        return redirectTo('e-commerce/settings');
    }
}