<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;


class Favourite extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string 
     */

    protected $table = "lms_favourites";

    protected static $logAttributes = [];

    protected $guarded = ['id'];


    public function favourittable()
    {

        return $this->morphTo();
    } 

    public function user()
    {
        return $this->belongsTo(UserLMS::class, 'user_id');
    }





}
