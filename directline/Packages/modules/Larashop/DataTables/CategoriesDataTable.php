<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\Category;
use Packages\Modules\Larashop\Transformers\CategoryTransformer;
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
        $this->setResourceUrl(config('ecommerce.models.category.resource_url'));

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
        return $model->withCount('products');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            'name' => ['title' => trans('Larashop::attributes.category.name')],
            'slug' => ['title' => trans('Larashop::attributes.category.slug')],
            'parent_id' => ['title' => trans('Larashop::attributes.category.parent_id')],
            'products_count' => ['title' =>trans('Larashop::attributes.category.products_count'), 'searchable' => false],
            'status' => ['title' => trans('Packages::attributes.status')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }

    protected function getFilters()
    {
        return [
            'name' => ['title' => trans('Larashop::attributes.category.name'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'parent.id' => ['title' => trans('Larashop::attributes.category.parent_id'), 'class' => 'col-md-2', 'type' => 'select', 'options' => \Larashop::getCategoriesList(true), 'active' => true],
            'created_at' => ['title' => trans('Packages::attributes.created_at'), 'class' => 'col-md-2', 'type' => 'date', 'active' => true],
        ];
    }
}
