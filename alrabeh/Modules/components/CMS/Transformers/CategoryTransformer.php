<?php

namespace Modules\Components\CMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\CMS\Models\Category;

class CategoryTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('cms.models.category.resource_url');

        parent::__construct();
    }

    /**
     * @param Category $category
     * @return array
     * @throws \Throwable
     */
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'name' => str_limit($category->name, 50),
            'slug' => $category->slug,
            'posts_count' => $category->posts_count,
            'status' => formatStatusAsLabels($category->status),
            'created_at' => format_date($category->created_at),
            'updated_at' => format_date($category->updated_at),
            'action' => $this->actions($category)
        ];
    }
}
