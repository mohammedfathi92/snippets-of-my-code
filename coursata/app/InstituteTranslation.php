<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class InstituteTranslation extends Model {
	public $timestamps = false;
	protected $fillable = ['name', 'description', 'address', 'bank_account', 'meta_keywords', 'meta_description'];
	protected $table = "institute_translations";
}
