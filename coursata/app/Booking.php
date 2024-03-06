<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $table = "bookings";
    protected $fillable = ['communication_source', 'currency', 'arrival_date', 'departure_date','notes','institutes_level','user_id','advisor_id','housing_id','payment_method','institute_id','course_id','course_weeks', 'course_week_price', 'course_total_price', 'total_price', 'status','created_at', 'updated_at'];

    function country()
    {
        return $this->belongsTo(Country::class, 'nationality');
    }

    function city()
    {
        return $this->belongsTo(City::class, 'nationality');
    }


     function media()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'booking-media');
    }

    
   

    function institute()
    {
        return $this->belongsTo(Institute::class, "institute_id");
    }

    function housing()
    {
        return $this->belongsTo(BookedHousing::class, "housing_id");
    }

     function services()
    {
        return $this->hasMany(BookedService::class, "booking_id");
    }

    function course()
    {
        return $this->belongsTo(Course::class, "course_id");
    }

   
    function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    function advisor()
    {
        return $this->belongsTo(User::class, "advisor_id", "id");
    }
}
