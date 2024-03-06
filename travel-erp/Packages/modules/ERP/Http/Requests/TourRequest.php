<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Tour;

class TourRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Tour::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Tour::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'        => 'required',
                'country_id'=> 'required|integer',
                'city_id'     => 'required|integer',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [

           'reg_code'=> 'nullable|max:191|unique:erp_tours,reg_code',
            ]);
        }

        if ($this->isUpdate()) {
            $tour = $this->route('tour');

            $rules = array_merge($rules, [
                 'reg_code'=> 'required|max:191|unique:erp_tours,reg_code,'.$tour->id,
            ]);
        }

        return $rules;
    }
}
