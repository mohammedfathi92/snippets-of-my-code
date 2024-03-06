<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Packages\User\Models\User;


class Order extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.order';
    protected $table = "erp_orders";


    protected static $logAttributes = [];

    protected $guarded = ['id'];

    

    public function hotelsOrders(){
        return $this->hasMany(HotelOrder::class, 'order_id');
    }

    public function flightsOrders(){
        return $this->hasMany(FlightOrder::class, 'order_id');
    }

    public function transportsOrders(){
        return $this->hasMany(TransportOrder::class, 'order_id');
    }

    public function servicesOrders(){
        return $this->hasMany(ServiceOrder::class, 'order_id');
    }

    public function activitiesOrders(){
        return $this->hasMany(ActivityOrder::class, 'order_id');
    }

    public function ferriesOrders(){
        return $this->hasMany(FerryOrder::class, 'order_id');
    }

    public function busesOrders(){
        return $this->hasMany(BusOrder::class, 'order_id');
    }
    

    public function purpose(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Category::class, 'purpose_id');
    }

    public function payments(){
        return $this->morphMany(\Packages\Modules\ERP\Models\Financial::class, 'itemable');
    }

    public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\Currency::class, 'currency_id');
    }

    public function customer(){
        return $this->belongsTo(UserErp::class, 'customer_id');
    }

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function guests(){
        return $this->hasMany(OrderGuest::class, 'order_id');
    }


   public function destination(){
        return $this->belongsTo(Country::class, 'destination_id');
    }

         public function voucher(){
        return $this->hasOne(Voucher::class,'order_id');
    }

         public function supervisors()
    {
        return $this->morphMany(Supervisor::class, 'supervisorable');
    }

   
}
