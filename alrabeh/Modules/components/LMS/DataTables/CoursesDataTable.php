<?php

namespace Modules\Components\LMS\DataTables;
  
use Modules\Components\LMS\Models\Course;
use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Facades\LMS;
use Modules\Components\LMS\Transformers\CourseTransformer;
use Yajra\DataTables\EloquentDataTable;

class CoursesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.courses.resource_url'));

        $dataTable = new EloquentDataTable($query);
        return $dataTable->setTransformer(new CourseTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Course $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Course $model)
    {
        return $model->with('categories');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'           => ['visible' => false],
            'thumbnail' => ['title' => trans('LMS::attributes.main.thumbnail'),'searchable'=>false , 'orderable'=>false,],
            'title'        => ['title' => trans('LMS::attributes.main.title')],
            // 'slug'         => ['title' => trans('LMS::attributes.main.slug')],
            'lessons_count'      =>['title' => trans('LMS::attributes.main.lessons_count'),'searchable'=>false , 'orderable'=>false,],
            'price' => ['title' => trans('LMS::attributes.main.price')],
            'sale_price'           => ['title' => trans('LMS::attributes.courses.sale_price')],
            'status'       =>['title'=> trans('LMS::attributes.main.status')],
            'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],
            'categories'   => ['name' => 'categories.name', 'title' => trans('LMS::attributes.main.categories'), 'orderable' => false],
        ];
    }

    protected function getFilters()
    {
        return [
            'title'         => ['title' => trans('LMS::attributes.main.title'), 'class' => 'col-md-4', 'type' => 'text', 'condition' => 'like', 'active' => true],
            // 'slug'          => ['title' => trans('LMS::attributes.main.slug'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'categories.id' => ['title' => trans('LMS::attributes.main.title'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => LMS::getCategoriesList(), 'active' => true],
            'created_at'    => ['title' => trans('LMS::attributes.main.created_at'), 'class' => 'col-md-2', 'type' => 'date', 'active' => true],
            'published'     => ['title' => trans('LMS::labels.course.show_published_only'), 'class' => 'col-md-2', 'type' => 'boolean', 'active' => true],
        ];
    }
}
