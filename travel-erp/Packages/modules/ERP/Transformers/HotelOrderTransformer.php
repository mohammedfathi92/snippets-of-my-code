<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\HotelOrder;

class HotelOrderTransformer extends BaseTransformer
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

        $actions = [];

        $actions['duplicate'] = [
            'icon' => 'fa fa-fw fa-plus',
            'href' => url($this->resource_url . '/' . $hotel->hashed_id . '/duplicateHotel'), //this is url to load modal view
            'label' => 'duplicate',
            'class' => 'modal-load',
            'data' => [
                'title' => 'duplicate'
            ]

        ];



        $show_url = url($this->resource_url . '/' . $hotel->hashed_id);
        return [
            'id' => $hotel->id,
            'order_code' => $hotel->order?$hotel->order->order_code:'',
            'order_status' => $hotel->order?$hotel->order->order_status:'',
            'country' => $hotel->country?$hotel->country->name:'',
            'city' => $hotel->city?$hotel->city->name:'',
            'hotel'   =>$hotel->hotel?$hotel->hotel->name:'',
            'room' => $hotel->room?$hotel->room->name:'',
            'room_type' => $hotel->roomType?$hotel->roomType->name:'',
            'entry_date' => $hotel->entry_date,
            'leave_date' => $hotel->leave_date,
            'rooms_num' => $hotel->rooms_num,
            'days_numbers' => $hotel->days_numbers,
            'room_price' => $hotel->room_price,
            'actual_price' => $hotel->actual_price,
            'final_price' => $hotel->final_price,
            'breakfast' => $hotel->breakfast,
            'reserve_code' => $hotel->reserve_code,
            'email' => $hotel->email,
            'notes' => $hotel->notes,
            'created_at' => format_date($hotel->created_at),
            'updated_at' => format_date($hotel->updated_at),
            'action' => $this->actions($hotel,$actions)

        ];
    }
}