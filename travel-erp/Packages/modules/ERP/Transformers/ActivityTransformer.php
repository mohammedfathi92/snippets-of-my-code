<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Activity;

class ActivityTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.activity.resource_url');

        parent::__construct();
    }

    /**
     * @param Activity $activity
     * @return array
     * @throws \Throwable
     */
    public function transform(Activity $activity)
    {
        $show_url = url($this->resource_url . '/' . $activity->hashed_id);
         return [
            'id' => $activity->id,
            'name' => $activity->name,
            'reg_code' => $activity->reg_code,
             'country_id' => $activity->country?$activity->country->name:'',
            'city_id' =>  $activity->city?$activity->city->name:'',
'email' => $activity->email,
            'primary_phone' => $activity->primary_phone,
            'phone_one' => $activity->phone_one,
            'phone_two' => $activity->phone_two,
            'website_link' => $activity->website_link,
            'created_by' => $activity->created_by_name,
            'updated_by' => $activity->updated_by_name,

'status' => formatStatusAsLabels($activity->status > 0?'active': 'inactive'),
            'created_at' => format_date($activity->created_at),
            'updated_at' => format_date($activity->updated_at),
            'action' => $this->actions($activity)
        ];
    }
}