<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Journey;

class JourneyTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.journey.resource_url');

        parent::__construct();
    }

    /**
     * @param Journey $journey
     * @return array
     * @throws \Throwable
     */
    public function transform(Journey $journey)
    {
        $show_url = url($this->resource_url . '/' . $journey->hashed_id);
        return [
            'id' => $journey->id,
            'name' => $journey->name,
            'created_at' => format_date($journey->created_at),
            'updated_at' => format_date($journey->updated_at),
            'action' => $this->actions($journey)
        ];
    }
}