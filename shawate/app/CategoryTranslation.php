<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name','description' ,'meta_keywords','meta_description'];
	protected $table = "category_translations";
}
