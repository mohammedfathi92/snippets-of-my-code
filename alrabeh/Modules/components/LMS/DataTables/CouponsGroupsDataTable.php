<?php

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Coupon;
use Modules\Components\LMS\Transformers\CouponGroupTransformer;
use Yajra\DataTables\EloquentDataTable;

class CouponsGroupsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.coupon.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CouponGroupTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Coupon $model)
    {
        return $model->newQuery()->where('is_group', 1);
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
            'name' => ['title' => trans('LMS::attributes.main.title')],

            'value' => ['title' => trans('LMS::attributes.coupon.value')],
            'status' => ['title' => trans('Modules::attributes.status')],
            'type' => ['title' => trans('LMS::attributes.coupon.type')],
            'start' => ['title' => trans('LMS::attributes.coupon.start')],
            'expiry' => ['title' => trans('LMS::attributes.coupon.expiry')]
        ];
    }

    protected function getOptions()
    {
        return ['has_action' => true];
    }
}
