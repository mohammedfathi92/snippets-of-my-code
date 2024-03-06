<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Http\Request;


class Question extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.question';
    protected $table = "lms_questions";

    protected static $logAttributes = ['title', 'slug'];

    protected $guarded = ['id'];

//     public function scopeGetQuizId($query, Request $request)
// {
//      //more code....
//      $quiz = $request->get('quiz');

//      return  $quiz; 
// }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

  public function categories()
    {
        return $this->morphToMany(Category::class, 'lms_categoriable');
    }

    public function studentLogs()
    {
        return $this->morphMany(\Modules\Components\LMS\Models\Logs::class, 'lms_loggable');
    }

      public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'lms_quiz_questions', 'question_id', 'quiz_id')->withPivot('order');
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }


   function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    
    function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }


}
