<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Driver;

class DriverTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.driver.resource_url');

        parent::__construct();
    }

    /**
     * @param Driver $driver
     * @return array
     * @throws \Throwable
     */
    public function transform(Driver $driver)
    {
        $show_url = url($this->resource_url . '/' . $driver->hashed_id);
        return [
            'id' => $driver->id,
            'picture_thumb' => '<img src="' . $driver->picture_thumb . '" class="img-responsive" alt="User Picture" width="35"/>',
            'user_code' => $driver->user_code,
            'branch_id' => $driver->branch?$driver->branch->name:'',
            'name' => $driver->name,
            'name_en' => $driver->name_en,

             'country_id' => $driver->country?$driver->country->name:'',

            'city_id' => $driver->city?$driver->city->name:'',

            'address' => $driver->address,
            'primary_phone' => $driver->primary_phone,

            'contact_person' => $driver->contact_person,
            'account_type' => $driver->account_type,

            'phone_one' => $driver->phone_one,

            'phone_two' => $driver->phone_two,

            'email' => $driver->email,

            'notes' => $driver->notes,
            'created_by' => $driver->created_by_name,
            'updated_by' => $driver->updated_by_name,

            'created_at' => format_date($driver->created_at),
            'updated_at' => format_date($driver->updated_at),

            'status' => formatStatusAsLabels($driver->status > 0?'active': 'inactive'),
            'action' => $this->actions($driver)
        ];
    }
}