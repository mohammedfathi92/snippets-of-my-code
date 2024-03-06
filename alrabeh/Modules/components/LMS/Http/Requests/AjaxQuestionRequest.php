<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Components\LMS\Models\Question;
use Modules\Foundation\Http\Requests\BaseRequest;

class AjaxQuestionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Question::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Question::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title'         => 'required',
                'status'        => 'required',
                'content'       => 'required',
                'question_type' => 'required',
            ]);

            if($this->get('question_type') != 'paragraph'){

            foreach ($this->get('answers', []) as $id => $item) {
                $rules = array_merge($rules, [
                    "answers.{$id}.title" => 'required',
                ]);
            }

            }
        }

        return $rules;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $data = $this->all();

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
