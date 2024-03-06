<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookedService extends Model
{

	

	
	protected $table = "booked_services";
	protected $fillable = ['type', 'booking_id', 'status','total_price','num_weeks','user_id','service_id'];


     function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
