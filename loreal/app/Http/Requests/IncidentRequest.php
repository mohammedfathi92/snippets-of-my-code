<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncidentRequest extends FormRequest
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
            "reporter_id"         => 'required',
            "incident_date"       => 'required',
            "time_between"        => 'required',
            "incident_nature"     => 'required',
            "incident_place"      => 'required',
            "incident_type"       => 'required',
            "injured_person_type" => 'required',
            "lost_days"           => 'required',
            "duty_days"           => 'required',
            "consequences"        => "required",
            "lesions_nature"      => 'required',
            "lesions_location"    => 'required',
            "causes_analysis"     => 'required',
            "description_causes"  => 'required',
            "actions_plans"       => 'required',

        ];
    }
}
