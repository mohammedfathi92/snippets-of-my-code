<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Place;

class PlaceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Place::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Place::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'        => 'required',
                'city_id'     => 'required',
                'country_id'  =>'required',
                'category_id'  =>'required',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191unique:erp_places,reg_code',
            ]);
        }

        if ($this->isUpdate()) {
            $place = $this->route('place');

            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191|unique:erp_places,reg_code,'.$place->id,
            ]);
        }

        return $rules;
    }
}
