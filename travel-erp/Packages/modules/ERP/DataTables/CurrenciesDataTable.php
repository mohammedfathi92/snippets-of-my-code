<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Currency;
use Packages\Modules\ERP\Transformers\CurrencyTransformer;
use Yajra\DataTables\EloquentDataTable;

class CurrenciesDataTable extends BaseDataTable
{


    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.currency.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CurrencyTransformer());
    }

    public function query(currency $model)
    {
        return $model->newQuery();
    }


    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            'name' => ['title' => trans('ERP::attributes.currency.name')],
            'code' => ['title' => trans('ERP::attributes.currency.code')],
            'symbol' => ['title' =>  trans('ERP::attributes.currency.symbol')],
            'format' => ['title' => trans('ERP::attributes.currency.format')],
            'status' => ['title' => trans('Packages::attributes.status_options.active')],
            'exchange_rate' => ['title' => trans('ERP::attributes.currency.exchange_rate')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')]
        ];
    }

    protected function getFilters()
    {
        return [
            'name' => ['title' => trans('ERP:attributes.currency.name'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'code' => ['title' => trans('ERP:attributes.currency.code'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }


}