<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name','description' ,'meta_keywords','notes','meta_description'];
	protected $table = "package_translations";
}
