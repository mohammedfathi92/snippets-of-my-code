<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Financial;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\FinancialTransformer;
use Yajra\DataTables\EloquentDataTable;

class FinancialsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.financial.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new FinancialTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Financial $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Financial $model)
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
            'code' => ['title' => trans('ERP::attributes.financials.code')],


            'type' => ['title' => trans('ERP::attributes.financials.label_type')],
            'value' =>  ['title' => trans('ERP::attributes.financials.value')],
            'currency' => ['title' => trans('ERP::attributes.main.currency')],
            'description' => ['title' => trans('ERP::attributes.financials.description')],
            'created_by' => ['title' => trans('ERP::attributes.financials.created_by')],

             'updated_at' => ['title' => trans('Packages::attributes.updated_at')],

            'created_at' => ['title' => trans('Packages::attributes.created_at')],
        
        ];
    }

}
