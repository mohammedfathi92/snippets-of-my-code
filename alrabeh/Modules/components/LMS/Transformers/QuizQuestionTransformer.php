<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 9:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Question;
use Request;

class QuizQuestionTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.quiz_question.resource_route');

        parent::__construct();
    }

    /**
     * @param Question $question
     * @return array
     * @throws \Throwable
     */
    public function transform(Question $question)
    {
        $actions = [];

        $quiz_hashed_id = Request::segment(3);

        $url = route($this->resource_url, ['quiz' => $quiz_hashed_id]);

        return [
            'id' => $question->id,
            'checkbox' => $this->generateCheckboxElement($question),
            'content' => $question->content,
            // 'slug' => $question->slug,
            'question_type' => __('LMS::attributes.questions.'.$question->question_type),
            'correct_answer' =>formatArrayAsLabels($question->answers->where('is_correct','=','1')->pluck('title')),
            'status' => formatStatusAsLabels($question->status > 0?'active': 'inactive'),
            'updated_at' => format_date($question->updated_at),
            'action' => $this->actions($question,$actions,$url)
        ];
    }


}