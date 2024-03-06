<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */ 

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Transformers\QuizTransformer;
use Yajra\DataTables\EloquentDataTable;

class QuizzesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.quiz.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new QuizTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Quiz $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Quiz $model)
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
            'thumbnail' => ['title' => trans('LMS::attributes.main.thumbnail'),'searchable'=>false , 'orderable'=>false],
            'title'           => ['title' => trans('LMS::attributes.main.title')],
            // 'slug'            => ['title' => trans('LMS::attributes.main.slug')],
            'quizzes_count'      =>['title' => trans('LMS::attributes.main.quizzes_count'), 
                'searchable'=>false , 'orderable'=>false],
                'price' => ['title' => trans('LMS::attributes.main.price')],
                'sale_price'           => ['title' => trans('LMS::attributes.courses.sale_price')],
            'status'       =>['title'=> trans('LMS::attributes.main.status')],
            'categories'      => ['title' => trans('LMS::attributes.main.categories'), 'searchable'=>false , 'orderable'=>false],
            'updated_at'      => ['title' => trans('LMS::attributes.main.updated_at')],

        ];
    }
}
