<?php

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Transformers\CategoryTransformer;
use Yajra\DataTables\EloquentDataTable;

class CategoriesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.category.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CategoryTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Category $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Category $model)
    {
        return $model->withCount('courses')->with('parentCategory');

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'              => ['visible' => false],
            'thumbnail'       => ['title' => trans('LMS::attributes.main.thumbnail'), 'searchable' => false, 'orderable'=>false],
            'name'            => ['title' => trans('LMS::attributes.main.name')],
            'hashed_id'            => ['title' => trans('LMS::attributes.main.slug'), 'searchable' => false, 'orderable'=>false],
            // 'courses_count'   => ['title' => trans('LMS::attributes.main.courses_count'), 'searchable' => false],
            'parent_id'       => ['title' => trans('LMS::attributes.main.category'), 'searchable' => false, 'orderable'=>false],
            'status'          => ['title' => trans('LMS::attributes.main.status')],
            'created_at'      => ['title' => trans('LMS::attributes.main.created_at')],
            'updated_at'      => ['title' => trans('LMS::attributes.main.updated_at')],
        ];
    }
}
