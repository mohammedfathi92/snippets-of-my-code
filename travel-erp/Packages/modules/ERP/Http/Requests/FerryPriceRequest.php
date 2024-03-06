<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\FerryPrice;


class FerryPriceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(FerryPrice::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(FerryPrice::class);
      
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'start_date'             => 'required|date',
                'name.*'            => 'required',
                'transport_id'            => 'required|integer',
                'currency_id'            => 'required|integer',
                'from_country_id'        => 'required|integer',
                'from_city_id'           => 'required|integer',
                'to_country_id'          => 'required|integer',
                'to_city_id'             => 'required|integer',
                'cost_adult'             => 'nullable|numeric',   
                'cost_child'             => 'nullable|numeric',
                'cost_infant'            => 'nullable|numeric',
                'price_adult'            => 'nullable|numeric',   
                'price_child'            => 'nullable|numeric',
                'price_infant'           => 'nullable|numeric',
                'status'          => 'required',
 
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [

            ]);
        }

        if ($this->isUpdate()) {
            $flight = $this->route('ferryprices');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
