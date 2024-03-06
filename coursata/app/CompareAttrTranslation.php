<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class CompareAttrTranslation extends Model {
	public $timestamps = false;
	protected $fillable = ['name'];
	protected $table = "compare_attr_translations";
}
