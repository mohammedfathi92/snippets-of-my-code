<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\TransportPrice;


class TransportPriceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $this->setModel(TransportPrice::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         $this->setModel(TransportPrice::class);
      
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'                 => 'required',

                'from_country_id'        => 'required|integer',
                'to_country_id'          => 'required|integer',
                'from_city_id'           => 'required|integer',
                'to_city_id'             => 'required|integer',
                'sourcable_id'           => 'required|integer',
                'sourcable_type'             => 'required',


                'targetable_id'           => 'required|integer',
                'targetable_type'             => 'required',

                'vehicles.*.cost'        => 'required|numeric',
                'vehicles.*.price'       => 'required|numeric',
                'vehicles.*.commission_one'         => 'numeric',
                'vehicles.*.commission_two'         => 'numeric',
                
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            'reg_code'=> 'nullable|max:191|unique:erp_transport_prices,reg_code',
            ]);
        }

        if ($this->isUpdate()) {
            $hashed_id = $this->route('transport');
            $transport = TransportPrice::find(hashids_decode($hashed_id));

            $rules = array_merge($rules, [
            'reg_code'=> 'required|max:191|unique:erp_transport_prices,reg_code,'.$transport->id,
            ]);
        }

        return $rules;
    }
}
