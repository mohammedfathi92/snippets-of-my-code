<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Ferry;

class FerryTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.ferry.resource_url');

        parent::__construct();
    }

    /**
     * @param Ferry $ferry
     * @return array
     * @throws \Throwable
     */
    public function transform(Ferry $ferry)
    {
        $show_url = url($this->resource_url . '/' . $ferry->hashed_id);
         return [
            'id' => $ferry->id,
            'name' => $ferry->name,
            'reg_code' => $ferry->reg_code,
             'country_id' => $ferry->country?$ferry->country->name:'',
            'city_id' =>  $ferry->city?$ferry->city->name:'',
'email' => $ferry->email,
            'primary_phone' => $ferry->primary_phone,
            'phone_one' => $ferry->phone_one,
            'phone_two' => $ferry->phone_two,
            'website_link' => $ferry->website_link,
            // 'rooms_num' => $ferry->rooms_num,
            'created_by' => $ferry->created_by_name,
            'updated_by' => $ferry->updated_by_name,

'status' => formatStatusAsLabels($ferry->status > 0?'active': 'inactive'),
            'created_at' => format_date($ferry->created_at),
            'updated_at' => format_date($ferry->updated_at),
            'action' => $this->actions($ferry)
        ];
    }
}