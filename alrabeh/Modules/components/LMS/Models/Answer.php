<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Spatie\Activitylog\Traits\LogsActivity;

class Answer extends BaseModel
{
    use LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.answers';
    protected $table = "lms_answers";

    protected static $logAttributes = ['title'];

    protected $guarded = ['id'];

    public function questions()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
