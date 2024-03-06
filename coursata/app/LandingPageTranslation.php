<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class LandingPageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'json_code','lang_status','data_type', 'data_amount', 'data_featured', 'meta_keywords', 'meta_description'];
    protected $table = "landing_page_translations";
}
