<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\LMS\Models\Course;

class CourseRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Course::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Course::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title' => 'required|max:191',
                'content' => 'required',
               // 'categories' => 'required',
                'featured_image' => 'mimes:jpg,jpeg,png|max:' . maxUploadFileSize()
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                // 'slug' => 'required|max:191|unique:lms_courses,slug'
            ]);
        }

        if ($this->isUpdate()) {
            $course = $this->route('course');

            $rules = array_merge($rules, [
                // 'slug' => 'required|max:191|unique:lms_courses,slug,' . $course->id,
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

        // if (isset($data['slug'])) {
        //     $data['slug'] = str_slug($data['slug']);
        // }

        // $data['published'] = array_get($data, 'published', false);
        // $data['private'] = array_get($data, 'private', false);

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
