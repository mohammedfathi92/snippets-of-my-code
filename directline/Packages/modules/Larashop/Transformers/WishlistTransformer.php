<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\Larashop\Models\Wishlist;

class WishlistTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.wishlist.resource_url');

        parent::__construct();
    }

    /**
     * @param Wishlist $wishlist
     * @return array
     * @throws \Throwable
     */
    public function transform(Wishlist $wishlist)
    {
        $actions = [];

        if ($wishlist->user_id == user()->id) {
            $actions = ['edit' => ''];
        }

        return [
            'product' => '<a href="' . url('e-commerce/shop/' . $wishlist->product->hashed_id) . '" target="_blank">' . $wishlist->product->name . '</a>',
            'id' => $wishlist->id,
            'user_id' => $wishlist->user->name,
            'created_at' => format_date($wishlist->created_at),
            'action' => $this->actions($wishlist, $actions)
        ];
    }
}