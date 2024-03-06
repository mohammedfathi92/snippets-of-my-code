<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productFilters extends Model
{
    protected $table = 'products_filters';
    protected $fillable = ['product', 'filter'];
    public $timestamps=false;

    function filter()
    {
        return $this->belongsTo('App\Filter', 'filter', 'id');
    }

    function product()
    {
        return $this->belongsTo('App\Product', 'product', 'id');
    }
}
