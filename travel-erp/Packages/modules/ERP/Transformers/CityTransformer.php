<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\City;

class CityTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.city.resource_route');

        parent::__construct();
    }

    /**
     * @param City $city
     * @return array
     * @throws \Throwable
     */
    public function transform(City $city)
    {
         $actions = [];
        $url = route($this->resource_url, ['country' => $city->country->hashed_id]);



        return [
            'id' => $city->id,
            'country_id' => $city->country?$city->country->name:'',
            'name' => $city->name,
            'created_by' => $city->created_by_name,
            'updated_by' => $city->updated_by_name,
            'created_at' => format_date($city->created_at),
            'updated_at' => format_date($city->updated_at),
             'status' => formatStatusAsLabels($city->status > 0?'active': 'inactive'),
            'action' => $this->actions($city,$actions,$url)
        ];
    }
}