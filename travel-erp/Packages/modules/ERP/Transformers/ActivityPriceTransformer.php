<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\ActivityPrice;


class ActivityPriceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.activityprice.resource_url');

        parent::__construct();
    }

    /**
     * @param ActivityPrice $activity_price
     * @return array
     * @throws \Throwable
     */
    public function transform(ActivityPrice $activity_price )
    {
        $show_url = url($this->resource_url . '/' . $activity_price->hashed_id);
        return [
            'id' => $activity_price->id,
            'name' => $activity_price->name,
            'reg_code' => $activity_price->reg_code,
            'country_id' => $activity_price->country?$activity_price->country->name:'',
            'city_id'    => $activity_price->city?$activity_price->city->name:'' ,

            'price_adult'  => $activity_price->price_adult,
            'price_child'  => $activity_price->price_child,
            'price_infant' => $activity_price->price_infant,
            'start_date'   => $activity_price->start_date,
            'currency_id'   => $activity_price->currency?$activity_price->currency->code:'',
             'created_by' => $activity_price->created_by_name,
            'updated_by' => $activity_price->updated_by_name,

'status' => formatStatusAsLabels($activity_price->status > 0?'active': 'inactive'),
            'created_at'   => format_date($activity_price->created_at),
            'updated_at'   => format_date($activity_price->updated_at),
            'action'       => $this->actions($activity_price)
        ];
    }
}