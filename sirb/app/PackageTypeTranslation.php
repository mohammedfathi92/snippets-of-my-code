<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class PackageTypeTranslation extends Model {
	public $timestamps = false;
	protected $fillable = [ 'name','description' ,'meta_keywords','notes','meta_description'];
	protected $table = "package_type_translations";
}
