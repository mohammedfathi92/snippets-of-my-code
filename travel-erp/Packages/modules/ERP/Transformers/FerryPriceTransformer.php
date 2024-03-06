<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\FerryPrice;


class FerryPriceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.ferryprice.resource_url');

        parent::__construct();
    }

    /**
     * @param FerryPrice $ferry_price
     * @return array
     * @throws \Throwable
     */
    public function transform(FerryPrice $ferry_price )
    {
        $show_url = url($this->resource_url . '/' . $ferry_price->hashed_id);
        return [
            'id' => $ferry_price->id,
            'name' => $ferry_price->name,
            'reg_code' => $ferry_price->reg_code,
            'from_country_id' => $ferry_price->from_country?$ferry_price->from_country->name:'',
            'from_city_id'    => $ferry_price->from_city?$ferry_price->from_city->name:'' ,
            'to_country_id'   => $ferry_price->to_country?$ferry_price->to_country->name:'',
            'to_city_id'      => $ferry_price->to_city?$ferry_price->to_city->name:'' ,
            'price_adult'  => $ferry_price->price_adult,
            'price_child'  => $ferry_price->price_child,
            'price_infant' => $ferry_price->price_infant,
            'start_date'   => $ferry_price->start_date,
            'currency_id'   => $ferry_price->currency?$ferry_price->currency->code:'',
             'created_by' => $ferry_price->created_by_name,
            'updated_by' => $ferry_price->updated_by_name,

'status' => formatStatusAsLabels($ferry_price->status > 0?'active': 'inactive'),
            'created_at'   => format_date($ferry_price->created_at),
            'updated_at'   => format_date($ferry_price->updated_at),
            'action'       => $this->actions($ferry_price)
        ];
    }
}