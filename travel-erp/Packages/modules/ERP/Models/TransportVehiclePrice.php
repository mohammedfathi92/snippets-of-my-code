<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class TransportVehiclePrice extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.transportprice';
    protected $table = "erp_transport_vehicles_prices";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

     public function vehicle(){
        return $this->hasMany(Vehicle::class, 'vehicle_id');
    }

     public function transportPrice(){
        return $this->belongsTo(TransportPrice::class, 'price_id');
    }

}
