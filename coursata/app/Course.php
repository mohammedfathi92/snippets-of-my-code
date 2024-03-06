<?php

namespace Corsata;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;


class Course extends Model
{
    use Translatable;
    use CanBeFavorited;

    public $translatedAttributes = ['name', 'description', 'notes', 'meta_keywords', 'meta_description'];
    protected $table = 'courses';
    
    protected $fillable = ['photo', 'video_youtube', 'price', 'offer_price',
        'avg_students', 'max_students', 'min_age', 'start_day', 'hours', 'category_id',
        'currency_id', 'locale_rate', 'international_rate', 'health_insurance', 'featured', 'status'];

    function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    function country()
    {
        return $this->institute->country();
    }

    function gallery()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'course-gallery');
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function city()
    {
        return $this->institute->city();
    }

    function services()
    {
        return $this->hasManyThrough(Service::class, Institute::class, "id");
    }

    function scopePublished()
    {
        return $this->whereStatus(true);
    }

    function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    function favoriteUsers()
    {
       return $this->belongsToMany(User::class, 'wishlists', 'course_id', 'user_id')->withTimestamps();

    }


     function bookings()
    {
        return $this->hasMany(Booking::class, "course_id");
    }

}