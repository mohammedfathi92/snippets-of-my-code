<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $fillable = ['name','status','price','available_num','category_id'];

    protected $table = 'products';

    public function buyers()
    {
        return $this->belongsToMany(User::class)->withTimestamps()
            ->withPivot('price','quantity','total_price');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }


}
