<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Order;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\OrderTransformer;
use Yajra\DataTables\EloquentDataTable;

class OrdersDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.order.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new OrderTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Order $model)
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
            'customer' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.customer')],
            'purpose' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.vouchers.purpose')],
            'destination' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.destination')],
            'agent' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.agent')],
            'value_currency_id' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.main.currency')],
            'value_currency_rate' => ['title' => trans('ERP::attributes.order.currency_rate')],
            // 'total_amount' => ['title' => trans('ERP::attributes.order.customer')],
            'order_date' => ['title' => trans('ERP::attributes.order.reg_date')],
            'start_date' => ['title' => trans('ERP::attributes.order.start_date')],
            'duration' => ['title' => trans('ERP::attributes.order.duration')],
            'end_date' => ['title' => trans('ERP::attributes.order.end_date')],
            'adult_numbers' => ['title' => trans('ERP::attributes.order.adult_numbers')],
            'child_numbers' => ['title' => trans('ERP::attributes.order.child_numbers')],
            'infant_numbers' =>['title' => trans('ERP::attributes.order.infant_numbers')],

            'created_by' => ['title' => trans('ERP::attributes.main.created_by'), 'visible' => false],
            'updated_by' => ['title' => trans('ERP::attributes.main.updated_by'), 'visible' => false],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }

    //  protected function getFilters()
    // {
    //    return [
            
    //         // 'customer_code' => ['title' => trans('ERP::attributes.order.customer_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
    //         // 'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
    //         // 'order_date' => ['title' => trans('ERP::attributes.order.order_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],
    //         // 'arrive_date' => ['title' => trans('ERP::attributes.order.arrive_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],
    //         //  'order_type' => ['title' => trans('ERP::attributes.order.order_type'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getOrderTypesList(), 'condition' => 'like', 'active' => true],
    //         //  'agent_id' => ['title' => trans('ERP::attributes.order.agent_id'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getAgentsList(), 'condition' => 'like', 'active' => true],



    //     ];
    // }


    // protected function getBuilderParameters()
    // {
    //     return ['order' => [5, 'desc']];
    // }


}
