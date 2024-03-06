<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\BusPrice;


class BusPriceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.busprice.resource_url');

        parent::__construct();
    }

    /**
     * @param BusPrice $bus_price
     * @return array
     * @throws \Throwable
     */
    public function transform(BusPrice $bus_price )
    {
        $show_url = url($this->resource_url . '/' . $bus_price->hashed_id);
        return [
            'id' => $bus_price->id,
            'name' => $bus_price->name,
            'reg_code' => $bus_price->reg_code,
            'from_country_id' => $bus_price->from_country?$bus_price->from_country->name:'',
            'from_city_id'    => $bus_price->from_city?$bus_price->from_city->name:'' ,
            'to_country_id'   => $bus_price->to_country?$bus_price->to_country->name:'',
            'to_city_id'      => $bus_price->to_city?$bus_price->to_city->name:'' ,
            'price_adult'  => $bus_price->price_adult,
            'price_child'  => $bus_price->price_child,
            'price_infant' => $bus_price->price_infant,
            'start_date'   => $bus_price->start_date,
            'currency_id'   => $bus_price->currency?$bus_price->currency->code:'',
             'created_by' => $bus_price->created_by_name,
            'updated_by' => $bus_price->updated_by_name,

'status' => formatStatusAsLabels($bus_price->status > 0?'active': 'inactive'),
            'created_at'   => format_date($bus_price->created_at),
            'updated_at'   => format_date($bus_price->updated_at),
            'action'       => $this->actions($bus_price)
        ];
    }
}