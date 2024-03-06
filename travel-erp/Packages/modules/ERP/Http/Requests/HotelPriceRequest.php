<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\HotelPrice;


class HotelPriceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(HotelPrice::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(HotelPrice::class);
      
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'                 => 'required',
                'season'           => 'required|integer',
                'price'           => 'required|numeric',
                'start_date'           => 'required|date',
                'end_date'             => 'required|date|after_or_equal:start_date',
                'country_id'             => 'required|integer',   
                'city_id'                => 'required|integer',   
                'hotel_id'               => 'required|integer',   
                'room_id'                => 'required|integer',  
                'dates.*.from_date'      => 'required|date',  
                'dates.*.to_date'      => 'required|date|after_or_equal:dates.*.from_date',  
                
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            'reg_code'=> 'required|max:191|unique:erp_hotel_prices,reg_code',
            ]);
        }

        if ($this->isUpdate()) {
            $hashed_id = $this->route('hotel');
            $hotel = HotelPrice::find(hashids_decode($hashed_id));

            $rules = array_merge($rules, [
            'reg_code'=> 'required|max:191|unique:erp_hotel_prices,reg_code,'.$hotel->id,
            ]);
        }

        return $rules;
    }
}
