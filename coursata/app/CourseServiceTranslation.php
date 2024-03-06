<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class CourseServiceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = "course_service_translations";
}
