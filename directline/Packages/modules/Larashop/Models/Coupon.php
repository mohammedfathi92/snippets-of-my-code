<?php

namespace Packages\Modules\Larashop\Models;

use Carbon\Carbon;
use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Packages\User\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends BaseModel
{
    use PresentableTrait, LogsActivity;

    protected $table = 'ecommerce_coupons';
    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'ecommerce.models.coupon';

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
        return $this->belongsToMany(User::class, 'ecommerce_coupon_user');
    }

    public function status()
    {
        if ($this->start <= Carbon::today()->toDateString() && ($this->expiry >= Carbon::today()->toDateString())) {
            return "active";

        } else if ($this->start > Carbon::today()->toDateString()) {
            return "pending";

        } else {
            return "expired";
        }
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'ecommerce_coupon_product');
    }
}
