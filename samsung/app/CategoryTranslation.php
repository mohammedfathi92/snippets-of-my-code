<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{

    public $timestamps = false;
    
    protected $primaryKey='id';
    protected $fillable = ['cat_title','cat_description'];
}
