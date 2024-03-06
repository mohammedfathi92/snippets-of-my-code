<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\HotelOrder;
use Packages\Modules\ERP\Facades\ERP;


class CurrentCustomerTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.order.resource_url');

        parent::__construct();
    }

    /**
     * @param HotelOrder $hotel
     * @return array
     * @throws \Throwable
     */
    public function transform(HotelOrder $hotel)
    {
        
        $show_url = url($this->resource_url . '/' . $hotel->hashed_id);
        return [
            'id'            => $hotel->id,
            'customer_code' => $hotel->customer?$hotel->customer->code:'',
            'name' => $hotel->customer?$hotel->customer->name:'',
            'order_code'    => $hotel->order?$hotel->order->order_code:'',
            'order_status'  => $hotel->order?$hotel->order->order_status:'',
            'country'       => $hotel->country?$hotel->country->name:'',
            'city'          => $hotel->city?$hotel->city->name:'',
            'hotel'         => $hotel->hotel?$hotel->hotel->name:'',
            'entry_date'    => $hotel->entry_date,
            'leave_date'    => $hotel->leave_date,
            'order_status'  => $hotel->order?$hotel->order->order_status:'',
            'notes'         => $hotel->notes,
            'created_at'    => format_date($hotel->created_at),
            'updated_at'    => format_date($hotel->updated_at),
        ];
    }
}