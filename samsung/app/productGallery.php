<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productGallery extends Model
{
    protected $table="product_gallery";
    protected $fillable=['product_id','name','path'];
    protected $dates=["deleted_at"];

    public function product(){
        return $this->belongsTo("App\Product");
    }

}
