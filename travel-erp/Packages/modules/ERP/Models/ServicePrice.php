<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class ServicePrice extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.serviceprice';
    protected $table = "erp_services_prices";



    protected static $logAttributes = [];

    public $translatable = ['name','description','notes'];
    

    protected $guarded = ['id'];

    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_id');
    }
  

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }


    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }



 


}
