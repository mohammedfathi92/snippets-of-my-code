<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MesurRequest extends FormRequest
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
            'leader_id'         => "required|integer",
            'co_leader_id'      => "required|integer",
            'copy_to_id'        => "required",
            'person_visited'    => "required",
            // 'datepicker'        => "required",
            'visited_area_id'   => "required",
            // 'username'          => "required",
            'visited_date'      => "required",
            'visit_preparation' => "required",
            'visit_topic'       => "required",
            'observations'      => "required",
            'actions'           => "required",

        ];
    }
}
