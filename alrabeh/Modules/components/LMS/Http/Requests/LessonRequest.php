<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\LMS\Models\Lesson;

class LessonRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Lesson::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Lesson::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title' => 'required',
                'content' => 'required',
                'status' => 'required',
            ]);
        }

            if ($this->isStore()) {
            $rules = array_merge($rules, [
                // 'slug' => 'required|max:191|unique:lms_lessons,slug'
            ]);
        }

        if ($this->isUpdate()) {
            $lesson = $this->route('lesson');

            $rules = array_merge($rules, [
                // 'slug' => 'required|max:191|unique:lms_lessons,slug,' . $lesson->id,
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
