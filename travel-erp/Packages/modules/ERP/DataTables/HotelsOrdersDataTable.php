<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\HotelOrder;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\HotelOrderTransformer;
use Yajra\DataTables\EloquentDataTable;

class HotelsOrdersDataTable extends BaseDataTable
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

        return $dataTable->setTransformer(new HotelOrderTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param HotelOrder $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(HotelOrder $model)
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
             'country' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.country')],
            'city' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.city')],
            'hotel' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.hotel')],
            'room' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.room')],
             'room_type' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.room_type')],
            'entry_date' => ['title' => trans('ERP::attributes.order.entry_date')],
            'leave_date' => ['title' => trans('ERP::attributes.order.leave_date')],
            'rooms_num' => ['title' => trans('ERP::attributes.hotel.rooms_num')],
            'days_numbers' => ['title' => trans('ERP::attributes.order.days_numbers')],
            'room_price' => ['title' => trans('ERP::attributes.order.room_price')],
            'actual_price' => ['title' => trans('ERP::attributes.order.actual_price')],
            'final_price' => ['title' => trans('ERP::attributes.order.final_price')],
            'breakfast' => ['title' => trans('ERP::attributes.hotel.breakfast')],
            'reserve_code' => ['title' => trans('ERP::attributes.order.reserve_code')],
            'email' => ['title' => trans('ERP::attributes.main.email')],
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

             'country_id'    => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

             'city_id'       => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'hotel_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

             'hotel_id'      => ['title' => trans('ERP::attributes.hotel.hotel'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ERP::getHotelsList(), 'condition' => 'like', 'active' => true],

             'room_id'      => ['title' => trans('ERP::attributes.hotel.room'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ['' => ''], 'condition' => 'like', 'active' => true],

             'room_type'    => ['title' => trans('ERP::attributes.order.room_type'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ERP::getRoomTypesList(), 'condition' => 'like', 'active' => true],

            'entry_date'    => ['title' => trans('ERP::attributes.order.entry_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],

            'leave_date'    => ['title' => trans('ERP::attributes.order.leave_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],

            'rooms_num'     => ['title' => trans('ERP::attributes.hotel.rooms_num'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'days_numbers'  => ['title' => trans('ERP::attributes.order.days_numbers'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'room_price'    => ['title' => trans('ERP::attributes.order.room_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'actual_price'  => ['title' => trans('ERP::attributes.order.actual_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'final_price'   => ['title' => trans('ERP::attributes.order.final_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

             'breakfast'    => ['title' => trans('ERP::attributes.hotel.breakfast'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ['Yes'=>'Yes','No'=>'No'], 'condition' => 'like', 'active' => true],

            'reserve_code'  => ['title' => trans('ERP::attributes.order.reserve_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],




        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}
