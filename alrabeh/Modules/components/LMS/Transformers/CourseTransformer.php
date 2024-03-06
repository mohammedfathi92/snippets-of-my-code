<?php

namespace Modules\Components\LMS\Transformers;


use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Course;

class CourseTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.course.resource_url');

        parent::__construct();
    }

    /**
     * @param Course $course 
     * @return array
     * @throws \Throwable
     */
    public function transform(Course $course)
    {
        $show_url = url($this->resource_url . '/' . $course->hashed_id);
        return [
            'id'           => $course->id,
             'thumbnail'    =>  '<a href="' . $show_url . '">' . '<img src="' . $course->thumbnail . '" class=" img-responsive" alt="Course Image" style="max-width: 50px;max-height: 50px;"/></a>',
            'title'        => '<a href="' . $show_url . '" target="_blank">' . str_limit($course->title, 50) . '</a>',
            // 'slug'         => $course->slug,
            'lessons_count'      =>count($course->lessons),
            'price'        => $course->price,
             'sale_price'        => $course->sale_price,
            
            'status'       => formatStatusAsLabels($course->status > 0?'active': 'inactive'),
            'updated_at'   =>format_date($course->updated_at) ,
            'categories'   => formatArrayAsLabels($course->categories->pluck('name'), 'success', '<i class="fa fa-folder-open"></i>'),
            'action'       => $this->actions($course)
        ];
    }
}