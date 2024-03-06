<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\Larashop\Models\Order;

class OrderTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.order.resource_url');

        parent::__construct();
    }

    /**
     * @param Order $order
     * @return array
     * @throws \Throwable
     */
    public function transform(Order $order)
    {
        $actions = ['edit' => '', 'delete' => ''];

        if (user()->hasPermissionTo('Larashop::order.update')) {
            $actions['change_status'] = [
                'icon' => 'fa fa-fw fa-edit',
                'href' => url($this->resource_url . '/' . $order->hashed_id . '/edit'),
                'label' => trans('Larashop::labels.order.update_order'),
                'class' => 'modal-load',
                'data' => [
                    'title' => 'Update Order'
                ]

            ];
        }

        $currency = strtoupper($order->currency);

        return [
            'status' => trans('Larashop::status.order.' . strtolower($order->status)),
            'order_number' => '<a href="' . url($this->resource_url . '/' . $order->hashed_id) . '">' . $order->order_number . '</a>',
            'id' => $order->id,
            'currency' => $currency,
            'amount' => currency()->format($order->amount, $currency),
            'user_id' => "<a target='_blank' href='" . url('users/' . $order->user->hashed_id) . "'> {$order->user->name}</a>",

            'created_at' => format_date($order->created_at),
            'updated_at' => format_date($order->updated_at),
            'action' => $this->actions($order, $actions)
        ];
    }
}