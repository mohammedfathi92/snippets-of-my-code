<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Order;

class OrderRequest extends BaseRequest
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
      
        if ($this->isUpdate() || $this->isStore()) {
            
            $rules = array_merge($rules, [
              "general_data.purpose_id"    => 'required|integer',
               "general_data.destination_id"    => 'required|integer',
               "general_data.branch_id"    => 'required|integer',
               "general_data.customer_id"    => 'required|integer',
               "general_data.currency_id"    => 'required|integer',
               "general_data.manual_currency_rate"    => 'required|numeric',
               "general_data.order_date"    => 'required|date',
               "general_data.start_date"    => 'required|date',
               "general_data.end_date"    => 'required|date',
               "general_data.duration"    => 'required|integer',
               "general_data.status"    => 'required|integer',
                
               //hotels validation
               "hotels.*.room_id"    => 'required|integer',
               "hotels.*.order_day"    => 'required|integer',
               "hotels.*.room_price"    => 'required|numeric',
               "hotels.*.room_cost"    => 'required|numeric',
               "hotels.*.rooms_num"    => 'required|integer',
               "hotels.*.checkin"    => 'required|date',
               "hotels.*.checkout"    => 'required|date',
               "hotels.*.nights"    => 'required|integer',
               "hotels.*.new_currency_id"    => 'required|integer',
               "hotels.*.new_currency_rate"    => 'required|numeric',
               "hotels.*.room_price_type"    => 'required',

              //manual hotels validation
               "manual_hotels.*.hotel_name.*"    => 'required|max:191',
               "manual_hotels.*.category_id"    => 'required|integer',
               "manual_hotels.*.room_name.*"    => 'required|max:191',
               "manual_hotels.*.city_id"    => 'required|integer',
               "manual_hotels.*.country_id"    => 'required|integer',

               "manual_hotels.*.order_day"    => 'required|integer',
               "manual_hotels.*.room_cost"    => 'required|numeric',
               "manual_hotels.*.room_price"    => 'required|numeric',
               "manual_hotels.*.rooms_num"    => 'required|integer',
               "manual_hotels.*.checkin"    => 'required|date',
               "manual_hotels.*.checkout"    => 'required|date',
               "manual_hotels.*.nights"    => 'required|integer',
               "manual_hotels.*.new_currency_id"    => 'required|integer',
               "manual_hotels.*.new_currency_rate"    => 'required|numeric',
               "manual_hotels.*.room_price_type"    => 'required',

               //flight validation
               "flights.*.order_day"    => 'required|integer',
               "flights.*.from_airport_id"    => 'required|integer',
               "flights.*.to_airport_id"    => 'required|integer',
               "flights.*.airline_id"    => 'required|integer',
               "flights.*.leave_date"    => 'required|date',
               "flights.*.adult_numbers"    => 'required|integer',
               "flights.*.adult_price"    => 'required|numeric',
               "flights.*.child_numbers"    => 'required|integer',
               "flights.*.child_price"    => 'required|numeric',
               "flights.*.baggage_weight"    => 'required|numeric',
               "flights.*.baggage_price"    => 'required|numeric',
               "flights.*.adult_cost"    => 'required|numeric',
               "flights.*.child_cost"    => 'required|numeric',
               "flights.*.infant_cost"    => 'required|numeric',
               "flights.*.infant_price"    => 'required|numeric',
               "flights.*.infant_numbers"    => 'required|numeric',
               "flights.*.baggage_cost"    => 'required|numeric',
               "flights.*.price_type"    => 'required',
               "flights.*.new_currency_id"    => 'required|integer',
               "flights.*.new_currency_rate"    => 'required|numeric',

              //ferry validation
               "ferries.*.order_day"    => 'required|integer',
               "ferries.*.from_city_id"    => 'required|integer',
               "ferries.*.to_city_id"    => 'required|integer',
               "ferries.*.transport_id"    => 'required|integer',
               "ferries.*.leave_date"    => 'required|date',
               "ferries.*.adult_numbers"    => 'required|integer',
               "ferries.*.adult_price"    => 'required|numeric',
               "ferries.*.child_numbers"    => 'required|integer',
               "ferries.*.child_price"    => 'required|numeric',
               "ferries.*.baggage_weight"    => 'required|numeric',
               "ferries.*.baggage_price"    => 'required|numeric',
               "ferries.*.adult_cost"    => 'required|numeric',
               "ferries.*.child_cost"    => 'required|numeric',
               "ferries.*.infant_cost"    => 'required|numeric',
               "ferries.*.infant_price"    => 'required|numeric',
               "ferries.*.infant_numbers"    => 'required|numeric',
               "ferries.*.baggage_cost"    => 'required|numeric',
               "ferries.*.price_type"    => 'required',
               "ferries.*.new_currency_id"    => 'required|integer',
               "ferries.*.new_currency_rate"    => 'required|numeric',

              //bus validation
               "buses.*.order_day"    => 'required|integer',
               "buses.*.from_city_id"    => 'required|integer',
                "buses.*.to_city_id"    => 'required|integer',
               // "buses.*.sourcable_id"    => 'required|integer',
               // "buses.*.sourcable_type"    => 'required',
               // "buses.*.targetable_id"    => 'required|integer',
               // "buses.*.targetable_type"    => 'required',
               "buses.*.transport_id"    => 'required|integer',
               "buses.*.leave_date"    => 'required|date',
               "buses.*.adult_numbers"    => 'required|integer',
               "buses.*.adult_price"    => 'required|numeric',
               "buses.*.child_numbers"    => 'required|integer',
               "buses.*.child_price"    => 'required|numeric',
               "buses.*.baggage_weight"    => 'required|numeric',
               "buses.*.baggage_price"    => 'required|numeric',
               "buses.*.adult_cost"    => 'required|numeric',
               "buses.*.child_cost"    => 'required|numeric',
               "buses.*.baggage_cost"    => 'required|numeric',
               "buses.*.price_type"    => 'required',
               "buses.*.new_currency_id"    => 'required|integer',
               "buses.*.new_currency_rate"    => 'required|numeric',

               // transport validation
               "transports.*.order_day"    => 'required|integer',
               "transports.*.sourcable_id"    => 'required|integer',
               "transports.*.sourcable_type"    => 'required',
               "transports.*.targetable_id"    => 'required|integer',
               "transports.*.targetable_type"    => 'required',
               "transports.*.vehicle_type_id"    => 'required|integer',
               "transports.*.leave_date"    => 'required|date',
               "transports.*.vehicle_price"    => 'required|numeric',
               "transports.*.vehicle_cost"    => 'required|numeric',
               "transports.*.vehicles_num"    => 'required|integer',
               // "transports.*.hours_num"    => 'required|integer',
               "transports.*.price_type"    => 'required',
               "transports.*.new_currency_id"    => 'required|integer',
               "transports.*.new_currency_rate"    => 'required|numeric',


              //activity validation
               "activities.*.order_day"    => 'required|integer',
               "activities.*.activity_id"    => 'required|integer',
               "activities.*.start_date"    => 'required|date',
               "activities.*.adult_numbers"    => 'required|integer',
               "activities.*.adult_price"    => 'required|numeric',
               "activities.*.child_numbers"    => 'required|integer',
               "activities.*.child_price"    => 'required|numeric',
               "activities.*.adult_cost"    => 'required|numeric',
               "activities.*.child_cost"    => 'required|numeric',
               "activities.*.infant_cost"    => 'required|numeric',
               "activities.*.infant_price"    => 'required|numeric',
               "activities.*.infant_numbers"    => 'required|numeric',
               "activities.*.price_type"    => 'required',
               "activities.*.new_currency_id"    => 'required|integer',
               "activities.*.new_currency_rate"    => 'required|numeric',

              //Service validation
               "services.*.order_day"    => 'required|integer',
               "services.*.service_id"    => 'required|integer',
               "services.*.start_date"    => 'required|date',
               "services.*.quantity"    => 'required|integer',
               "services.*.price"    => 'required|numeric',
               "services.*.cost"    => 'required|numeric',
               "services.*.price_type"    => 'required',
               "services.*.new_currency_id"    => 'required|integer',
               "services.*.new_currency_rate"    => 'required|numeric',

              //manual service validation
               "manual_services.*.order_day"    => 'required|integer',
               "manual_services.*.country_id"    => 'required|integer',
               "manual_services.*.city_id"    => 'required|integer',
               "manual_services.*.service_name.*"    => 'required',
               "manual_services.*.start_date"    => 'required|date',
               "manual_services.*.quantity"    => 'required|integer',
               "manual_services.*.price"    => 'required|numeric',
               "manual_services.*.cost"    => 'required|numeric',
               "manual_services.*.price_type"    => 'required',
               "manual_services.*.new_currency_id"    => 'required|integer',
               "manual_services.*.new_currency_rate"    => 'required|numeric',

            ]);

        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
              'general_data.reg_code'=> 'nullable|max:191|unique:erp_orders,reg_code',


            ]);
        }

        if ($this->isUpdate()) {
            $hashed_id = $this->route('order');
          $id = hashids_decode($hashed_id);
        $order = Order::find($id);


            $rules = array_merge($rules, [
                'general_data.reg_code'=> 'required|max:191|unique:erp_orders,reg_code,'.$order->id,
            ]);
        }

        return $rules;
    }
}
