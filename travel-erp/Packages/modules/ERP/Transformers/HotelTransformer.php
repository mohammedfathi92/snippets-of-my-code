<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Hotel;

class HotelTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.hotel.resource_url');
        $this->room_route   = config('erp.models.room.resource_route');


        parent::__construct();
    }

    /**
     * @param Hotel $hotel
     * @return array
     * @throws \Throwable
     */
    public function transform(Hotel $hotel)
    {
        $show_url = url($this->resource_url . '/' . $hotel->hashed_id);
        $url = route($this->room_route, ['hotel' => $hotel->hashed_id]);


        $actions = ['rooms'=>[
           'href' => "$url",
           'label' => __('ERP::attributes.main.hotel_rooms'),
           'data' => []
       ]
        ];

        return [
            'id' => $hotel->id,
            //'name' => '<a href="' . $show_url . '">' . str_limit($hotel->name, 50) . '</a>',
            'name' => $hotel->name,
            'country_id' => $hotel->country?$hotel->country->name:'',
            'city_id' =>  $hotel->city?$hotel->city->name:'',
            'address' => $hotel->address,
            'reg_code' => $hotel->reg_code,
            'service_fees' => $hotel->service_fees,
            'hotel_level' => $hotel->hotel_level > 1? $hotel->hotel_level.' stars':$hotel->hotel_level.' star',
            'email' => $hotel->email,
            'primary_phone' => $hotel->primary_phone,
            'phone_one' => $hotel->phone_one,
            'phone_two' => $hotel->phone_two,
            'website_link' => '<a href="' . $hotel->website_link . '" target="_blank"><i class="fa fa-external-link"></i>'.__('ERP::attributes.main.show_url').'</a>',
            // 'rooms_num' => $hotel->rooms_num,
            'created_by' => $hotel->created_by_name,
            'updated_by' => $hotel->updated_by_name,

'status' => formatStatusAsLabels($hotel->status > 0?'active': 'inactive'),
            'created_at' => format_date($hotel->created_at),
            'updated_at' => format_date($hotel->updated_at),
            'action' => $this->actions($hotel, $actions)
        ];
    }
}