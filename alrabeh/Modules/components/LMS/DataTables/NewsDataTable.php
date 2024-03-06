<?php
/**
 * Created by PhpStorm.
 * User: iMak
 * Date: 11/19/17
 * Time: 9:00 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\News;
use Modules\Components\LMS\Transformers\LessonTransformer;
use Yajra\DataTables\EloquentDataTable;

class NewsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.news.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new LessonTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param News $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(News $model)
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
            'title' => ['title' => trans('LMS::attributes.main.title')],
            'slug' => ['title' => trans('LMS::attributes.main.slug')],
            'published' => ['title' => trans('LMS::attributes.main.published')],
            'published_at' => ['title' => trans('LMS::attributes.main.published_at')],
            'private' => ['title' => trans('LMS::attributes.main.private')],
            'created_at' => ['title' => trans('LMS::attributes.main.created_at')],
            'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],
        ];
    }
}