<?php

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Page;
use Modules\Components\LMS\Transformers\QuestionsTransformer;
use Yajra\DataTables\EloquentDataTable;

class PagesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.page.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new QuestionsTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Page $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Page $model)
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

    protected function getFilters()
    {
        return [
            'title' => ['title' => trans('LMS::attributes.main.title'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'slug' => ['title' => trans('LMS::attributes.main.slug'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'created_at' => ['title' => trans('LMS::attributes.main.created_at'), 'class' => 'col-md-2', 'type' => 'date', 'active' => true],
            'published' => ['title' => trans('LMS::attributes.main.published'), 'class' => 'col-md-2', 'type' => 'boolean', 'active' => true],
        ];
    }
}
