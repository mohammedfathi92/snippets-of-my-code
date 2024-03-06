<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\LMS\Models\Quiz;

class QuizRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Quiz::class);

        return $this->isAuthorized();
    }

    /** 
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Quiz::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title' => 'required',
                'content' => 'required',
               // 'status' => 'required',
                'price' => 'required',
                'passing_grade' => 'required',
                'retake_count' => 'required',
                'author_id' => 'required',

            ]);
        }

            if ($this->isStore()) {
            $rules = array_merge($rules, [
               // 'slug' => 'required|max:191|unique:lms_quizzes,slug'
            ]);
        }

        if ($this->isUpdate()) {
            $quiz = $this->route('quiz');

            $rules = array_merge($rules, [
               // 'slug' => 'required|max:191|unique:lms_quizzes,slug,' . $quiz->id,
            ]);
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
