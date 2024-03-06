<?php

namespace Packages\Modules\Larashop\Models;

use Packages\Foundation\Models\BaseModel;
use Packages\Foundation\Transformers\PresentableTrait;
use Packages\Modules\CMS\Models\Content;
use Packages\User\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends BaseModel
{
    use PresentableTrait, LogsActivity;

    protected $table = 'ecommerce_orders';
    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'ecommerce.models.order';

    protected static $logAttributes = ['status', 'amount'];

    protected $guarded = ['id'];

    protected $casts = [
        'shipping' => 'array',
        'billing' => 'array'
    ];

    public function scopeMyOrders($query)
    {
        return $query->where('user_id', user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getInvoiceReference($target = "dashboard")
    {
        $order_number = $this->order_number;
        if ($target == "pdf") {
            return $order_number;
        } else {
            return "<a href='" . url('e-commerce/orders/' . $this->hashed_id) . "'>  $order_number </a>";

        }
    }

    /**
     * Get all of the premuim posts for the order.
     */
    public function posts()
    {
        return $this->morphToMany(Content::class, 'sourcable', 'postables');
    }
}
