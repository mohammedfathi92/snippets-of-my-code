<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQTranslation extends Model
{
    public $timestamps = false;
    public $primaryKey = "id";
    protected $fillable = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = "faq_category_translations";
}
