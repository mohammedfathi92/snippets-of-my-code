<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Order;

class OrderTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.order.resource_url');

        $this->customer_route   = config('erp.models.customer_order.resource_url');

        parent::__construct();
    }

    /**
     * @param Order $order
     * @return array
     * @throws \Throwable
     */
    
    public function transform(Order $order)
    {
        $show_url = url($this->resource_url . '/' . $order->hashed_id);
        return [
            'id' => $order->id,
            'reg_code' => $order->reg_code,
            'customer' => $order->customer?$order->customer->translated_name.''.$order->customer->user_code:'--',
            'purpose' => $order->purpose?$order->purpose->name:'--',
            'destination' => $order->destination?$order->destination->name:'--',
            'agent' => $order->agent?$order->agent->name:'--',
            'value_currency_id' => $order->currency?$order->currency->name:'--',
            'value_currency_rate' => $order->value_currency_rate,
            'total_amount' => $order->total_amount,
            'order_date' => $order->order_date,
            'start_date' => $order->start_date,
            'duration' => $order->duration,
            'end_date' => $order->end_date,
            'adult_numbers' => $order->adult_numbers,
            'child_numbers' => $order->child_numbers,
            'infant_numbers' => $order->infant_numbers,
            'created_by' => $order->created_by_name,
            'updated_by' => $order->updated_by_name,
            'created_at' => format_date($order->created_at),
            'updated_at' => format_date($order->updated_at),
            'action' => $this->actions($order)
        ];
    }
}