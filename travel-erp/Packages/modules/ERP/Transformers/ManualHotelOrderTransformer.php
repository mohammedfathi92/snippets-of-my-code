<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\HotelOrder;

class ManualHotelOrderTransformer extends BaseTransformer
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

   

    public function transform(HotelOrder $orderData)
    {              


          $actions = [];

        $actions['duplicate'] = [
            'icon' => 'fa fa-fw fa-plus',
            'href' => url($this->resource_url . '/' . $orderData->hashed_id . '/duplicateManualHotel'), //this is url to load modal view
            'label' => 'duplicate',
            'class' => 'modal-load',
            'data' => [
                'title' => 'duplicate'
            ]

        ];

        return [
            'id' => $orderData->id,
            'order_code' => $orderData->order?$orderData->order->order_code:'',
            'order_status' => $orderData->order?$orderData->order->order_status:'',
            'country' => $orderData->country?$orderData->country->name:'',
            'city' => $orderData->city?$orderData->city->name:'',
            'hotel'   =>$orderData->orderData?$orderData->orderData->name:'',
            'room' => $orderData->room?$orderData->room->name:'',
            'room_type' => $orderData->roomType?$orderData->roomType->name:'',
            'entry_date' => $orderData->entry_date,
            'leave_date' => $orderData->leave_date,
            'rooms_num' => $orderData->rooms_num,
            'days_numbers' => $orderData->days_numbers,
            'room_price' => $orderData->room_price,
            'actual_price' => $orderData->actual_price,
            'final_price' => $orderData->final_price,
            'breakfast' => $orderData->breakfast,
            'reserve_code' => $orderData->reserve_code,
            'email' => $orderData->email,
            'notes' => $orderData->notes,
            'created_at' => format_date($orderData->created_at),
            'updated_at' => format_date($orderData->updated_at),
            'action' => $this->actions($orderData,$actions)

        ];
    }
}