<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productProperties extends Model
{

    protected $table = "products_properties";
    protected $fillable=['product','property','value'];


    function product()
    {
        return $this->belongsTo("App\Product", 'product', 'id');
    }
    function property(){
        return $this->belongsTo("App\categoryProperties",'property','id');
    }
}
