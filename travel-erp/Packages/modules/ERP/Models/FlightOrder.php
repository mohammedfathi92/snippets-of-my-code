<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class FlightOrder extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.flightorder';
    protected $table = "erp_flights_orders";


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
  

        public function airline(){
        return $this->belongsTo(Airline::class, 'airline_id');
    }

}
