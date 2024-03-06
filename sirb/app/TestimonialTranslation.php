<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class TestimonialTranslation extends Model {
	public $timestamps = false;
	protected $fillable = ['title', 'visitor_name', 'nationality', 'description', 'meta_keywords', 'meta_description'];
	protected $table = "testimonial_translations";
}
