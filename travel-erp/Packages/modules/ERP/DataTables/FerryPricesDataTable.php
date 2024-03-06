<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Ferryprice;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\FerryPriceTransformer;
use Yajra\DataTables\EloquentDataTable;

class FerryPricesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.ferryprice.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new FerryPriceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Ferry_Type $model_type
     * @param Ferry_Price $model_price
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(FerryPrice $model )
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
            'name' => ['title' => trans('ERP::attributes.main.name')],
            'from_country_id' => ['title' => trans('ERP::attributes.transport.from_country')],
            'from_city_id' => ['title' => trans('ERP::attributes.transport.from_city')],
            'to_country_id' => ['title' => trans('ERP::attributes.transport.to_country')],
            'to_city_id' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.transport.to_city')],
            'price_adult' => ['title' => trans('ERP::attributes.flight.price_adult')],
            'price_child' => ['title' => trans('ERP::attributes.flight.price_child')],
            'price_infant' => ['title' => trans('ERP::attributes.flight.price_infant')],
            'start_date' => ['title' => trans('ERP::attributes.flight.start_date')],
            'currency_id' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.flight.currency_id')],
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

    //         'start_date' => ['title' => trans('ERP::attributes.flight.start_date'), 'class' => 'col-md-2', 'type' => 'date', 'condition' => 'like', 'active' => true],

    //          'from_country_id' => ['title' => trans('ERP::attributes.transport.from_country'), 'class' => 'from_country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
    //          'from_city_id' => ['title' => trans('ERP::attributes.transport.from_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],
    //          'to_country_id' => ['title' => trans('ERP::attributes.transport.to_country'), 'class' => 'to_country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
    //          'to_city_id' => ['title' => trans('ERP::attributes.transport.to_city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],


    //     ];
    // }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
