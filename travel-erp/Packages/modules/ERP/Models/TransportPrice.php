<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class TransportPrice extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.transportprice';
    protected $table = "erp_transport_prices";



    protected static $logAttributes = [];

    public $translatable = ['name','description','notes'];
    

    protected $guarded = ['id'];
    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_id');
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

    public function to_place_cat(){
        return $this->belongsTo(Category::class, 'to_place_cat_id');
    }

     public function from_place_cat(){
        return $this->belongsTo(Category::class, 'from_place_cat_id');
    }

    public function from_place(){
        return $this->belongsTo(Place::class, 'from_place_id');
    }

    public function to_place(){
        return $this->belongsTo(Place::class, 'to_place_id');
    }

   

     public function travel(){
        return $this->belongsTo(Travel::class, 'travel_id');
    }

    public function vehicles_prices(){
        return $this->hasMany(TransportVehiclePrice::class, 'price_id');
    }


    


}
