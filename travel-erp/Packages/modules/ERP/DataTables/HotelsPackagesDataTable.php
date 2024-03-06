<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\HotelOrder;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\HotelPackageTransformer;
use Yajra\DataTables\EloquentDataTable;

class HotelsPackagesDataTable extends BaseDataTable
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

        return $dataTable->setTransformer(new HotelPackageTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param HotelOrder $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(HotelOrder $model)
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
             'order_code' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.order_code')],
             'country' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.country')],
            'city' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.city')],
            'hotel' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.hotel')],
            'room' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.room')],
             'room_type' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.order.room_type')],
            'rooms_num' => ['title' => trans('ERP::attributes.hotel.rooms_num')],
            'days_numbers' => ['title' => trans('ERP::attributes.order.days_numbers')],
            'room_price' => ['title' => trans('ERP::attributes.order.room_price')],
            'actual_price' => ['title' => trans('ERP::attributes.order.actual_price')],
            'final_price' => ['title' => trans('ERP::attributes.order.final_price')],
            'breakfast' => ['title' => trans('ERP::attributes.hotel.breakfast')],
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

         

             'country_id'    => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

             'city_id'       => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'hotel_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

             'hotel_id'      => ['title' => trans('ERP::attributes.hotel.hotel'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ERP::getHotelsList(), 'condition' => 'like', 'active' => true],

             'room_id'      => ['title' => trans('ERP::attributes.hotel.room'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ['' => ''], 'condition' => 'like', 'active' => true],

             'room_type'    => ['title' => trans('ERP::attributes.order.room_type'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ERP::getRoomTypesList(), 'condition' => 'like', 'active' => true],



            'rooms_num'     => ['title' => trans('ERP::attributes.hotel.rooms_num'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'days_numbers'  => ['title' => trans('ERP::attributes.order.days_numbers'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'room_price'    => ['title' => trans('ERP::attributes.order.room_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'actual_price'  => ['title' => trans('ERP::attributes.order.actual_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

            'final_price'   => ['title' => trans('ERP::attributes.order.final_price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],

             'breakfast'    => ['title' => trans('ERP::attributes.hotel.breakfast'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ['Yes'=>'Yes','No'=>'No'], 'condition' => 'like', 'active' => true],





        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}
