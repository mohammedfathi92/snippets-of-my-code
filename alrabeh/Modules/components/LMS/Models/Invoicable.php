<?php

namespace Modules\Components\LMS\Models;

use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;



class Invoicable extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
  
    protected $table = "lms_invoicables";
    protected static $logAttributes = ['code', 'price'];
  

    protected $guarded = ['id'];



      public function invoicables()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    } 







}
