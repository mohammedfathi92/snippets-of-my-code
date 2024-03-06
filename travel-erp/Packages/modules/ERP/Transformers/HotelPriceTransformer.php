<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\HotelPrice;


class HotelPriceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.hotelprice.resource_url');

        parent::__construct();
    }

    /**
     * @param HotelPrice $hotel_price
     * @return array
     * @throws \Throwable
     */
    public function transform(HotelPrice $hotel_price )
    {
        $show_url = url($this->resource_url . '/' . $hotel_price->hashed_id);
        return [
            'id' => $hotel_price->id,
            'reg_code' => $hotel_price->reg_code,
            'name' => $hotel_price->name,
            'season' => $hotel_price->season,
            'country_id' => $hotel_price->country?$hotel_price->country->name:'',
            'city_id'    => $hotel_price->city?$hotel_price->city->name:'' ,
            'hotel_id'   =>$hotel_price->hotel?$hotel_price->hotel->name:'',
            'room_id' => $hotel_price->room?$hotel_price->room->name:'',
            'price' => $hotel_price->price,
            'r_code' => $hotel_price->r_code,
            's_code' => $hotel_price->s_code,
            'created_by' => $hotel_price->created_by_name,
            'updated_by' => $hotel_price->updated_by_name,

            'status' => formatStatusAsLabels($hotel_price->status > 0?'active': 'inactive'),
            'created_at' => format_date($hotel_price->created_at),
            'updated_at' => format_date($hotel_price->updated_at),
            'action' => $this->actions($hotel_price)
        ];
    }
}