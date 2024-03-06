<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Expense;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\ExpenseTransformer;
use Yajra\DataTables\EloquentDataTable;

class ExpensesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.expense.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ExpenseTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Expense $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Expense $model)
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
            'reg_code' => ['title' => trans('ERP::attributes.main.reg_code')],
            'name' => ['title' => trans('ERP::attributes.main.name')],
            'category_id' => ['title' => trans('ERP::attributes.expenses.category')],
            // 'type' => ['title' => trans('ERP::attributes.financials.label_type')],
            'total_amount' =>  ['title' => trans('ERP::attributes.financials.value')],
            'value_currency_id' => ['title' => trans('ERP::attributes.main.currency')],
            'value_currency_rate' => ['title' => trans('ERP::attributes.order.currency_rate')],
            'fees_percent' =>  ['title' => trans('ERP::attributes.expenses.tax')],
            'paid_by_id' => ['title' => trans('ERP::attributes.expenses.paid_by')],


            'created_by' => ['searchable'=>false , 'orderable'=>false,'visible' => false, 'title' => trans('ERP::attributes.main.created_by')],
            'updated_by' => ['searchable'=>false , 'orderable'=>false,'visible' => false, 'title' => trans('ERP::attributes.main.updated_by')],


             'updated_at' => ['title' => trans('Packages::attributes.updated_at')],

            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'status'          =>['title' => trans('Packages::attributes.status')],

        
        ];
    }

}
