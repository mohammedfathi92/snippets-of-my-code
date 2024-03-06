<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Order;

class PackageRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Order::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Order::class);
        $rules = parent::rules();
      
      // hotels validatation 

      foreach ($this->request->get('hotels', []) as $index => $item) {
        $country_id = $this->request->get('hotels')[$index]['country_id'];
        //dd($this->request->all());

        if($country_id){
             $rules = array_merge($rules, [
              "hotels.{$index}.package_type"  => 'required',
              "hotels.{$index}.country_id"    => 'required|numeric',
              "hotels.{$index}.city_id"       => 'required|numeric',
              "hotels.{$index}.hotel_id"      => 'required|numeric',
              "hotels.{$index}.room_id"       => 'required|numeric',
              "hotels.{$index}.rooms_num"     => 'required|numeric',
             // "hotels.{$index}.entry_date"    => 'required|date',
              //"hotels.{$index}.leave_date"    => 'required|date',
              "hotels.{$index}.days_numbers"  => 'required',
             // "hotels.{$index}.price_type"    => 'required',
              "hotels.{$index}.room_price"    => 'required|numeric',
              "hotels.{$index}.final_price"   => 'required|numeric',
              "hotels.{$index}.tax"           => 'required|numeric',
              "hotels.{$index}.prepay_percent"    => 'required|numeric',
            ]);

        }
       
      }

      // flights validatation 
      foreach ($this->request->get('flights', []) as $index => $item) {
        $country_id = $this->request->get('flights')[$index]['from_country_id'];
       // dd($this->request->get('flights'));

        if($country_id){
             $rules = array_merge($rules, [
              "flights.{$index}.package_type"             => 'required',
              "flights.{$index}.type"             => 'required',
              "flights.{$index}.from_country_id"  => 'required|numeric',
              "flights.{$index}.to_country_id"    => 'required|numeric',
              "flights.{$index}.from_city_id"     => 'required|numeric',
              "flights.{$index}.to_city_id"       => 'required|numeric',
              "flights.{$index}.final_price"      => 'required|numeric',
              "flights.{$index}.tax"              => 'required|numeric',
              "flights.{$index}.prepay_percent"       => 'required|numeric',
              
            ]);

        }
       
      }


       // transports validatation 
      foreach ($this->request->get('transports', []) as $index => $item) {
        $country_id = $this->request->get('transports')[$index]['country_id'];
       // dd($this->request->get('transports'));

        if($country_id){
             $rules = array_merge($rules, [
              "transports.{$index}.country_id"    => 'required|numeric',
              "transports.{$index}.from_city_id"  => 'required|numeric',
              "transports.{$index}.package_type"   => 'required',
              "transports.{$index}.from_source"   => 'required',
              "transports.{$index}.source_name"   => 'required|numeric',
              "transports.{$index}.to_city_id"    => 'required|numeric',
              "transports.{$index}.to_source"     => 'required',
              "transports.{$index}.target_name"   => 'required|numeric',
              "transports.{$index}.vehicle_id"    => 'required|numeric',
              "transports.{$index}.final_price"   => 'required|numeric',
              "transports.{$index}.tax"           => 'required|numeric',
              "transports.{$index}.prepay_percent"    => 'required|numeric',
            ]);

        }
       
      }

       
        

        if ($this->isUpdate() || $this->isStore()) {
            
            $rules = array_merge($rules, [
                 'order_code'             => 'required|unique:erp_orders,order_code',
                 'agent_id'               => 'required|numeric',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {
            $order = $this->route('order');

           $id = $this->request->get('id') ? ',' . $this->request->get('id') : '';

            $rules = array_merge($rules, [
              'order_code'             => 'required|unique:erp_orders,id,'.$id

            ]);
        }

        return $rules;
    }
}
