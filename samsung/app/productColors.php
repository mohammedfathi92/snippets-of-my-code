<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productColors extends Model
{
    protected $table='product_colors';
    protected $fillable=['product_id','color'];
    function product(){
        return $this->belongsTo("App\Product",'product_id','id');
    }
}
