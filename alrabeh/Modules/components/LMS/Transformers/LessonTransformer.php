<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 9:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Lesson;

class LessonTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.lesson.resource_url');

        parent::__construct();
    }

    /**
     * @param Lesson $lesson
     * @return array
     * @throws \Throwable
     */
    public function transform(Lesson $lesson)
    {
        return [
            'id'      => $lesson->id,

            'title'   => str_limit($lesson->title, 50),
            // 'slug'    => $lesson->slug,
            'type'    =>$lesson->type,
            'courses' => formatArrayAsLabels($lesson->courses?$lesson->courses->pluck('title'):'--'),
            'status' => formatStatusAsLabels($lesson->status > 0?'active': 'inactive'),
            'updated_at' => \Carbon\Carbon::instance($lesson->created_at)->diffForHumans(),
            'action' => $this->actions($lesson)
        ];
    }
}