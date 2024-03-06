<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Country;

class CountryRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Country::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Country::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*' => 'required',

            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'code' => 'nullable|max:191|unique:erp_countries,code',
            ]);
        }

        if ($this->isUpdate()) {
            $country = $this->route('country');

            $rules = array_merge($rules, [
                'code' => 'nullable|max:191|unique:erp_countries,code,'.$country->id,
            ]);
        }

        return $rules;
    }
}
