<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\Coupon;
use Packages\Modules\Larashop\Transformers\CouponTransformer;
use Yajra\DataTables\EloquentDataTable;

class CouponsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.coupon.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CouponTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Coupon $model)
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
            'code' => ['title' => trans('Larashop::attributes.coupon.code')],
            'value' => ['title' => trans('Larashop::attributes.coupon.value')],
            'status' => ['title' => trans('Packages::attributes.status')],
            'type' => ['title' => trans('Larashop::attributes.coupon.type')],
            'start' => ['title' => trans('Larashop::attributes.coupon.start')],
            'expiry' => ['title' => trans('Larashop::attributes.coupon.expiry')]
        ];
    }

    protected function getOptions()
    {
        return ['has_action' => true];
    }
}
