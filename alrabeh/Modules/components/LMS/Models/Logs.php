<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;


class Logs extends BaseModel
{
    use PresentableTrait, LogsActivity;

protected $dates = ['finished_at'];
    /**
     *  Model configuration.
     * @var string 
     */


    public $config = 'lms.models.logs';
    protected $table = "lms_logs";

    protected static $logAttributes = [];

    protected $guarded = ['id'];




    public function lms_loggable()
    {

        return $this->morphTo();
    }


    public function user()
    {
        return $this->belongsTo(UserLMS::class, 'user_id');
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
