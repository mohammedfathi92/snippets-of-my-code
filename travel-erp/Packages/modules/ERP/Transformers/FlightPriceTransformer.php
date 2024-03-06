<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\FlightPrice;


class FlightPriceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.flightprice.resource_url');

        parent::__construct();
    }

    /**
     * @param FlightPrice $flight_price
     * @return array
     * @throws \Throwable
     */
    public function transform(FlightPrice $flight_price )
    {
        $show_url = url($this->resource_url . '/' . $flight_price->hashed_id);
          return [
            'id' => $flight_price->id,
            'name' => $flight_price->name,
            'reg_code' => $flight_price->reg_code,
            'from_country_id' => $flight_price->from_country?$flight_price->from_country->name:'',
            'from_city_id'    => $flight_price->from_city?$flight_price->from_city->name:'' ,
            'to_country_id'   => $flight_price->to_country?$flight_price->to_country->name:'',
            'to_city_id'      => $flight_price->to_city?$flight_price->to_city->name:'' ,
            'price_adult'  => $flight_price->price_adult,
            'price_child'  => $flight_price->price_child,
            'price_infant' => $flight_price->price_infant,
            'start_date'   => $flight_price->start_date,
            'currency_id'   => $flight_price->currency?$flight_price->currency->code:'',
             'created_by' => $flight_price->created_by_name,
            'updated_by' => $flight_price->updated_by_name,

'status' => formatStatusAsLabels($flight_price->status > 0?'active': 'inactive'),
            'created_at'   => format_date($flight_price->created_at),
            'updated_at'   => format_date($flight_price->updated_at),
            'action'       => $this->actions($flight_price)
        ];
    }
}