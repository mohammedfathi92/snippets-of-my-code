<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class ActivityOrder extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.activityorder';
    protected $table = "erp_activities_orders";


    protected static $logAttributes = [];

    protected $guarded = ['id'];


    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
     public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }


    public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\currency::class, 'new_currency_id');
    }
  

        public function provider(){
        return $this->belongsTo(UserERP::class, 'provider_id');
    }

            public function activity(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Activity::class, 'activity_id');
    }


}
