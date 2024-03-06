<?php

namespace Corsata;

use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanSubscribe;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use CanFollow, CanLike, CanFavorite, CanSubscribe;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name','last_name','slug','level', 'email', 'password','phone','gender','avatar','address_line1','address_line2','zip_code','birth_date',"residence_place","nationality"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];

    function scopeIsSuperAdmin()
    {
        return $this->level === 0 ? true : false;
    }

     function scopeGetAdvisors()
    {
        return $this->where('is_advisor', true);
    }

    function country()
    {
        return $this->belongsTo(Country::class, 'residence_place');
    }

    function userNationality()
    {
        return $this->belongsTo(Country::class, "nationality");
    }

    //  public function advisors()
    // {
    //  return $this->belongsToMany(self::class, 'user_advisors', 'user_id', 'advisor_id');
    // }

    function bookings()
    {
        return $this->hasMany(Booking::class, "user_id" );
    }

    function advisorBookings()
    {
        return $this->hasMany(Booking::class, "advisor_id" );
    }

    function favoriteCourses()
    {
       return $this->belongsToMany(Course::class, 'wishlists','user_id','course_id')->withTimestamps();

    }

    function favoriteInstitutes()
    {
       return $this->belongsToMany(Institute::class, 'wishlists','user_id','institute_id')->withTimestamps();

    }
}
