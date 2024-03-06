<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Hotel;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\HotelTransformer;
use Yajra\DataTables\EloquentDataTable;

class HotelsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.hotel.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new HotelTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Category $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Hotel $model)
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
            'country_id' => ['title' => trans('ERP::attributes.hotel.country')],
            'city_id' => ['title' => trans('ERP::attributes.hotel.city')],
            'address' => ['title' => trans('ERP::attributes.hotel.address')],
            
            'service_fees' => ['title' => trans('ERP::attributes.main.fees_percent')],
            'hotel_level' => ['title' => trans('ERP::attributes.hotel.level')],
            'email' => ['title' => trans('ERP::attributes.hotel.email')],
             'primary_phone' => ['title' => trans('ERP::attributes.main.primary_phone')],

           'phone_one' => ['visible' => false,'title' => trans('ERP::attributes.main.phone_one')],
            'phone_two' => ['visible' => false,'title' => trans('ERP::attributes.main.phone_two')],
            'website_link' => ['visible' => false,'title' => trans('ERP::attributes.hotel.link')],
            // 'rooms_num' => ['title' => trans('ERP::attributes.hotel.rooms_num')],
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

             'reg_code'   => ['title' => trans('ERP::attributes.main.reg_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

             'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
             'city_id' => ['title' => trans('ERP::attributes.hotel.city'), 'id'=>'city_filter', 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],
             'hotel_level' => ['title' => trans('ERP::attributes.hotel.level'), 'id'=>'city_filter', 'class' => 'col-md-2', 'type' => 'select2', 'options' => [
                                    '1' => 'Star' ,
                                    '2' => 'Two star' ,
                                    '3' => 'Three star' ,
                                    '4' => 'Four star' ,
                                    '5' => 'Five star' ,
                                    '6' => 'Six star' ,
                                    '7' => 'Seven star' ,
                                ], 'condition' => 'like', 'active' => true],
             'email'   => ['title' => trans('ERP::attributes.main.email'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'primary_phone'   => ['title' => trans('ERP::attributes.main.primary_phone'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'address'   => ['title' => trans('ERP::attributes.main.address'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],


        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}

