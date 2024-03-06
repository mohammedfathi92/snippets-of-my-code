
<div id="buses_orders">

<div id="row_buses_0" class="bus-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="0">
   <div class="alert alert-danger" style="display: none;" id="alert_row_buses_0">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
    <input type="hidden" value="true" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_buses_0_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="buses[0][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>



 <div class="form-group col-md-2">
            <label for="row_buses_0_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_buses_0_provider" name="buses[0][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
  </div>

          
           <div class="form-group col-md-2">
            <label for="row_buses_0_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_buses_0_from_country" name="buses[0][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_buses_0_from_city' data-select2_class= 'with-select2'  data-closest_class ='bus-row' data-item_type='countries' data-currency_div_id="row_buses_0_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_buses_0_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select2 cities-list_1 with-dest-city get_places_cat" id="row_buses_0_from_city" name="buses[0][from_city_id]" data-place_cat_id="row_buses_0_source_type" data-place_id="row_buses_0_source_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

                   <div class="form-group col-md-2">
            <label for="row_buses_0_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_buses_0_to_country" name="buses[0][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_buses_0_to_city' data-select2_class= 'with-select2'  data-closest_class ='bus-row' data-item_type='countries' data-currency_div_id="row_buses_0_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_buses_0_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select2 cities-list_2 with-dest-city get_places_cat" id="row_buses_0_to_city" name="buses[0][to_city_id]" data-place_cat_id="row_buses_0_target_type" data-place_id="row_buses_0_target_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>
  



      
           </div> {{-- end row --}}

           <div class="row">


        <div class="form-group col-md-2 required-field">
            <label for="row_buses_0_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_buses_0_leave_date" type="text" name="buses[0][leave_date]" class="form-control start-date-input datepicker" readonly="">
            </div>
        <div class="form-group col-md-2">
            <label for="row_buses_0_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_buses_0_leave_time" type="text" name="buses[0][leave_time]" class="form-control leave-time-input timepicker" >
            </div>

                      <div class="form-group col-md-2 required-field">
            <label for="row_buses_0_buses">{{__('ERP::attributes.main.bus')}}</label>
               <select class="form-control selected-service with-select2" id="row_buses_0_buses" name="buses[0][transport_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($buses as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>

                    <div class="form-group col-md-2 required-field">
            <label for="row_buses_0_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_buses_0_value_currency_id" name="buses[0][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_buses_0_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_buses_0_value_currency_rate" type="number" name="buses[0][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="buses[0][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="buses[0][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="buses[0][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="buses[0][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">




           <div class="form-group col-md-2 required-field">
            <label for="row_buses_0_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control bus_price_type" id="row_buses_0_price_type" name="buses[0][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>





           </div> {{-- end row --}}

             <div class="row">
      <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_adults_number">{{__('ERP::attributes.order.adult_numbers')}}</label>
          <input id="row_buses_0_adults_number" type="number" name="buses[0][adult_numbers]" placeholder="0" class="form-control adult_numbers general_price_input_group">
       </div>
     <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_adult_price">{{__('ERP::attributes.flight.price_adult')}}</label>
          <input id="row_buses_0_adult_price" type="number" name="buses[0][adult_price]" placeholder="00.00" class="form-control adult_price general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="buses[0][auto_adult_price]" class="auto_adult_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_adult_cost">{{__('ERP::attributes.flight.cost_adult')}}</label>
          <input id="row_buses_0_adult_cost" type="number" name="buses[0][adult_cost]" placeholder="00.00" class="form-control adult_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="buses[0][auto_adult_cost]" class="auto_adult_cost">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_child_number">{{__('ERP::attributes.order.child_numbers')}}</label>
          <input id="row_buses_0_child_number" type="number" name="buses[0][child_numbers]" placeholder="0" class="form-control child_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_child_price">{{__('ERP::attributes.flight.price_child')}}</label>
          <input id="row_buses_0_child_price" type="number" name="buses[0][child_price]" placeholder="00.00" class="form-control child_price general_price_input_group" step=".01">

       </div>
       <input type="hidden" name="buses[0][auto_child_price]" class="auto_child_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_child_cost">{{__('ERP::attributes.flight.cost_child')}}</label>
          <input id="row_buses_0_child_cost" type="number" name="buses[0][child_cost]" placeholder="00.00" class="form-control child_cost general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="buses[0][auto_child_cost]" class="auto_child_cost">
  </div> {{-- end row --}}
<div class="row">
         <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_infant_number">{{__('ERP::attributes.order.infant_numbers')}}</label>
          <input id="row_buses_0_infant_number" type="number" name="buses[0][infant_numbers]" placeholder="0" class="form-control infant_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_infant_price">{{__('ERP::attributes.flight.price_infant')}}</label>
          <input id="row_buses_0_infant_price" type="number" name="buses[0][infant_price]" placeholder="00.00" class="form-control infant_price general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="buses[0][auto_infant_price]" class="auto_infant_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_infant_cost">{{__('ERP::attributes.flight.cost_infant')}}</label>
          <input id="row_buses_0_infant_cost" type="number" name="buses[0][infant_cost]" placeholder="00.00" class="form-control infant_cost general_price_input_group" step=".01">
       </div>
        <input type="hidden" name="buses[0][auto_infant_cost]" class="auto_infant_cost">

        <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_baggage_weight">{{__('ERP::attributes.flight.baggage_weight')}}</label>
          <input id="row_buses_0_baggage_weight" type="number" name="buses[0][baggage_weight]" placeholder="00.00" class="form-control baggage_weight general_price_input_group" step=".01">
       </div>

        <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_baggage_price">{{__('ERP::attributes.flight.baggage_price')}}</label>
          <input id="row_buses_0_baggage_price" type="number" name="buses[0][baggage_price]" placeholder="00.00" class="form-control baggage_price general_price_input_group" step=".01">
          <input type="hidden" name="buses[0][auto_baggage_price]" class="auto_baggage_price">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_0_baggage_cost">{{__('ERP::attributes.flight.baggage_cost')}}</label>
          <input id="row_buses_0_baggage_cost" type="number" name="buses[0][baggage_cost]" placeholder="00.00" class="form-control baggage_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="buses[0][auto_baggage_cost]" class="auto_baggage_cost">

      
        </div> {{-- end row --}}

          <div class="row">



          <div class="form-group col-md-2">
                   <label for="row_buses_0_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_buses_0_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>


          <div class="form-group col-md-2">
                   <label for="row_buses_0_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_buses_0_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>

                          <div class="form-group col-md-2">
            <label for="row_buses_0_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_buses_0_due_date" type="text" name="buses[0][due_date]" class="form-control datepicker">
            </div>

              <div class="form-group col-md-2">
                   <label for="row_buses_0_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_buses_0_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="buses[0][prepay_percent]">
        </div>

                           <div class="form-group col-md-2">
                   <label for="row_buses_0_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_buses_0_reg_code" type="text" name="buses[0][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>
         
          <div class="form-group col-md-2">
            <label for="row_buses_0_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_buses_0_notes" type="text" name="buses[0][booking_notes]" class="form-control">
          </div>



     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="bus"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-form-inputs disabled-row-btn active btn btn-danger" data-row_id="row_buses_0" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
</div>
   <div class="row">
    <div class="col-md-12">
            <center>
                <button class="btn btn-info ladda-button new-general-row-btn" type="button" data-main_row_id="buses_orders" data-main_row_class="bus-row" data-main_row_prefix="row_buses_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



