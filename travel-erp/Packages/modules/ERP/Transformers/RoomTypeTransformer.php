<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\RoomType;

class RoomTypeTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.roomtype.resource_url');

        parent::__construct();
    }

    /**
     * @param RoomType $roomtype
     * @return array
     * @throws \Throwable
     */
    public function transform(RoomType $roomtype)
    {
        $show_url = url($this->resource_url . '/' . $roomtype->hashed_id);
        return [
            'id' => $roomtype->id,
            'name' => $roomtype->name,
            'created_at' => format_date($roomtype->created_at),
            'updated_at' => format_date($roomtype->updated_at),
            'action' => $this->actions($roomtype)
        ];
    }
}