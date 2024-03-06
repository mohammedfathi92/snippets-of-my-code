<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $table="page_translations";
    protected $fillable = ['name', 'content', 'meta_keywords', 'meta_description'];
    public $timestamps=false;
}
