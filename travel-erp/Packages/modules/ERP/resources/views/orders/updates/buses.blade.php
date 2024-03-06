
<div id="buses_orders">

    @foreach($orderBusesList as $busOrder)

<div id="row_buses_{{$loop->index}}" class="bus-row general-row" style="background-color: #eff{{$loop->index}}f1; padding: 10px;" data-index="{{$loop->index}}">
   <div class="alert alert-danger" style="display: none;" id="alert_row_buses_{{$loop->index}}">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
                     <input type="hidden" name="buses[{{$loop->index}}][bus_order_id]" value="{{$busOrder->hashed_id}}">
    <input type="hidden" value="true" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_buses_{{$loop->index}}_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="buses[{{$loop->index}}][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                @for($i=1; $i < $order->duration; $i++)
                <option value="{{$i}}" @if($i == $busOrder->order_day) selected="true" @endif>{{$i}}</option>
                @endfor
              </select>
               <input type="hidden" class="hidden_day_val" value="{{$busOrder->order_day}}">
          </div>



 <div class="form-group col-md-2">
            <label for="row_buses_{{$loop->index}}_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_buses_{{$loop->index}}_provider" name="buses[{{$loop->index}}][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}" @if($busOrder->provider_id == $key) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
  </div>

          
           <div class="form-group col-md-2">
            <label for="row_buses_{{$loop->index}}_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_buses_{{$loop->index}}_from_country" name="buses[{{$loop->index}}][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_buses_{{$loop->index}}_from_city' data-select2_class= 'with-select2'  data-closest_class ='bus-row' data-item_type='countries' data-currency_div_id="row_buses_{{$loop->index}}_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" @if($busOrder->from_country_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_buses_{{$loop->index}}_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select2 cities-list_1 with-dest-city get_places_cat" id="row_buses_{{$loop->index}}_from_city" name="buses[{{$loop->index}}][from_city_id]" data-place_cat_id="row_buses_{{$loop->index}}_source_type" data-place_id="row_buses_{{$loop->index}}_source_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach(\ERP::getCitiesListByCountry($busOrder->from_country_id) as $key => $value)
               <option value="{{$key}}" @if($key == $busOrder->from_city_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>


           <div class="form-group col-md-2">
            <label for="row_buses_{{$loop->index}}_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_buses_{{$loop->index}}_to_country" name="buses[{{$loop->index}}][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_buses_{{$loop->index}}_to_city' data-select2_class= 'with-select2'  data-closest_class ='bus-row' data-item_type='countries' data-currency_div_id="row_buses_{{$loop->index}}_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}"  data-currency="{{$row->currency_id}}" @if($busOrder->to_country_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach

              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_buses_{{$loop->index}}_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select2 cities-list_2 with-dest-city get_places_cat" id="row_buses_{{$loop->index}}_to_city" name="buses[{{$loop->index}}][to_city_id]" data-place_cat_id="row_buses_{{$loop->index}}_target_type" data-place_id="row_buses_{{$loop->index}}_target_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            @foreach(\ERP::getCitiesListByCountry($busOrder->to_city_id) as $key => $value)
               <option value="{{$key}}" @if($key == $busOrder->to_city_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>


      
           </div> {{-- end row --}}

           <div class="row">



         

        <div class="form-group col-md-2 required-field">
            <label for="row_buses_{{$loop->index}}_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_buses_{{$loop->index}}_leave_date" type="text" name="buses[{{$loop->index}}][leave_date]" class="form-control start-date-input datepicker" readonly="" value="{{$busOrder->leave_date}}">
            </div>
        <div class="form-group col-md-2">
            <label for="row_buses_{{$loop->index}}_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_buses_{{$loop->index}}_leave_time" type="text" name="buses[{{$loop->index}}][leave_time]" class="form-control leave-time-input timepicker"  value="{{$busOrder->leave_time}}">
            </div>

                                <div class="form-group col-md-2 required-field">
            <label for="row_buses_{{$loop->index}}_buses">{{__('ERP::attributes.main.bus')}}</label>
               <select class="form-control selected-service with-select2" id="row_buses_{{$loop->index}}_buses" name="buses[{{$loop->index}}][transport_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($buses as $key => $value)
              <option value="{{$key}}" @if($key = $busOrder->transport_id) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
        </div>

         <div class="form-group col-md-2 required-field">
            <label for="row_buses_{{$loop->index}}_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_buses_{{$loop->index}}_value_currency_id" name="buses[{{$loop->index}}][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}"  @if($row->id == $busOrder->new_currency_id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_buses_{{$loop->index}}_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_buses_{{$loop->index}}_value_currency_rate" type="number" name="buses[{{$loop->index}}][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001"  value="{{$busOrder->new_currency_rate}}">
          </div>

           <input type="hidden" name="buses[{{$loop->index}}][old_currency_id]" class="orig-exchange-id"  value="{{$busOrder->old_currency_id}}">

           <input type="hidden" name="buses[{{$loop->index}}][old_currency_rate]" class="orig-exchange-rate" step=".000000001"   value="{{$busOrder->old_currency_rate}}">

          <input type="hidden" name="buses[{{$loop->index}}][main_currency_rate]" value="{{$busOrder->main_currency_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="buses[{{$loop->index}}][main_currency_id]" value="{{$busOrder->main_currency_id}}" class="main-currency-id">

           <div class="form-group col-md-2 required-field">
            <label for="row_buses_{{$loop->index}}_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control bus_price_type" id="row_buses_{{$loop->index}}_price_type" name="buses[{{$loop->index}}][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}" @if($key == $busOrder->price_type) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

         
   
           </div> {{-- end row --}}

             <div class="row">
      <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_adults_number">{{__('ERP::attributes.order.adult_numbers')}}</label>
          <input id="row_buses_{{$loop->index}}_adults_number" type="number" name="buses[{{$loop->index}}][adult_numbers]" placeholder="0" class="form-control adult_numbers general_price_input_group" value="{{$busOrder->adult_numbers}}">
       </div>
     <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_adult_price">{{__('ERP::attributes.flight.price_adult')}}</label>
          <input id="row_buses_{{$loop->index}}_adult_price" type="number" name="buses[{{$loop->index}}][adult_price]" placeholder="00.00" class="form-control adult_price general_price_input_group" step=".01" value="{{$busOrder->adult_price}}">
       </div>
       <input type="hidden" name="buses[{{$loop->index}}][auto_adult_price]" class="auto_adult_price"  value="{{$busOrder->auto_adult_price}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_adult_cost">{{__('ERP::attributes.flight.cost_adult')}}</label>
          <input id="row_buses_{{$loop->index}}_adult_cost" type="number" name="buses[{{$loop->index}}][adult_cost]" placeholder="00.00" class="form-control adult_cost general_price_input_group" step=".01" value="{{$busOrder->adult_cost}}">
       </div>

        <input type="hidden" name="buses[{{$loop->index}}][auto_adult_cost]" class="auto_adult_cost"  value="{{$busOrder->auto_adult_cost}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_child_number">{{__('ERP::attributes.order.child_numbers')}}</label>
          <input id="row_buses_{{$loop->index}}_child_number" type="number" name="buses[{{$loop->index}}][child_numbers]" placeholder="0" class="form-control child_numbers general_price_input_group" value="{{$busOrder->child_numbers}}">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_child_price">{{__('ERP::attributes.flight.price_child')}}</label>
          <input id="row_buses_{{$loop->index}}_child_price" type="number" name="buses[{{$loop->index}}][child_price]" placeholder="00.00" class="form-control child_price general_price_input_group" step=".01"  value="{{$busOrder->child_price}}">

       </div>
       <input type="hidden" name="buses[{{$loop->index}}][auto_child_price]" class="auto_child_price" value="{{$busOrder->auto_child_price}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_child_cost">{{__('ERP::attributes.flight.cost_child')}}</label>
          <input id="row_buses_{{$loop->index}}_child_cost" type="number" name="buses[{{$loop->index}}][child_cost]" placeholder="00.00" class="form-control child_cost general_price_input_group" step=".01" value="{{$busOrder->child_cost}}">
       </div>
       <input type="hidden" name="buses[{{$loop->index}}][auto_child_cost]" class="auto_child_cost"  value="{{$busOrder->auto_child_cost}}">
  </div> {{-- end row --}}
<div class="row">
         <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_infant_number">{{__('ERP::attributes.order.infant_numbers')}}</label>
          <input id="row_buses_{{$loop->index}}_infant_number" type="number" name="buses[{{$loop->index}}][infant_numbers]" placeholder="0" class="form-control infant_numbers general_price_input_group"  value="{{$busOrder->infant_numbers}}">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_infant_price">{{__('ERP::attributes.flight.price_infant')}}</label>
          <input id="row_buses_{{$loop->index}}_infant_price" type="number" name="buses[{{$loop->index}}][infant_price]" placeholder="00.00" class="form-control infant_price general_price_input_group" step=".01" value="{{$busOrder->infant_price}}">
       </div>

        <input type="hidden" name="buses[{{$loop->index}}][auto_infant_price]" class="auto_infant_price"  value="{{$busOrder->auto_infant_price}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_infant_cost">{{__('ERP::attributes.flight.cost_infant')}}</label>
          <input id="row_buses_{{$loop->index}}_infant_cost" type="number" name="buses[{{$loop->index}}][infant_cost]" placeholder="00.00" class="form-control infant_cost general_price_input_group" step=".01" value="{{$busOrder->infant_cost}}">
       </div>
        <input type="hidden" name="buses[{{$loop->index}}][auto_infant_cost]" class="auto_infant_cost"  value="{{$busOrder->auto_infant_cost}}">

        <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_baggage_weight">{{__('ERP::attributes.flight.baggage_weight')}}</label>
          <input id="row_buses_{{$loop->index}}_baggage_weight" type="number" name="buses[{{$loop->index}}][baggage_weight]" placeholder="00.00" class="form-control baggage_weight general_price_input_group" step=".01" value="{{$busOrder->baggage_weight}}">
       </div>

        <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_baggage_price">{{__('ERP::attributes.flight.baggage_price')}}</label>
          <input id="row_buses_{{$loop->index}}_baggage_price" type="number" name="buses[{{$loop->index}}][baggage_price]" placeholder="00.00" class="form-control baggage_price general_price_input_group" step=".01" value="{{$busOrder->baggage_price}}">
          <input type="hidden" name="buses[{{$loop->index}}][auto_baggage_price]" class="auto_baggage_price"  value="{{$busOrder->auto_baggage_price}}">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_{{$loop->index}}_baggage_cost">{{__('ERP::attributes.flight.baggage_cost')}}</label>
          <input id="row_buses_{{$loop->index}}_baggage_cost" type="number" name="buses[{{$loop->index}}][baggage_cost]" placeholder="00.00" class="form-control baggage_cost general_price_input_group" step=".01"   value="{{$busOrder->baggage_cost}}">
       </div>

        <input type="hidden" name="buses[{{$loop->index}}][auto_baggage_cost]" class="auto_baggage_cost" value="{{$busOrder->auto_baggage_cost}}">

      
        </div> {{-- end row --}}

          <div class="row">

          @php

        $total_price = ($busOrder->adult_price *  $busOrder->adult_numbers)+ ($busOrder->child_price *  $busOrder->child_numbers) + ($busOrder->infant_numbers * $busOrder->infant_price) + ($busOrder->baggage_weight * $busOrder->baggage_price);
        $total_cost = ($busOrder->adult_cost *  $busOrder->adult_numbers)+ ($busOrder->child_cost *  $busOrder->child_numbers) + ($busOrder->infant_numbers * $busOrder->infant_cost) + ($busOrder->baggage_weight * $busOrder->baggage_cost);

        @endphp
  
         


          <div class="form-group col-md-2">
                   <label for="row_buses_{{$loop->index}}_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_buses_{{$loop->index}}_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="" value="{{$total_price}}">
          </div>


          <div class="form-group col-md-2">
                   <label for="row_buses_{{$loop->index}}_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_buses_{{$loop->index}}_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly=""  value="{{$total_cost}}">
          </div>

                          <div class="form-group col-md-2">
            <label for="row_buses_{{$loop->index}}_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_buses_{{$loop->index}}_due_date" type="text" name="buses[{{$loop->index}}][due_date]" class="form-control datepicker" value="{{$busOrder->due_date}}">
            </div>

              <div class="form-group col-md-2">
                   <label for="row_buses_{{$loop->index}}_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_buses_{{$loop->index}}_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="buses[{{$loop->index}}][prepay_percent]" value="{{$busOrder->prepay_percent}}">
        </div>

                           <div class="form-group col-md-2">
                   <label for="row_buses_{{$loop->index}}_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_buses_{{$loop->index}}_reg_code" type="text" name="buses[{{$loop->index}}][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}"  value="{{$busOrder->booking_code}}">
          </div>
         
          <div class="form-group col-md-2">
            <label for="row_buses_{{$loop->index}}_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_buses_{{$loop->index}}_notes" type="text" name="buses[{{$loop->index}}][booking_notes]" class="form-control" value="{{$busOrder->booking_notes}}">
          </div>


           



     </div> {{-- end row --}}



     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="bus"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-row-btn active btn btn-danger" data-row_id="row_buses_{{$loop->index}}" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
@endforeach
</div>
   <div class="row">
    <div class="col-md-12">
            <center>
                <button class="btn btn-info ladda-button new-general-row-btn" type="button" data-main_row_id="buses_orders" data-main_row_class="bus-row" data-main_row_prefix="row_buses_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



