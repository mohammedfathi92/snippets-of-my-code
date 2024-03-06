<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Bus;

class BusTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.bus.resource_url');

        parent::__construct();
    }

    /**
     * @param Bus $bus
     * @return array
     * @throws \Throwable
     */
    public function transform(Bus $bus)
    {
        $show_url = url($this->resource_url . '/' . $bus->hashed_id);
         return [
            'id' => $bus->id,
            'name' => $bus->name,
            'reg_code' => $bus->reg_code,
             'country_id' => $bus->country?$bus->country->name:'',
            'city_id' =>  $bus->city?$bus->city->name:'',
'email' => $bus->email,
            'primary_phone' => $bus->primary_phone,
            'phone_one' => $bus->phone_one,
            'phone_two' => $bus->phone_two,
            'website_link' => $bus->website_link,
            // 'rooms_num' => $bus->rooms_num,
            'created_by' => $bus->created_by_name,
            'updated_by' => $bus->updated_by_name,

'status' => formatStatusAsLabels($bus->status > 0?'active': 'inactive'),
            'created_at' => format_date($bus->created_at),
            'updated_at' => format_date($bus->updated_at),
            'action' => $this->actions($bus)
        ];
    }
}