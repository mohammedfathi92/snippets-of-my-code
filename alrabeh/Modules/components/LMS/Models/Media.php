<?php

namespace Modules\Components\LMS\Models;

use Carbon\Carbon;
use Modules\Foundation\Models\BaseModel;



class Media extends BaseModel
{

    protected $table = 'lms_media';
    /**
     *  Model configuration.
     * @var string
     */


    protected $guarded = ['id'];

       public function mediables()
    {

        return $this->morphTo();
    } 


}
