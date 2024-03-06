<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = "news_translations";
}
