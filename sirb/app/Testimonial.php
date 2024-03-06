<?php

namespace Sirb;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class Testimonial extends Model
{
    use Translatable;
    public $translatedAttributes = ['title', 'visitor_name', 'nationality', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'testimonials';
    protected $fillable = ['email', 'avatar', 'video_url', 'trip_type', 'type', 'country_id', 'in_home', 'status'];

    function gallery()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'testimonial-gallery');
    }

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function scopePublished()
    {
        return $this->where('status', true);
    }

    function scopeInHome()
    {
        return $this->published()->where('in_home', true);
    }

    function scopeVideo()
    {
        return $this->whereType("video");
    }

}
