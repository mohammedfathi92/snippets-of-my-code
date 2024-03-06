<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;


class CourseService extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
    protected $table = 'course_services';
    protected $fillable = ['icon_class', 'sort'];

    function courses()
    {
        return $this->belongsToMany(Course::class, 'course_services_courses', 'service_id', 'course_id');
    }

}
