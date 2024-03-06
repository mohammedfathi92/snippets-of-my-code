<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\ServicePrice;


class ServicePriceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(ServicePrice::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(ServicePrice::class);
      
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'start_date'             => 'required|date',
                'name.*'            => 'required',
                'currency_id'            => 'required|integer',
                'country_id'        => 'required|integer',
                'city_id'           => 'required|integer',
               
                'cost'             => 'required|numeric',   
               
                'price'            => 'required|numeric',   
               
                'status'          => 'required',

                
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {
            $service = $this->route('serviceprices');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
