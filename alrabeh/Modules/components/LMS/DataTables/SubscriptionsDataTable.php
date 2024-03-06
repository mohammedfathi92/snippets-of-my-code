<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Components\LMS\Models\Subscription;
use Modules\Components\LMS\Transformers\SubscriptionTransformer;
use Modules\Foundation\DataTables\BaseDataTable;
use Yajra\DataTables\EloquentDataTable;

class SubscriptionsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.subscription.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable/*->filter(function ($q) {
            if ($key=request()->get('search.value')) {
                $q->where('user.name', 'like', "%{$key}%")

                    ->get();
            }
        })*/
        ->setTransformer(new SubscriptionTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Subscription $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Subscription $model)
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
            'id'         => ['visible' => false],
            'user_name'  => ['title' => trans('LMS::attributes.subscriptions.user_name'), 'searchable' => false, 'orderable' => false],
            'item'       => ['title' => trans('LMS::attributes.subscriptions.item'), 'searchable' => false, 'orderable' => false],
            'item_type'  => ['title' => trans('LMS::attributes.subscriptions.item_type'), 'searchable' => false, 'orderable' => false],
            'status'     => ['title' => trans('LMS::attributes.main.status')],
            // 'updated_at'         => ['title' => trans('LMS::attributes.main.created_at')], //last update
            'created_at' => ['title' => trans('LMS::attributes.main.created_at')], //last update
        ];
    }

        protected function getFilters()
    {
        return [
             'user_id' => ['title' => trans('LMS::attributes.subscriptions.user_name'), 'class' => ' col-md-2', 'type' => 'select2', 'options' => \LMS::getUsersList(), 'condition' => 'like', 'active' => true],
             // 'city_id' => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCitiesList(), 'condition' => 'like', 'active' => true],


        ];
    }

        protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
