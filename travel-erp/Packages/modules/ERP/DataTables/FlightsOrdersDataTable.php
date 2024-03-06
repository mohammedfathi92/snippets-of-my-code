<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\FlightOrder;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\FlightOrderTransformer;
use Yajra\DataTables\EloquentDataTable;

class FlightsOrdersDataTable extends BaseDataTable
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

        return $dataTable->setTransformer(new FlightOrderTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param FlightOrder $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(FlightOrder $model)
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
            'type' => ['title' => trans('ERP::attributes.main.type')],
            'transporter' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.Transporter')],
            'from_country' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.from_country')],
            'from_city' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.from_city')],
            'to_country' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.to_country')],
            'to_city' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.to_city')],
            'adult_numbers' => ['title' => trans('ERP::attributes.order.adult_numbers')],
            'chlid_numbers' => ['title' => trans('ERP::attributes.order.chlid_numbers')],
            'infant_numbers' => ['title' => trans('ERP::attributes.order.infant_numbers')],
            'adult_price' => ['title' => trans('ERP::attributes.order.adult_prices')],
            'chlid_price' => ['title' => trans('ERP::attributes.order.chlid_prices')],
            'infant_price' => ['title' => trans('ERP::attributes.order.infant_prices')],
            'final_price' => ['title' => trans('ERP::attributes.order.final_price')],
            'agent_id' => ['title' => trans('ERP::attributes.order.agent_id')],
            'reserve_code' => ['title' => trans('ERP::attributes.order.reserve_code')],
            'flight_date' => ['title' => trans('ERP::attributes.order.flight_date')],
            'leave_time' => ['title' => trans('ERP::attributes.order.leave_time')],
            'arrive_time' => ['title' => trans('ERP::attributes.order.arrive_time')],
            'confirmed_reserve_code' => ['title' => trans('ERP::attributes.order.confirmed_reserve_code')],
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

            'type'   => ['title' => trans('ERP::attributes.main.type'), 'class' => 'filter_flight_type col-md-2', 'type' => 'select2', 'options' => [

                        'flight' => trans('ERP::attributes.order.flight'),
                        'ferry' => trans('ERP::attributes.order.ferry'),
                    ], 'condition' => 'like', 'active' => true],

             'airline_id' => ['title' => trans('ERP::attributes.order.Transporter'), 'class' => 'col-md-2', 'id'=>'transporter_airline', 'type' => 'select2', 'options' => ERP::getAirlineList(), 'condition' => 'like', 'active' => true],

             'ferry_id' => ['title' => trans('ERP::attributes.order.Transporter'), 'class' => 'col-md-2','id'=>'transporter_ferry', 'type' => 'select2', 'options' => ERP::getFerriesList(), 'condition' => 'like', 'active' => true],

             'from_country_id' => ['title' => trans('ERP::attributes.transport.from_country'), 'class' => 'from_country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

             'from_city_id'   => ['title' => trans('ERP::attributes.transport.from_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

             'to_country_id'  => ['title' => trans('ERP::attributes.transport.to_country'), 'class' => 'to_country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

             'to_city_id'   => ['title' => trans('ERP::attributes.transport.to_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

            'flight_date'    => ['title' => trans('ERP::attributes.order.flight_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],


            'final_price'     => ['title' => trans('ERP::attributes.order.final_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

             'agent_id' => ['title' => trans('ERP::attributes.order.agent_id'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getAgentsList(), 'condition' => 'like', 'active' => true],

            'reserve_code'  => ['title' => trans('ERP::attributes.order.reserve_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],


        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}



