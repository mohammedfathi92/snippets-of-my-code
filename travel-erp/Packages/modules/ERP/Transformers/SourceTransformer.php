<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Source;

class SourceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.source.resource_url');

        parent::__construct();
    }

    /**
     * @param Source $source
     * @return array
     * @throws \Throwable
     */
    public function transform(Source $source)
    {
        $show_url = url($this->resource_url . '/' . $source->hashed_id);
        return [
            'id' => $source->id,
            'name' => '<a href="' . $show_url . '">' . str_limit($source->name, 50) . '</a>',
            'type' => $source->type,
            'notes'    => $source->notes,
            'created_at' => format_date($source->created_at),
            'updated_at' => format_date($source->updated_at),
            'action' => $this->actions($source)
        ];
    }
}