<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Hotel;

class HotelRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Hotel::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Hotel::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'      => 'required',
                'city_id'   => 'required',
                'country_id' =>'required',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191unique:erp_hotels,reg_code',

            ]);
        }

        if ($this->isUpdate()) {
            $hotel = $this->route('hotel');
            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191|unique:erp_hotels,reg_code,'.$hotel->id,

            ]);
        }

        return $rules;
    }
}
