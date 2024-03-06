<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class BusOrder extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.busorder';
    protected $table = "erp_buses_orders";


    protected static $logAttributes = [];


    protected $guarded = ['id'];



    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

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
        return $this->belongsTo(Currency::class, 'new_currency_id');
    }

        public function provider(){
        return $this->belongsTo(UserERP::class, 'provider_id');
    }

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function year(){
        return $this->belongsTo(Year::class, 'year_id');
    } 

                public function bus(){
        return $this->belongsTo(Bus::class, 'transport_id');
    } 

    
  
}
