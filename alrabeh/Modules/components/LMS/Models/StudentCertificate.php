<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;


class StudentCertificate extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    protected $table = "lms_certificates";

    protected static $logAttributes = ['title'];
  

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


        public function template()
    {
        return $this->belongsTo(Certificate::class, 'temp_id');
    }


}
