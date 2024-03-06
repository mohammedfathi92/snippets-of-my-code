<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class Journey extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.journey';
    protected $table = "erp_journey";
    
    public $translatable = ['name'];



    protected static $logAttributes = [];

    protected $guarded = ['id'];



  
}
