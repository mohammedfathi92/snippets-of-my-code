<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Order;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\CustomerOrderTransformer;
use Yajra\DataTables\EloquentDataTable;

class CustomerOrdersDataTable extends BaseDataTable
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

        return $dataTable->setTransformer(new CustomerOrderTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Order $model)
    {

        $customer = $this->request->route('customer');
        if (!$customer) {
            abort('404');
        }

        return $model->newQuery()->where('customer_code', $customer->id);

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
            'customer_code' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.customer_code')],
            'order_code' => ['title' => trans('ERP::attributes.order.order_code')],
            'name' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.main.name')],
            'phone_number' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.main.phone')],
            'order_status' => ['title' => trans('ERP::attributes.order.order_status')],
            'hotels_cost' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.hotels_cost')],
            'flights_cost' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.flights_cost')],
            'transports_cost' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.transports_cost')],
            'tax' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.main.tax')],
            'final_cost' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.final_cost')],
            'prepay_percent' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.prepay_percent')],
            'prepay_percent' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.prepay_percent')],
            'payed_final' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.payed_final')],
            'rest_final' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.rest_final')],
            'agent_id' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.agent_id')],
             'order_type' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.order_type')],
            'order_date' => ['title' => trans('ERP::attributes.order.order_date')],
            'arrive_date' => ['title' => trans('ERP::attributes.order.arrive_date')],
            'notes' => ['title' => trans('ERP::attributes.main.note')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }

     protected function getFilters()
    {
       return [
            
            'customer_code' => ['title' => trans('ERP::attributes.order.customer_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'order_date' => ['title' => trans('ERP::attributes.order.order_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],
            'arrive_date' => ['title' => trans('ERP::attributes.order.arrive_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],
             'order_type' => ['title' => trans('ERP::attributes.order.order_type'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getOrderTypesList(), 'condition' => 'like', 'active' => true],
             'agent_id' => ['title' => trans('ERP::attributes.order.agent_id'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getAgentsList(), 'condition' => 'like', 'active' => true],



        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}
