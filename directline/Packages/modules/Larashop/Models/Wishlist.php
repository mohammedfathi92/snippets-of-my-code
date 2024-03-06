<?php

namespace Packages\Modules\Larashop\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\User\Models\User;

class Wishlist extends BaseModel
{
    protected $fillable = ['user_id', 'product_id'];

    protected $table = 'ecommerce_wishlists';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeOfUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeByProduct($query, $product_id)
    {
        return $query->where('product_id', $product_id);
    }

    public function scopeMyWishlist($query)
    {
        return $query->where('user_id', user()->id);
    }
}
