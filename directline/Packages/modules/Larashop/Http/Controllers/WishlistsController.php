<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Larashop\Classes\Wishlist;
use Packages\Modules\Larashop\DataTables\MyWishlistDataTable;
use Packages\Modules\Larashop\Models\Product;
use Illuminate\Http\Request;
use Packages\Modules\Larashop\Models\Wishlist as WishlistModel;

class WishlistsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.wishlist.resource_url');
        $this->title = 'Larashop::module.wishlist.title';
        $this->title_singular = 'Larashop::module.wishlist.title_singular';

        parent::__construct();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $Wishlist = new Wishlist();
        $wishlists = $Wishlist->getUserWishlist(user()->id);
        return view('Larashop::wishlists.index')->with(compact('wishlists'));
    }


    /**
     * @param Request $request
     * @param MyWishlistDataTable $dataTable
     * @return mixed
     */
    public function myWishlist(Request $request, MyWishlistDataTable $dataTable)
    {
        if (!user()->hasPermissionTo('Larashop::my_wishlist.access')) {
            abort(403);
        }

        return $dataTable->render('Larashop::wishlist.index');
    }

    /*
    * @param Request $request
    * @param WishlistModel $wishlist
    * @return \Illuminate\Http\JsonResponse
    */
    public function removeFromWhishlist(Request $request, WishlistModel $wishlist)
    {
        try {
            $wishlistClass = new Wishlist();
            $wishlistClass->remove($wishlist->id);
            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, WishlistModel::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}