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

class QuestionTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.question.resource_url');

        parent::__construct();
    }

    /**
     * @param Question $question
     * @return array
     * @throws \Throwable
     */
    public function transform(Question $question)
    {
        return [
            'id' => $question->id,
            'checkbox' => $this->generateCheckboxElement($question),

            'content' => $question->content,
            // 'slug' => $question->slug,
            'question_type' => __('LMS::attributes.questions.'.$question->question_type),
            'correct_answer' =>formatArrayAsLabels($question->answers->where('is_correct','=','1')->pluck('title')),
            'status' => formatStatusAsLabels($question->status > 0?'active': 'inactive'),
            'updated_at' => format_date($question->updated_at),
            'action' => $this->actions($question)
        ];
    }


}