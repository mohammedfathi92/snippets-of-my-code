<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Transformers\PlanTransformer;
use Yajra\DataTables\EloquentDataTable;

class PlansDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.plan.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new PlanTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Plan $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Plan $model)
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
                'id'              => ['visible' => false],
                'name'            => ['title' => trans('LMS::attributes.main.name')],
                'slug'            => ['title' => trans('LMS::attributes.main.slug')],
                'price'           => ['title' => trans('LMS::attributes.main.price')],
                'sale_price'           => ['title' => trans('LMS::attributes.courses.sale_price')],
                'is_active'          => ['title' => trans('LMS::attributes.main.status')],
            
                'updated_at'      => ['title' => trans('LMS::attributes.main.updated_at')],
        ];
    }
}


