<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Packages\Modules\ERP\Models\UserErp;


 

class Agent extends UserErp 
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.customer';
    protected $table = "users";
   
    


    protected static $logAttributes = [];

    protected $guarded = ['id'];

  
}
