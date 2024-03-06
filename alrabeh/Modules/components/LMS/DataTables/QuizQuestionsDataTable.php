<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Question;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Transformers\QuizQuestionTransformer;
use Yajra\DataTables\EloquentDataTable;

class QuizQuestionsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.quiz_question.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new QuizQuestionTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Question $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Question $model)
    {


        $quiz = $this->request->route('quiz');
        if (!$quiz) {
            abort(404);
        }

        $getQuestions = $model->newQuery()->whereHas('quizzes', function($q) use ($quiz){
            $q->where('lms_quizzes.id', $quiz->id);
        });

        return $getQuestions;

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
            'content'           => ['title' => trans('LMS::attributes.main.name')],
            // 'slug'            => ['title' => trans('LMS::attributes.main.slug')],
            'question_type'   => ['title' => trans('LMS::attributes.main.type')],
            'correct_answer' => ['title' => trans('LMS::attributes.main.answers'), 
                'searchable'=>false , 'orderable'=>false],
            'status'       =>['title'=> trans('LMS::attributes.main.status')],
            'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],
        ];
    }

        protected function getBulkActions()
    {
        return [
            'delete' => ['title' => trans('Modules::labels.delete'), 'permission' => 'LMS::question.delete', 'confirmation' => trans('Modules::labels.confirmation.title')

            ]
        ];
    }

                protected function getOptions()
    {
        $url = url('/lms/quiz-questions');
        return ['resource_url' => $url];
  

    }
}
