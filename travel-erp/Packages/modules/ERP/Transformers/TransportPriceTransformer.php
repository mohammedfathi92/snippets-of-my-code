<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\TransportPrice;


class TransportPriceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.transportprice.resource_url');

        parent::__construct();
    }

    /**
     * @param TransportPrice $transport_price
     * @return array
     * @throws \Throwable
     */
    public function transform(TransportPrice $transport_price )
    {
        $show_url = url($this->resource_url . '/' . $transport_price->hashed_id);
        return [
            'id' => $transport_price->id,
            'reg_code' => $transport_price->reg_code,
            'name' => $transport_price->name,
            'from_country_id' => $transport_price->from_country?$transport_price->from_country->name:'',
             'to_country_id' => $transport_price->to_country?$transport_price->to_country->name:'',
            'from_city_id'    => $transport_price->from_city?$transport_price->from_city->name:'' ,
            'to_city_id'    => $transport_price->to_city?$transport_price->to_city->name:'' ,            
            'to_place_cat_id'    => $transport_price->to_place_cat?$transport_price->to_place_cat->name:'' ,
             'to_place_id'    => $transport_price->to_place?$transport_price->to_place->name:'' ,

            'from_place_cat_id'    => $transport_price->from_place_cat?$transport_price->from_place_cat->name:'' ,
            'from_place_id'    => $transport_price->from_place?$transport_price->from_place->name:'' ,

           
            'provider_id' => $transport_price->provider?$transport_price->provider->name:'',
            'created_at' => format_date($transport_price->created_at),
            'updated_at' => format_date($transport_price->updated_at),

             'created_by' => $transport_price->created_by_name,
            'updated_by' => $transport_price->updated_by_name,
            'status' => formatStatusAsLabels($transport_price->status > 0?'active': 'inactive'),

            'action' => $this->actions($transport_price)
        ];
    }
}