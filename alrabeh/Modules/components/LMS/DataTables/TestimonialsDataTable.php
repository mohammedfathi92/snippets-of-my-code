<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Testimonial;
use Modules\Components\LMS\Transformers\TestimonialTransformer;
use Yajra\DataTables\EloquentDataTable;

class TestimonialsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.testimonial.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new TestimonialTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Testimonial $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Testimonial $model)
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
            'id'        => ['visible' => false],
            'thumbnail' => ['title' => trans('LMS::attributes.main.thumbnail'), 'searchable' => false, 'orderable' => false],
            'user_name'     => ['title' => trans('LMS::attributes.main.user_name')],
            'title'     => ['title' => trans('LMS::attributes.main.title')],

            // 'content'      => ['title' => trans('LMS::attributes.main.content')],
            // 'in_home'       =>['title'=> trans('LMS::attributes.main.in_home')],
             'status'       =>['title'=> trans('LMS::attributes.main.status')],
             'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],

        ];
    }
}
