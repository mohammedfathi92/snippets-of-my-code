<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\Shipping;
use Packages\Modules\Larashop\Transformers\ShippingTransformer;
use Yajra\DataTables\EloquentDataTable;

class ShippingsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.shipping.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ShippingTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Shipping $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Shipping $model)
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
            'priority' => ['title' => trans('Larashop::attributes.shipping.priority')],
            'name' => ['title' => trans('Larashop::attributes.shipping.name')],
            'exclusive' => ['title' => trans('Larashop::attributes.shipping.exclusive')],
            'shipping_method' => ['title' => trans('Larashop::attributes.shipping.shipping_method')],
            'country' => ['title' => trans('Larashop::attributes.shipping.country')],
            'rate' => ['title' => trans('Larashop::attributes.shipping.rate')],
            'min_order_total' => ['title' => trans('Larashop::attributes.shipping.min_order_total')],

        ];
    }

    protected function getOptions()
    {
        return ['has_action' => true];
    }
}
