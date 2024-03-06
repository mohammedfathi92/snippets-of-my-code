<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Service;


class ServiceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.serviceprice.resource_url');

        parent::__construct();
    }

    /**
     * @param Service $service
     * @return array
     * @throws \Throwable
     */
    public function transform(Service $service)
    {
        $show_url = url($this->resource_url . '/' . $service->hashed_id);
        return [
 'id' => $service->id,
            'name' => $service->name,
            'reg_code' => $service->reg_code,
             'country_id' => $service->country?$service->country->name:'',
            'city_id' =>  $service->city?$service->city->name:'',
'email' => $service->email,
            'primary_phone' => $service->primary_phone,
            'phone_one' => $service->phone_one,
            'phone_two' => $service->phone_two,
            'website_link' => $service->website_link,
           

           
            'provider_id' => $service->provider?$service->provider->name:'',
            'created_at' => format_date($service->created_at),
            'updated_at' => format_date($service->updated_at),

             'created_by' => $service->created_by_name,
            'updated_by' => $service->updated_by_name,
            'status' => formatStatusAsLabels($service->status > 0?'active': 'inactive'),

            'action' => $this->actions($service)
        ];
    }
}