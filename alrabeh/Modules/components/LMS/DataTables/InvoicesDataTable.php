<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Invoice;
use Modules\Components\LMS\Transformers\InvoiceTransformer;
use Yajra\DataTables\EloquentDataTable;

class InvoicesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.invoice.resource_url'));

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
            'id'           => ['visible' => false],
            'user_id'         => ['title' => trans('LMS::attributes.invoices.user_name'), 'searchable' => false, 'orderable' => false],
            'code'        => ['title' => trans('LMS::attributes.invoices.code')],
            'total_price'         => ['title' => trans('LMS::attributes.invoices.total_price')],
            
            'status'         => ['title' => trans('LMS::attributes.main.status')],
            'created_at'         => ['title' => trans('LMS::attributes.main.created_at')], //last update



        ];
    }

            protected function getFilters()
    {
        return [
             'user_id' => ['title' => trans('LMS::attributes.invoices.user_name'), 'class' => ' col-md-2', 'type' => 'select2', 'options' => \LMS::getUsersList(), 'condition' => 'like', 'active' => true],
             // 'city_id' => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],


        ];
    }

        protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
