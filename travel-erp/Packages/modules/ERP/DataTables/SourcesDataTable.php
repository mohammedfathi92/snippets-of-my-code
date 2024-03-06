<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Source;
use Packages\Modules\ERP\Transformers\SourceTransformer;
use Yajra\DataTables\EloquentDataTable;

class SourcesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.source.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new SourceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Source $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Source $model)
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
            'type' => ['title' => trans('ERP::attributes.travel.type')],
            'notes' => ['title' => trans('ERP::attributes.main.note')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }
}
