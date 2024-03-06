<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\LMS\Models\Testimonial;

class TestimonialRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Testimonial::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Testimonial::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'title' => 'required',
                'user_name' => 'required',
            ]);
        }

            if ($this->isStore()) {
            $rules = array_merge($rules, [
                
            ]);
        }

        if ($this->isUpdate()) {
            $testimonial = $this->route('testimonial');

            $rules = array_merge($rules, [
               
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
