<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class Hotel extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */

    
    public $config = 'erp.models.hotel';
    protected $table = "erp_hotels";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public $translatable = ['name','description','notes'];


    public function city(){
    	return $this->belongsTo(City::class, 'city_id');
    }
     public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function rooms(){
        return $this->hasMany(Room::class, 'hotel_id');
    }

    public function hotelOrder(){
        return $this->belongsTo(hotelOrder::class, 'hotel_id');
    }

}
