<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 9:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Quiz;

class QuizTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.quiz.resource_url');
        $this->question_route   = config('lms.models.quiz_question.resource_route');


        parent::__construct();
    }

    /**
     * @param Quiz $quiz
     * @return array
     * @throws \Throwable
     */
    public function transform(Quiz $quiz)
    {
        $show_url = url($this->resource_url . '/' . $quiz->hashed_id);
        $url = route($this->question_route, ['quiz' => $quiz->hashed_id]);

        $actions = ['edit'=> [ 
            'href' => url($this->resource_url . '/' . $quiz->hashed_id . '/edit'),
                    'label' => trans('Modules::labels.edit'),
                    'data' => []
                ],
                'questions'=>[
           'href' => $url,
           'label' => __('LMS::attributes.main.questions'),
           'data' => []
       ]
        ];

        if (user()->hasPermissionTo('LMS::quiz.delete')) {
            $actions['delete_quiz'] = [
                'icon'  => 'fa fa-fw',
                'href'  => url($this->resource_url . '/' . $quiz->hashed_id . '/delete-options'), //this is url to load modal view
                'label' => trans('Modules::labels.delete'),
                'class' => 'modal-load',
                'data'  => [
                    'title' => trans('Modules::labels.delete')
                ]

            ];
        }
        return [ 
            'id' => $quiz->id,
            'thumbnail'    =>  '<a href="' . $show_url . '">' . '<img src="' . $quiz->thumbnail . '" class=" img-responsive" alt="Course Image" style="max-width: 50px; max-height: 50px;"/></a>',
            'title' => str_limit($quiz->title, 50),
            // 'slug' => $quiz->slug,
            'quizzes_count' =>$quiz->questions()->count(),
            'price'        => $quiz->price,
             'sale_price'        => $quiz->sale_price,
            'status'       => formatStatusAsLabels($quiz->status > 0?'active': 'inactive'),
            'updated_at'   =>format_date($quiz->updated_at),
            'categories'   => formatArrayAsLabels($quiz->categories->pluck('name'), 'success', '<i class="fa fa-folder-open"></i>'),
            'action' => $this->actions($quiz, $actions, null, false)
        ];
    }
}