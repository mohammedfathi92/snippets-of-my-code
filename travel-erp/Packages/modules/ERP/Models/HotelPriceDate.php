<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class HotelPriceDate extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.hotelprice';
    protected $table = "erp_hotel_prices_dates";


    protected static $logAttributes = [];

    protected $guarded = ['id'];
    public function hotelPrice(){
        return $this->belongsTo(HotelPrice::class, 'hotel_prices_id');
    }

}
