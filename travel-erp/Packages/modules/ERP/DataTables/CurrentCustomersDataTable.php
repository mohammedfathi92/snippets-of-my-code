<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\HotelOrder;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\CurrentCustomerTransformer;
use Yajra\DataTables\EloquentDataTable;

class CurrentCustomersDataTable extends BaseDataTable
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

        return $dataTable->setTransformer(new CurrentCustomerTransformer());
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
             'customer_code' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.customer_code')],
             'name' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.main.name')],
             'order_code' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.order_code')],
             'country' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.country')],
            'city' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.city')],
            'hotel' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.hotel')],
            'entry_date' => ['title' => trans('ERP::attributes.order.entry_date')],
            'leave_date' => ['title' => trans('ERP::attributes.order.leave_date')],
             'order_status' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.order_status')],
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
                    'In progress'           =>trans('ERP::attributes.order_status.in_progress'),
                    'Confirmed'              => trans('ERP::attributes.order_status.Confirmed'),
                    'Finished'               => trans('ERP::attributes.order_status.Finished'),
                    'Closed'                 => trans('ERP::attributes.order_status.Closed'),
                    
                     ], 'condition' => 'like', 'active' => true],

             'country_id'    => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

             'city_id'       => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'hotel_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

             'hotel_id'      => ['title' => trans('ERP::attributes.hotel.hotel'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ERP::getHotelsList(), 'condition' => 'like', 'active' => true],

            'entry_date'    => ['title' => trans('ERP::attributes.order.entry_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],

            'leave_date'    => ['title' => trans('ERP::attributes.order.leave_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],




        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}
