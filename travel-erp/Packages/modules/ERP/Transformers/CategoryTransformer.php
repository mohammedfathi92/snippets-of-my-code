<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Category;

class CategoryTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.category.resource_url');

        parent::__construct();
    }

    /**
     * @param Category $category
     * @return array
     * @throws \Throwable
     */
    public function transform(Category $category)
    {
        $show_url = url($this->resource_url . '/' . $category->hashed_id);

        return [
            'id' => $category->id,
            'name' => '<a href="' . $show_url . '">' . str_limit($category->name, 50) . '</a>',
            'type' => __('ERP::attributes.categories.types.'.$category->type),
            'parent_id' => $category->mainCategory?$category->mainCategory->name:'',
            'created_by' => $category->created_by_name,
            'updated_by' => $category->updated_by_name,
            'created_at' => format_date($category->created_at),
            'updated_at' => format_date($category->updated_at),
             'status' => formatStatusAsLabels($category->status > 0?'active': 'inactive'),
            'action' => $this->actions($category)
        ];
    }
}