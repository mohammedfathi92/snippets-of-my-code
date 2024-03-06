<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\ServicePrice;


class ServicePriceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.serviceprice.resource_url');

        parent::__construct();
    }

    /**
     * @param ServicePrice $service_price
     * @return array
     * @throws \Throwable
     */
    public function transform(ServicePrice $service_price )
    {
        $show_url = url($this->resource_url . '/' . $service_price->hashed_id);
        return [
            'id' => $service_price->id,
            'reg_code' => $service_price->reg_code,
            'name' => $service_price->name,
            'country_id' => $service_price->country?$service_price->country->name:'',
            
            'city_id'    => $service_price->city?$service_price->city->name:'' ,
           

           
            'provider_id' => $service_price->provider?$service_price->provider->name:'',
            'created_at' => format_date($service_price->created_at),
            'updated_at' => format_date($service_price->updated_at),

             'created_by' => $service_price->created_by_name,
            'updated_by' => $service_price->updated_by_name,
            'status' => formatStatusAsLabels($service_price->status > 0?'active': 'inactive'),

            'action' => $this->actions($service_price)
        ];
    }
}