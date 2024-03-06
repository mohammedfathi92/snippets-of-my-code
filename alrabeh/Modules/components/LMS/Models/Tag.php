<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.tag';
    protected $table = "lms_tags";

    protected static $logAttributes = ['name'];

    protected $guarded = ['id'];

     public function courses()
    {
        return $this->morphedByMany(Course::class, 'lms_taggable');
    }

      public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_taggable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}
