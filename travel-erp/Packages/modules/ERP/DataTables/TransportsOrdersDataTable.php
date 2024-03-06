<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\TransportOrder;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\TransportOrderTransformer;
use Yajra\DataTables\EloquentDataTable;

class TransportsOrdersDataTable extends BaseDataTable
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

        return $dataTable->setTransformer(new TransportOrderTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param TransportOrder $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(TransportOrder $model)
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
             'order_code' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.order_code')],
             'order_status' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.order_status')],
            'country_id' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.country')],
            'from_city' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.from_city')],
            'from_source' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.from_source')],
            'source_name' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.source_name')],
            'to_city' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.to_city')],
            'to_source' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.to_target')],
            'target_name' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.target_name')],
            'driver_id' => ['title' => trans('ERP::attributes.order.driver_id')],
            'vehicle_id' => ['title' => trans('ERP::attributes.transport.vehicles')],
            'price_type' => ['title' => trans('ERP::attributes.order.price_type')],
            'actual_price' => ['title' => trans('ERP::attributes.order.actual_price')],
            'final_price' => ['title' => trans('ERP::attributes.order.final_price')],
            'agent_id' => ['title' => trans('ERP::attributes.order.agent_id')],
            'date' => ['title' => trans('ERP::attributes.order.date')],
            'time' => ['title' => trans('ERP::attributes.order.time')],
            'transport_order' => ['title' => trans('ERP::attributes.order.transport_order')],
            'sms' => ['title' => trans('ERP::attributes.order.sms')],
            'notes' => ['title' => trans('ERP::attributes.main.note')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }

     protected function getFilters()
    {
       return [
            
            'order_code'      => ['title' => trans('ERP::attributes.order.order_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

             'order_status'   => ['title' => trans('ERP::attributes.order.order_status'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => [

                    'Demand'                 => trans('ERP::attributes.order_status.Demand'),
                    'Move to implementation' => trans('ERP::attributes.order_status.move_implementation'),
                    'In progress'            =>trans('ERP::attributes.order_status.in_progress'),
                    'Confirmed'              => trans('ERP::attributes.order_status.Confirmed'),
                    'Finished'               => trans('ERP::attributes.order_status.Finished'),
                    'Closed'                 => trans('ERP::attributes.order_status.Closed'),
                    
                     ], 'condition' => 'like', 'active' => true],

            'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_id_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

            'from_city_id' => ['title' => trans('ERP::attributes.transport.from_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

            'from_source' => ['title' => trans('ERP::attributes.transport.from_source'), 'class' => 'source_filter col-md-2', 'type' => 'select2', 'options' => [

                    'hotel' => trans('ERP::attributes.source.hotel'),
                    'airport' => trans('ERP::attributes.source.airport'),
                    'bus' => trans('ERP::attributes.source.bus'),
                    'ferry' => trans('ERP::attributes.source.ferry'),
                    'journey' => trans('ERP::attributes.source.journey'),
                                
                ], 'condition' => 'like', 'active' => true],

            'source_name' => ['title' => trans('ERP::attributes.order.source_name'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => [''=>''], 'condition' => 'like', 'active' => true],

             'to_city_id' => ['title' => trans('ERP::attributes.transport.to_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

            'to_source' => ['title' => trans('ERP::attributes.transport.to_target'), 'class' => 'target_filter col-md-2', 'type' => 'select2', 'options' => [

                    'hotel' => trans('ERP::attributes.source.hotel'),
                    'airport' => trans('ERP::attributes.source.airport'),
                    'bus' => trans('ERP::attributes.source.bus'),
                    'bus' => trans('ERP::attributes.source.bus'),
                    'ferry' => trans('ERP::attributes.source.ferry'),
                    'tour' => trans('ERP::attributes.source.tour'),
                    'journey' => trans('ERP::attributes.source.journey'),
                                
                ], 'condition' => 'like', 'active' => true],

            'target_name' => ['title' => trans('ERP::attributes.order.target_name'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => [''=>''], 'condition' => 'like', 'active' => true],

            'driver_id' => ['title' => trans('ERP::attributes.order.driver_id'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getDriversList() , 'condition' => 'like', 'active' => true],

            'vehicle_id' => ['title' => trans('ERP::attributes.transport.vehicles'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getVehicleList() , 'condition' => 'like', 'active' => true],

            'price_type' => ['title' => trans('ERP::attributes.order.price_type'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ['auto'=>'Auto','manual'=>'Manual'], 'condition' => 'like', 'active' => true],

            'actual_price'    => ['title' => trans('ERP::attributes.order.actual_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],


            'final_price'     => ['title' => trans('ERP::attributes.order.final_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

             'agent_id' => ['title' => trans('ERP::attributes.order.agent_id'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getAgentsList(), 'condition' => 'like', 'active' => true],

            'date'  => ['title' => trans('ERP::attributes.order.date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],

            'time'  => ['title' => trans('ERP::attributes.order.time'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],


        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}
