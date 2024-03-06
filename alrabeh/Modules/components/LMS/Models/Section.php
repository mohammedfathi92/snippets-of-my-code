<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\DB;

class Section extends BaseModel
{
    use LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.sections';
    protected $table = "lms_sections";

    protected static $logAttributes = ['title'];



    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

       public function lessons()
    {
        return $this->morphedByMany(Lesson::class, 'lms_sectionable')->withPivot('order', 'type', 'course_id', 'is_private');
    }

       public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_sectionable')->withPivot('order', 'type', 'course_id', 'is_private');
    }

     public function scopeActive($query)
    {
        return $query->where('status', 1);
    }






    // public function morphed()
    // {
    //     return $this->lessons->union($this->quizzes)->all();
    // }

   

}
