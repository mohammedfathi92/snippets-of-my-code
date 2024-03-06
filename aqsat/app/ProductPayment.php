<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPayment extends Model
{
    protected $table = 'product_user';

    function buyer(){
        return $this->belongsTo(User::class,'user_id');
    }

    function product(){
        return $this->belongsTo(Product::class);
    }

}
