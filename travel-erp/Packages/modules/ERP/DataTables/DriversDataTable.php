<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Driver;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\DriverTransformer;
use Yajra\DataTables\EloquentDataTable;

class DriversDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.driver.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new DriverTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Driver $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Driver $model)
    {
        return $model->newQuery()->where('user_type', 'driver');
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

            'picture_thumb' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.main.picture')],

            'user_code' => ['title' => trans('ERP::attributes.main.code')],

             'name' => ['title' => trans('ERP::attributes.users.name_ar')],

             'name_en' => ['title' => trans('ERP::attributes.users.name_en')],

             'contact_person' => ['title' => trans('ERP::attributes.users.contact_person')],

             'account_type' => ['title' => trans('ERP::attributes.users.account_type')],
           

            'country_id' => ['title' => trans('ERP::attributes.main.country')],

            'city_id' => ['title' => trans('ERP::attributes.main.city')],

            'address' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.main.address')],


             'branch_id' => ['title' => trans('ERP::attributes.main.branch')],

           
            'primary_phone' => ['title' => trans('ERP::attributes.main.primary_phone')],

           'phone_one' => ['title' => trans('ERP::attributes.main.phone_one')],
            'phone_two' => ['title' => trans('ERP::attributes.main.phone_two')],
            'email' => ['title' => trans('ERP::attributes.main.email')],
            // 'notes' => ['title' => trans('ERP::attributes.main.note')],

            'created_by' => ['title' => trans('ERP::attributes.main.created_by'), 'visible' => false],
            'updated_by' => ['title' => trans('ERP::attributes.main.updated_by'), 'visible' => false],

            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],

            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'status'          =>['title' => trans('Packages::attributes.status')],
            
        ];
    }

    protected function getFilters()
    {
               return [
            'name' => ['title' => trans('ERP::attributes.users.name_ar'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'name_en' => ['title' => trans('ERP::attributes.users.name_en'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'user_code' => ['title' => trans('ERP::attributes.main.code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

            'email' => ['title' => trans('ERP::attributes.main.email'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

                 'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => \ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
             'city_id' => ['title' => trans('ERP::attributes.hotel.city'), 'id'=>'city_filter', 'class' => 'col-md-2', 'type' => 'select2', 'options' => \ERP::getCitiesList(), 'condition' => 'like', 'active' => true],
        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
