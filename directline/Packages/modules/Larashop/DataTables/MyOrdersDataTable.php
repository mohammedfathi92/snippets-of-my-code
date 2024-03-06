<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\Order;
use Packages\Modules\Larashop\Transformers\OrderTransformer;
use Yajra\DataTables\EloquentDataTable;

class MyOrdersDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.order.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new OrderTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Order $model)
    {
        return $model->myOrders()->newQuery();
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
            'order_number' => ['title' => trans('Larashop::attributes.order.order_number')],
            'amount' => ['title' =>  trans('Larashop::attributes.order.amount')],
            'status' => ['title' => trans('Packages::attributes.status')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')]
        ];
    }

    protected function getOptions()
    {
        return ['has_action' => false];
    }
}
