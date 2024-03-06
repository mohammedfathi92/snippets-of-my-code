<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Lesson;
use Modules\Components\LMS\Transformers\LessonTransformer;
use Yajra\DataTables\EloquentDataTable;

class LessonsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.lesson.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new LessonTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Lesson $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Lesson $model)
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
            'title'     => ['title' => trans('LMS::attributes.main.title')],
            // 'slug'      => ['title' => trans('LMS::attributes.main.slug')],
            'type'      => ['title' => trans('LMS::attributes.main.type')],
            'courses'   => ['name' => 'courses.title', 'title' => trans('LMS::attributes.main.courses'), 'searchable'=>false , 'orderable'=>false,],
             'status'       =>['title'=> trans('LMS::attributes.main.status')],
             'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],

        ];
    }
}
