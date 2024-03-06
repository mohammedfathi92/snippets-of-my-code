<?php

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Tag;
use Modules\Components\LMS\Transformers\TagTransformer;
use Yajra\DataTables\EloquentDataTable;

class TagsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query) 
    {
        $this->setResourceUrl(config('lms.models.tag.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new TagTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Tag $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Tag $model)
    {
        return $model->withCount('courses');
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
            'name' => ['title' => trans('LMS::attributes.main.name')],
            'slug' => ['title' => trans('LMS::attributes.main.slug')],
            'courses_count' => ['title' => trans('LMS::attributes.main.courses_count'), 'searchable' => false],
            'status' => ['title' => trans('LMS::attributes.main.status')],
            'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],
        ];
    }
}
