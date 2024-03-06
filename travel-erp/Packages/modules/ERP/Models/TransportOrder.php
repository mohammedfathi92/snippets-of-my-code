<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class TransportOrder extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.transport_orders';
    protected $table = "erp_transportations_orders";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

  public function sourcable()
    {

        return $this->morphTo();
    }

    public function targetable()
    {

        return $this->morphTo();
    }  



    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function from_city(){
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function to_city(){
        return $this->belongsTo(City::class, 'to_city_id');
    }    

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function vehicleType(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Category::class, 'vehicle_type_id');
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    } 

    public function driver(){
        return $this->belongsTo(Driver::class, 'driver_id');
    }  

        public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\currency::class, 'new_currency_id');
    }
      


    
  
}
