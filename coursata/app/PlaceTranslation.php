<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class PlaceTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name','description' ,'meta_keywords','notes','meta_description'];
	protected $table = "place_translations";
}
