<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;


class Day extends BaseModel
{
    use PresentableTrait, LogsActivity,HasTranslations;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.hotelprice';
    protected $table = "erp_hotel_prices_dates";
    public $translatable = ['name'];


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    public function hotelPrices(){
    	return $this->belongsToMany(HotelPrice::class,'erp_hotel_prices_days', 'days_id','hotel_prices_id');
    }


}
