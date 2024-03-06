<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Hotelprice;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\HotelPriceTransformer;
use Yajra\DataTables\EloquentDataTable;

class HotelPricesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.hotelprice.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new HotelPriceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Hotel_Type $model_type
     * @param Hotel_Price $model_price
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(HotelPrice $model )
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
            'name' => ['title' => trans('ERP::attributes.main.name')],
            'season' => ['title' => trans('ERP::attributes.main.years')],
            'country_id' => ['title' => trans('ERP::attributes.hotel.country')],
            'city_id' => ['title' => trans('ERP::attributes.hotel.city')],
            'hotel_id' => ['title' => trans('ERP::attributes.hotel.hotel')],
            'room_id' => ['title' => trans('ERP::attributes.hotel.room')],
            'price' => ['title' => trans('ERP::attributes.hotel.price')],
            'r_code' => ['title' => trans('ERP::attributes.hotelprice.r_code')],
            's_code' => ['title' => trans('ERP::attributes.hotelprice.s_code')],

            'created_by' => ['title' => trans('ERP::attributes.main.created_by'), 'visible' => false],
            'updated_by' => ['title' => trans('ERP::attributes.main.updated_by'), 'visible' => false],

            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],

            'status'          =>['title' => trans('Packages::attributes.status')],
        ];
    }
 
    protected function getFilters()
    {
       return [
            
            'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'year_id' => ['title' => trans('ERP::attributes.main.years'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getYearsList(), 'condition' => 'like', 'active' => true],

             'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
             'city_id' => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'hotel_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],
             'hotel_id' => ['title' => trans('ERP::attributes.hotel.hotel'), 'class' => 'room_filter col-md-2', 'type' => 'select2', 'options' => ERP::getHotelsList(), 'condition' => 'like', 'active' => true],
             'room_id' => ['title' => trans('ERP::attributes.hotel.room'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ['' => ''], 'condition' => 'like', 'active' => true],


        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
