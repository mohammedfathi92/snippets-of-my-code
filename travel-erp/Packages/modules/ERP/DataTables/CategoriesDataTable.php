<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Category;
use Packages\Modules\ERP\Transformers\CategoryTransformer;
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
        $this->setResourceUrl(config('erp.models.category.resource_url'));

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
        return $model->newQuery();
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
            'name' => ['title' => trans('ERP::attributes.main.name')],
            'type' => ['title' => trans('ERP::attributes.categories.type')],
            // 'slug' => ['title' => trans('ERP::attributes.main.slug')],
            'parent_id' => ['title' => trans('ERP::attributes.categories.parent')],
            'created_by' => ['title' => trans('ERP::attributes.main.created_by'), 'visible' => false],
            'updated_by' => ['title' => trans('ERP::attributes.main.updated_by'), 'visible' => false],

            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
            'status'          =>['title' => trans('Packages::attributes.status')],
        ];
    }

    protected function getFilters()
    {
       return [
            
            'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'type' => ['title' => trans('ERP::attributes.categories.type'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => \ERP::getCategoriesTypes(), 'condition' => 'like', 'active' => true],



        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
