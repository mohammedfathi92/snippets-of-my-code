<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class HotelServiceTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name'];
	protected $table = "hotel_service_translations";
}
