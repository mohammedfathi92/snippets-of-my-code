<?php

namespace Modules\Components\LMS\Models;

use Carbon\Carbon;
use Modules\Foundation\Models\BaseModel;
use Modules\Foundation\Transformers\PresentableTrait;
use Modules\User\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends BaseModel
{
    use PresentableTrait, LogsActivity;

    protected $table = 'lms_coupons';
    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'lms.models.coupon';

    protected static $logAttributes = ['status'];

    protected $guarded = ['id'];

    protected $casts = [
    ];

    protected $dates = [
        'start',
        'expiry'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'lms_coupon_user', 'coupon_id', 'user_id');
    }

    public function getStatusAttribute()
    {
        if ($this->start <= Carbon::today()->toDateString() && ($this->expiry >= Carbon::today()->toDateString()) || $this->is_active > 0) {
            return "active";

        } else if ($this->start > Carbon::today()->toDateString() || $this->is_active < 1) {
            return "pending";

        } else {
            return "expired";
        }
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'lms_couponable');
    }


    public function quizzes()
    {
        return $this->morphedByMany(Quiz::class, 'lms_couponable');
    }


    public function plans()
    {
        return $this->morphedByMany(Plan::class, 'lms_couponable');
    }


     public function invoices()
    {
        return $this->hasMany(Invoice::class, 'coupon_id');
    }

        function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    
    function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
