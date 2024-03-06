<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name','description' ,'meta_keywords','meta_description'];
	protected $table = "country_translations";
}
