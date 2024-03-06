<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class FerryOrder extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.ferryorder';
    protected $table = "erp_ferries_orders";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public function from_city(){
        return $this->belongsTo(City::class, 'from_city_id');
    }
    public function to_city(){
        return $this->belongsTo(City::class, 'to_city_id');
    }
     public function from_country(){
        return $this->belongsTo(Country::class, 'from_country_id');
    }

    public function to_country(){
        return $this->belongsTo(Country::class, 'to_country_id');
    }

    public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\currency::class, 'new_currency_id');
    }
  

        public function provider(){
        return $this->belongsTo(UserERP::class, 'provider_id');
    }

            public function ferry(){
        return $this->belongsTo(Ferry::class, 'transport_id');
    }



   

    
}
