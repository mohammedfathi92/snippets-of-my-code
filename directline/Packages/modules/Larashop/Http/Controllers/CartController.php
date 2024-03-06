<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    /**
     * CartController constructor.
     */

    public function __construct()
    {
        $this->title = 'Larashop::module.cart.title';
        $this->title_singular = 'Larashop::module.cart.title';
        parent::__construct();
    }

    /**
     * @return mixed
     */
    private function canAccessCart()
    {
        if (!user()->hasPermissionTo('Larashop::cart.access')) {
            abort(403);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->canAccessCart();

        return view('Larashop::cart.show');
    }
}