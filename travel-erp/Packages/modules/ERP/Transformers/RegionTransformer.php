<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Region;

class RegionTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.region.resource_url');

        parent::__construct();
    }

    /**
     * @param Region $region
     * @return array
     * @throws \Throwable
     */
    public function transform(Region $region)
    {
        $show_url = url($this->resource_url . '/' . $region->hashed_id);

        return [
            'id' => $region->id,
            'name' => '<a href="' . $show_url . '">' . str_limit($region->name, 50) . '</a>',
            'created_at' => format_date($region->created_at),
            'updated_at' => format_date($region->updated_at),
            'action' => $this->actions($region)
        ];
    }
}