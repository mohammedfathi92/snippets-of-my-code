<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_type'   => 'required',
            'employee_id' => 'nullable|required_if:user_type,employee|exists:qps.vw_emp,empno',
            'io_type'     => 'required',
            'guest_name'  => 'nullable|required_if:user_type,guest|max:100|min:3',
            'area'        => 'required',
            'location'    => 'required',
            'description' => 'required',
            'suggestion'  => 'required',

        ];
    }
}
