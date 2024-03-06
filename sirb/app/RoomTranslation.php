<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class RoomTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name','description' ,'meta_keywords','notes','meta_description'];
	protected $table = "room_translations";
}
