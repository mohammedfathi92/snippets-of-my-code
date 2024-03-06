<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\Attribute;
use Packages\Modules\Larashop\Transformers\AttributeTransformer;
use Yajra\DataTables\EloquentDataTable;

class AttributesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.attribute.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new AttributeTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Attribute $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Attribute $model)
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
            'label' => ['title' => trans('Larashop::attributes.attributes.label')],
            'type' => ['title' => trans('Larashop::attributes.attributes.type')],
            'required' => ['title' => trans('Larashop::attributes.attributes.required')],
            'use_as_filter' => ['title' => trans('Larashop::attributes.attributes.use_as_filter')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }
}
