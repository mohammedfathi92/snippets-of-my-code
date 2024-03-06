<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name','description' ,'meta_keywords','notes','meta_description'];
	protected $table = "hotel_translations";
}
