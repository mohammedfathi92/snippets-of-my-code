<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Transportprice;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\TransportPriceTransformer;
use Yajra\DataTables\EloquentDataTable;

class TransportPricesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.transportprice.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new TransportPriceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Transport_Type $model_type
     * @param Transport_Price $model_price
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(TransportPrice $model )
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
            'provider_id' => ['title' => trans('ERP::attributes.transport.provider')],
            'from_country_id' => ['title' => trans('ERP::attributes.transport.from_country')],
            'from_city_id' => ['title' => trans('ERP::attributes.transport.from_city')],
            'from_place_cat_id' => ['title' => trans('ERP::attributes.transport.source_type')],
            'from_place_id' => ['title' => trans('ERP::attributes.transport.source_place')],

            'to_country_id' => ['title' => trans('ERP::attributes.transport.to_country')],
            'to_city_id' => ['title' => trans('ERP::attributes.transport.to_city')],
            'to_place_cat_id' => ['title' => trans('ERP::attributes.transport.target_type')],
            'to_place_id' => ['title' => trans('ERP::attributes.transport.target_place')],

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

    //          'from_country_id' => ['title' => trans('ERP::attributes.transport.from_country'), 'class' => 'from_country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

    //          'from_city_id' => ['title' => trans('ERP::attributes.transport.from_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],

    //           'from_city_id' => ['title' => trans('ERP::attributes.transport.from_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],


    //     ];
    // }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
