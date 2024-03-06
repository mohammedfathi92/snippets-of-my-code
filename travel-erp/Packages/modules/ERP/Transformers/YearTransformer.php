<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Year;

class YearTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.year.resource_url');

        parent::__construct();
    }

    /**
     * @param Year $year
     * @return array
     * @throws \Throwable
     */
    public function transform(Year $year)
    {
        $show_url = url($this->resource_url . '/' . $year->hashed_id);
        return [
            'id' => $year->id,
            'name' => $year->name,
            'created_at' => format_date($year->created_at),
            'updated_at' => format_date($year->updated_at),
            'action' => $this->actions($year)
        ];
    }
}