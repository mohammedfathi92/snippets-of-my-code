<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Order;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\PackageTransformer;
use Yajra\DataTables\EloquentDataTable;

class PackagesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.package.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new PackageTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Order $model)
    {
        return $model->newQuery()->where('package_type','package');
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
            'order_code' => ['title' => trans('ERP::attributes.order.package_code')],
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
            'notes' => ['title' => trans('ERP::attributes.main.note')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }

     protected function getFilters()
    {
       return [
            
            'order_code' => ['title' => trans('ERP::attributes.order.package_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
             'agent_id' => ['title' => trans('ERP::attributes.order.agent_id'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getAgentsList(), 'condition' => 'like', 'active' => true],



        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}
