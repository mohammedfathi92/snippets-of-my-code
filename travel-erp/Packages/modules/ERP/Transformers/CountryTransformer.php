<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Country;

class CountryTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.country.resource_url');
        $this->city_route   = config('erp.models.city.resource_route');


        parent::__construct();
    }

    /**
     * @param Country $country
     * @return array
     * @throws \Throwable
     */
    public function transform(Country $country)
    {
        $show_url = url($this->resource_url . '/' . $country->hashed_id);

         $url = route($this->city_route, ['country' => $country->hashed_id]);


        $actions = ['cities'=>[
           'href' => $url,
           'label' => 'Cities',
           'data' => []
       ]
        ];

        return [
            'id' => $country->id,
            'name' => '<a href="' . $show_url . '">' . str_limit($country->name, 50) . '</a>',
            'code' => $country->code,
            'currency_id' => $country->currency?$country->currency->code:'',
            'created_by' => $country->created_by_name,
            'updated_by' => $country->updated_by_name,
            'created_at' => format_date($country->created_at),
            'updated_at' => format_date($country->updated_at),
             'status' => formatStatusAsLabels($country->status > 0?'active': 'inactive'),
            'action' => $this->actions($country, $actions)
        ];
    }
}