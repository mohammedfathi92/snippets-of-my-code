<?php

namespace Packages\Modules\Larashop\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Foundation\Http\Controllers\PublicBaseController;
use Packages\Modules\Larashop\Classes\Wishlist;
use Packages\Modules\Larashop\DataTables\MyWishlistDataTable;
use Packages\Modules\Larashop\Models\Product;
use Illuminate\Http\Request;

class WishlistsPublicController extends PublicBaseController
{
    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.wishlist.resource_url');
        $this->title = 'Larashop::module.wishlist.title';
        $this->title_singular = trans('Larashop::module.wishlist.title_singular');

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
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function setWishlist(Product $product)
    {
        try {
            if (!user()) {
                $message = ['level' => 'error', 'message' => trans('Larashop::labels.wishlist.need_login_add_product')];

            } else {
                $wishlistClass = new Wishlist();

                $wishlist = $wishlistClass->getWishlistItem($product->id, user()->id);
                if ($wishlist) {
                    $wishlistClass->remove($wishlist->id);
                    $message = ['level' => 'success', 'message' => trans(trans('Larashop::labels.wishlist.product_remove_wishlist'), ['item' => $this->title_singular]), 'action' => 'remove', 'hashed_id' => $product->hashed_id];
                } else {
                    $wishlistClass->add($product->id, user()->id);
                    $message = ['level' => 'success', 'message' => trans('Larashop::labels.wishlist.product_add_wishlist'), 'action' => 'add', 'hashed_id' => $product->hashed_id];
                }
            }

        } catch (\Exception $exception) {
            log_exception($exception, Wishlist::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

}