<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Serviceprice;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\ServicePriceTransformer;
use Yajra\DataTables\EloquentDataTable;

class ServicePricesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.serviceprice.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ServicePriceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Service_Type $model_type
     * @param Service_Price $model_price
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(ServicePrice $model )
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
            // 'reg_code' => ['title' => trans('ERP::attributes.main.reg_code')],
            'name' => ['title' => trans('ERP::attributes.main.name')],
            'provider_id' => ['title' => trans('ERP::attributes.transport.provider')],
            'country_id' => ['title' => trans('ERP::attributes.main.country')],
            'city_id' => ['title' => trans('ERP::attributes.main.city')],
            
            'created_by' => ['title' => trans('ERP::attributes.main.created_by'), 'visible' => false],
            'updated_by' => ['title' => trans('ERP::attributes.main.updated_by'), 'visible' => false],
           
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
             'status'          =>['title' => trans('Packages::attributes.status')],
        ];
    }


    // protected function getFilters()
    // {
    //     return [


    //         'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

    //          'from_country_id' => ['title' => trans('ERP::attributes.service.from_country'), 'class' => 'from_country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

    //          'from_city_id' => ['title' => trans('ERP::attributes.service.from_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

    //           'from_city_id' => ['title' => trans('ERP::attributes.service.from_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],


    //     ];
    // }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
