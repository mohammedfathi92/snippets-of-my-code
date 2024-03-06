<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Category;

class CategoryTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.category.resource_url');

        parent::__construct();
    }

    /**
     * @param Category $category
     * @return array
     * @throws \Throwable
     */
    public function transform(Category $category)
    {

         $show_url = url('categories/' . $category->hashed_id);

        return [
            'id'              => $category->id,
             'thumbnail'    =>  '<a href="' . $show_url . '">' . '<img src="' . $category->thumbnail . '" class=" img-responsive" alt="Course Image" style="max-width: 50px;max-height: 50px;"/></a>',
            'name'            => str_limit($category->name, 50),
            'hashed_id'            => '<a href="' . $show_url . '" target="_blank">' . $show_url,
            'courses_count'   => $category->courses_count,
            'status'          => formatStatusAsLabels($category->status),
            'parent_id' => $category->parentCategory ? formatArrayAsLabels([$category->parentCategory->name], 'success', '<i class="fa fa-folder-open"></i>') : null,
            'created_at'      => format_date($category->created_at),
            'updated_at'      => format_date($category->updated_at),
            'action'          => $this->actions($category)
        ];
    }
}