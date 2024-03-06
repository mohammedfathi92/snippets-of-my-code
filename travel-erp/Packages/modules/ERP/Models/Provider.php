<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Packages\Modules\ERP\Models\UserErp;

class Provider extends UserErp
{
    use PresentableTrait, LogsActivity;

   public $config = 'erp.models.customer';
    protected $table = "users";
   
    


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public function transportPrices(){
        return $this->hasMany(TransportPrice::class, 'provider_id');
    }
}
