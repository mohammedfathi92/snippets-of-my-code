<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'product_translations';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'slide_description'];
}
