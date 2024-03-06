<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class HotelPrice extends BaseModel
{
    use PresentableTrait, LogsActivity, HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.hotelprice';
    protected $table = "erp_hotel_prices";


    protected static $logAttributes = [];

    public $translatable = ['name','notes'];


    protected $guarded = ['id'];
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
     public function hotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

     public function room(){
        return $this->belongsTo(Room::class, 'room_id');
    }



     public function hotel_price_dates(){
        return $this->hasMany(HotelPriceDate::class, 'hotel_prices_id');
    }
}
