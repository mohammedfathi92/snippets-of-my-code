<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class FlightPrice extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.flightprice';
    protected $table = "erp_flights_prices";


    protected static $logAttributes = [];
    public $translatable = ['name','notes'];

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
        return $this->belongsTo(Currency::class, 'currency_id');
    }


}
