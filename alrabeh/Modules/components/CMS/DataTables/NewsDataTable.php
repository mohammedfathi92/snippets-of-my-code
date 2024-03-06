<?php
/**
 * Created by PhpStorm.
 * User: iMak
 * Date: 11/19/17
 * Time: 9:00 AM
 */

namespace Modules\Components\CMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\CMS\Models\News;
use Modules\Components\CMS\Transformers\NewsTransformer;
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
        $this->setResourceUrl(config('cms.models.news.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new NewsTransformer());
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
            'title' => ['title' => trans('CMS::attributes.content.title')],
            'slug' => ['title' => trans('CMS::attributes.content.slug')],
            'published' => ['title' => trans('CMS::attributes.content.published')],
            'published_at' => ['title' => trans('CMS::attributes.content.published_at')],
            'private' => ['title' => trans('CMS::attributes.content.private')],
            'internal' => ['title' => trans('CMS::attributes.content.internal')],
            'created_at' => ['title' => trans('Modules::attributes.created_at')],
            'updated_at' => ['title' => trans('Modules::attributes.updated_at')],
        ];
    }
}
