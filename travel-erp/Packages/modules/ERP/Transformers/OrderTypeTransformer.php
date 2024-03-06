<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\OrderType;

class OrderTypeTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.ordertype.resource_url');

        parent::__construct();
    }

    /**
     * @param OrderType $ordertype
     * @return array
     * @throws \Throwable
     */
    public function transform(OrderType $ordertype)
    {
        $show_url = url($this->resource_url . '/' . $ordertype->hashed_id);
        return [
            'id' => $ordertype->id,
            'name' => $ordertype->name,
            'created_at' => format_date($ordertype->created_at),
            'updated_at' => format_date($ordertype->updated_at),
            'action' => $this->actions($ordertype)
        ];
    }
}