<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Book;
use Modules\Components\LMS\Transformers\BookTransformer;
use Yajra\DataTables\EloquentDataTable;

class BooksDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.book.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new BookTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Book $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Book $model)
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
            'page_num'      => ['title' => trans('LMS::attributes.books.page_numbers')],
            'author'      => ['title' => trans('LMS::attributes.main.author')],
           
             'status'       =>['title'=> trans('LMS::attributes.main.status')],
             'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],

        ];
    }
}
