<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Airline;

class AirlineTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.airline.resource_url');

        parent::__construct();
    }

    /**
     * @param Airline $airline
     * @return array
     * @throws \Throwable
     */
    public function transform(Airline $airline)
    {
        $show_url = url($this->resource_url . '/' . $airline->hashed_id);
        return [
            'id' => $airline->id,
            'name' => $airline->name,
            'reg_code' => $airline->reg_code,
'email' => $airline->email,
            'primary_phone' => $airline->primary_phone,
            'phone_one' => $airline->phone_one,
            'phone_two' => $airline->phone_two,
            'website_link' => $airline->website_link,
            // 'rooms_num' => $airline->rooms_num,
            'created_by' => $airline->created_by_name,
            'updated_by' => $airline->updated_by_name,

'status' => formatStatusAsLabels($airline->status > 0?'active': 'inactive'),
            'created_at' => format_date($airline->created_at),
            'updated_at' => format_date($airline->updated_at),
            'action' => $this->actions($airline)
        ];
    }
}