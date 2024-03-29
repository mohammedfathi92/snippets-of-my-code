<?php

namespace Packages\Modules\Payment\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Payment\Models\Invoice;
use Packages\Modules\Payment\Common\Transformers\InvoiceTransformer;
use Yajra\DataTables\EloquentDataTable;

class MyInvoicesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('payment_common.models.invoice.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new InvoiceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Invoice $model)
    {
        return $model->myInvoices()->newQuery();
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
            'invoicable_type' => ['title' => trans('Payment::attributes.invoice.invoicable_type')],
            'invoicable_id' => ['title' => trans('Payment::attributes.invoice.invoicable_id')],
            'total' => ['title' => trans('Payment::attributes.invoice.total')],
            'status' => ['title' => trans('Packages::attributes.status')],
            'description' => ['title' => trans('Payment::attributes.invoice.description')],
            'code' => ['title' => trans('Payment::attributes.invoice.code')],
            'due_date' => ['title' => trans('Payment::attributes.invoice.due_date')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
        ];
    }
}
