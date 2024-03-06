<?php

namespace Modules\Components\Payments\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\Payments\Models\Bar;

class BarTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('payments.models.bar.resource_url');

        parent::__construct();
    }

    /**
     * @param Bar $bar
     * @return array
     * @throws \Throwable
     */
    public function transform(Bar $bar)
    {
        $show_url = url($this->resource_url . '/' . $bar->hashed_id);

        return [
            'id' => $bar->id,
            'name' => '<a href="' . $show_url . '">' . str_limit($bar->name, 50) . '</a>',
            'created_at' => format_date($bar->created_at),
            'updated_at' => format_date($bar->updated_at),
            'action' => $this->actions($bar)
        ];
    }
}
