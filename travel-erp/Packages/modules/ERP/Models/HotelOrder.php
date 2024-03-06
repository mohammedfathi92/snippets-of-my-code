<?php

namespace Packages\Modules\ERP\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class HotelOrder extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'erp.models.hotel_order';
    protected $table = "erp_hotel_orders";


    protected static $logAttributes = [];

    protected $guarded = ['id'];
 


    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

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

    public function roomType(){
        return $this->belongsTo(RoomType::class, 'room_type');
    }

    public function year(){
        return $this->belongsTo(Year::class, 'year_id');
    } 

     public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }
    public function currency(){
        return $this->belongsTo(\Packages\Modules\ERP\Models\currency::class, 'new_currency_id');
    }
  

    protected $appends = ['customer']; 
    public function getCustomerAttribute() {
        return $this->order->customer;
    }

  
}
