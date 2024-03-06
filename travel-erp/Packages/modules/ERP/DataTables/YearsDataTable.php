<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Year;
use Packages\Modules\ERP\Transformers\YearTransformer;
use Yajra\DataTables\EloquentDataTable;

class YearsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.year.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new YearTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Year $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Year $model)
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
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];

    }

    
}
