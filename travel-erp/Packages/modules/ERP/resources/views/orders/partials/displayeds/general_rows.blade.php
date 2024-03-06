
<div id="get_activities_orders">

<div id="row_activities_r0099" class="activity-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="r0099">
   <div class="alert alert-danger" style="display: none;" id="alert_row_activities_r0099">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
  <input type="hidden" value="true" class="classfy-prices">



<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_activities_r0099_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="activities[r0099][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

 <div class="form-group col-md-2 required-field">
            <label for="row_activities_r0099_start_date">{{__('ERP::attributes.order.start_date')}}</label>
              <input id="row_activities_r0099_start_date" type="text" name="activities[r0099][start_date]" class="form-control start-date-input datepicker" readonly="">
        </div>

        <div class="form-group col-md-2">
            <label for="row_activities_r0099_start_time">{{__('ERP::attributes.order.start_time')}}</label>
              <input id="row_activities_r0099_start_time" type="text" name="activities[r0099][start_time]" class="form-control timepicker" >
        </div>

           <div class="form-group col-md-2">
            <label for="row_activities_r0099_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list_1 with-select3 with-dest-country general_price_input_group" id="row_activities_r0099_country" name="activities[r0099][country_id]" data-list_type= 'cities' data-other_select_id= 'row_activities_r0099_city' data-select2_class= 'with-select3'  data-closest_class ='activity-row' data-item_type='countries' data-currency_div_id="row_activities_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_activities_r0099_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select3 cities-list_1 with-dest-city get_geo_lists" id="row_activities_r0099_city" name="activities[r0099][city_id]" data-list_type= 'activities' data-other_select_id= 'row_activities_r0099_activity' data-select2_class= 'with-select3'  data-closest_class ='activity-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

           <div class="form-group col-md-2 required-field">
            <label for="row_activities_r0099_activity">{{__('ERP::attributes.order.activity')}}</label>
               <select class="form-control selected-service with-select3 geo_child" id="row_activities_r0099_activity" name="activities[r0099][activity_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             
             
            </select>
            </div>

      
           </div> {{-- end row --}}

          

             <div class="row">
      <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_adults_number">{{__('ERP::attributes.order.adult_numbers')}}</label>
          <input id="row_activities_r0099_adults_number" type="number" name="activities[r0099][adult_numbers]" placeholder="0" class="form-control adult_numbers general_price_input_group">
       </div>
     <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_adult_price">{{__('ERP::attributes.flight.price_adult')}}</label>
          <input id="row_activities_r0099_adult_price" type="number" name="activities[r0099][adult_price]" placeholder="00.00" class="form-control adult_price general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="activities[r0099][auto_adult_price]" class="auto_adult_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_adult_cost">{{__('ERP::attributes.flight.cost_adult')}}</label>
          <input id="row_activities_r0099_adult_cost" type="number" name="activities[r0099][adult_cost]" placeholder="00.00" class="form-control adult_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="activities[r0099][auto_adult_cost]" class="auto_adult_cost">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_child_number">{{__('ERP::attributes.order.child_numbers')}}</label>
          <input id="row_activities_r0099_child_number" type="number" name="activities[r0099][child_numbers]" placeholder="0" class="form-control child_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_child_price">{{__('ERP::attributes.flight.price_child')}}</label>
          <input id="row_activities_r0099_child_price" type="number" name="activities[r0099][child_price]" placeholder="00.00" class="form-control child_price general_price_input_group" step=".01">

       </div>
       <input type="hidden" name="activities[r0099][auto_child_price]" class="auto_child_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_child_cost">{{__('ERP::attributes.flight.cost_child')}}</label>
          <input id="row_activities_r0099_child_cost" type="number" name="activities[r0099][child_cost]" placeholder="00.00" class="form-control child_cost general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="activities[r0099][auto_child_cost]" class="auto_child_cost">
  </div> {{-- end row --}}
<div class="row">
         <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_infant_number">{{__('ERP::attributes.order.infant_numbers')}}</label>
          <input id="row_activities_r0099_infant_number" type="number" name="activities[r0099][infant_numbers]" placeholder="0" class="form-control infant_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_infant_price">{{__('ERP::attributes.flight.price_infant')}}</label>
          <input id="row_activities_r0099_infant_price" type="number" name="activities[r0099][infant_price]" placeholder="00.00" class="form-control infant_price general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="activities[r0099][auto_infant_price]" class="auto_infant_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_r0099_infant_cost">{{__('ERP::attributes.flight.cost_infant')}}</label>
          <input id="row_activities_r0099_infant_cost" type="number" name="activities[r0099][infant_cost]" placeholder="00.00" class="form-control infant_cost general_price_input_group" step=".01">
       </div>
        <input type="hidden" name="activities[r0099][auto_infant_cost]" class="auto_infant_cost">

        
           <div class="form-group col-md-2 required-field">
            <label for="row_activities_r0099_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control activity_price_type" id="row_activities_r0099_price_type" name="activities[r0099][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2">
                   <label for="row_activities_r0099_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_activities_r0099_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>


          <div class="form-group col-md-2">
                   <label for="row_activities_r0099_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_activities_r0099_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>

      
        </div> {{-- end row --}}

          <div class="row">


          <div class="form-group col-md-2">
            <label for="row_activities_r0099_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select3" id="row_activities_r0099_provider" name="activities[r0099][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>


            <div class="form-group col-md-2 required-field">
            <label for="row_activities_r0099_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select3 get-currency-rate" id="row_activities_r0099_value_currency_id" name="activities[r0099][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_activities_r0099_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_activities_r0099_value_currency_rate" type="number" name="activities[r0099][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="activities[r0099][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="activities[r0099][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="activities[r0099][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="activities[r0099][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_activities_r0099_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_activities_r0099_due_date" type="text" name="activities[r0099][due_date]" class="form-control datepicker">
            </div>

             <div class="form-group col-md-2">
                   <label for="row_activities_r0099_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_activities_r0099_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="activities[r0099][prepay_percent]">
        </div>
                   <div class="form-group col-md-2">
                   <label for="row_activities_r0099_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_activities_r0099_reg_code" type="text" name="activities[r0099][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>


        

       


     </div> {{-- end row --}}



     <div class="row">

             

          <div class="form-group col-md-6">
                   <label for="row_activities_r0099_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_activities_r0099_notes" type="text" name="activities[r0099][booking_notes]" class="form-control">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
        <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="activity"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="remove-row-btn active btn btn-danger" data-row_id="row_activities_r0099" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
</div>


<div id="get_buses_orders">

<div id="row_buses_r0099" class="bus-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="r0099">
   <div class="alert alert-danger" style="display: none;" id="alert_row_buses_r0099">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
    <input type="hidden" value="true" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_buses_r0099_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="buses[r0099][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>



 <div class="form-group col-md-2">
            <label for="row_buses_r0099_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select3" id="row_buses_r0099_provider" name="buses[r0099][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
  </div>

          
           <div class="form-group col-md-2">
            <label for="row_buses_r0099_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select3 with-dest-country general_price_input_group" id="row_buses_r0099_from_country" name="buses[r0099][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_buses_r0099_from_city' data-select2_class= 'with-select3'  data-closest_class ='bus-row' data-item_type='countries' data-currency_div_id="row_buses_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_buses_r0099_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select3 cities-list_1 with-dest-city get_places_cat" id="row_buses_r0099_from_city" name="buses[r0099][from_city_id]" data-place_cat_id="row_buses_r0099_source_type" data-place_id="row_buses_r0099_source_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

                   <div class="form-group col-md-2">
            <label for="row_buses_r0099_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select3 with-dest-country general_price_input_group" id="row_buses_r0099_to_country" name="buses[r0099][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_buses_r0099_to_city' data-select2_class= 'with-select3'  data-closest_class ='bus-row' data-item_type='countries' data-currency_div_id="row_buses_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_buses_r0099_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select3 cities-list_2 with-dest-city get_places_cat" id="row_buses_r0099_to_city" name="buses[r0099][to_city_id]" data-place_cat_id="row_buses_r0099_target_type" data-place_id="row_buses_r0099_target_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>
  



      
           </div> {{-- end row --}}

           <div class="row">


        <div class="form-group col-md-2 required-field">
            <label for="row_buses_r0099_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_buses_r0099_leave_date" type="text" name="buses[r0099][leave_date]" class="form-control start-date-input datepicker" readonly="">
            </div>
        <div class="form-group col-md-2">
            <label for="row_buses_r0099_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_buses_r0099_leave_time" type="text" name="buses[r0099][leave_time]" class="form-control leave-time-input timepicker" >
            </div>

                      <div class="form-group col-md-2 required-field">
            <label for="row_buses_r0099_buses">{{__('ERP::attributes.main.bus')}}</label>
               <select class="form-control selected-service with-select3" id="row_buses_r0099_buses" name="buses[r0099][transport_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($buses as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>

                    <div class="form-group col-md-2 required-field">
            <label for="row_buses_r0099_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select3 get-currency-rate" id="row_buses_r0099_value_currency_id" name="buses[r0099][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_buses_r0099_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_buses_r0099_value_currency_rate" type="number" name="buses[r0099][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="buses[r0099][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="buses[r0099][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="buses[r0099][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="buses[r0099][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">




           <div class="form-group col-md-2 required-field">
            <label for="row_buses_r0099_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control bus_price_type" id="row_buses_r0099_price_type" name="buses[r0099][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>





           </div> {{-- end row --}}

             <div class="row">
      <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_adults_number">{{__('ERP::attributes.order.adult_numbers')}}</label>
          <input id="row_buses_r0099_adults_number" type="number" name="buses[r0099][adult_numbers]" placeholder="0" class="form-control adult_numbers general_price_input_group">
       </div>
     <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_adult_price">{{__('ERP::attributes.flight.price_adult')}}</label>
          <input id="row_buses_r0099_adult_price" type="number" name="buses[r0099][adult_price]" placeholder="00.00" class="form-control adult_price general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="buses[r0099][auto_adult_price]" class="auto_adult_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_adult_cost">{{__('ERP::attributes.flight.cost_adult')}}</label>
          <input id="row_buses_r0099_adult_cost" type="number" name="buses[r0099][adult_cost]" placeholder="00.00" class="form-control adult_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="buses[r0099][auto_adult_cost]" class="auto_adult_cost">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_child_number">{{__('ERP::attributes.order.child_numbers')}}</label>
          <input id="row_buses_r0099_child_number" type="number" name="buses[r0099][child_numbers]" placeholder="0" class="form-control child_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_child_price">{{__('ERP::attributes.flight.price_child')}}</label>
          <input id="row_buses_r0099_child_price" type="number" name="buses[r0099][child_price]" placeholder="00.00" class="form-control child_price general_price_input_group" step=".01">

       </div>
       <input type="hidden" name="buses[r0099][auto_child_price]" class="auto_child_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_child_cost">{{__('ERP::attributes.flight.cost_child')}}</label>
          <input id="row_buses_r0099_child_cost" type="number" name="buses[r0099][child_cost]" placeholder="00.00" class="form-control child_cost general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="buses[r0099][auto_child_cost]" class="auto_child_cost">
  </div> {{-- end row --}}
<div class="row">
         <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_infant_number">{{__('ERP::attributes.order.infant_numbers')}}</label>
          <input id="row_buses_r0099_infant_number" type="number" name="buses[r0099][infant_numbers]" placeholder="0" class="form-control infant_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_infant_price">{{__('ERP::attributes.flight.price_infant')}}</label>
          <input id="row_buses_r0099_infant_price" type="number" name="buses[r0099][infant_price]" placeholder="00.00" class="form-control infant_price general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="buses[r0099][auto_infant_price]" class="auto_infant_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_infant_cost">{{__('ERP::attributes.flight.cost_infant')}}</label>
          <input id="row_buses_r0099_infant_cost" type="number" name="buses[r0099][infant_cost]" placeholder="00.00" class="form-control infant_cost general_price_input_group" step=".01">
       </div>
        <input type="hidden" name="buses[r0099][auto_infant_cost]" class="auto_infant_cost">

        <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_baggage_weight">{{__('ERP::attributes.flight.baggage_weight')}}</label>
          <input id="row_buses_r0099_baggage_weight" type="number" name="buses[r0099][baggage_weight]" placeholder="00.00" class="form-control baggage_weight general_price_input_group" step=".01">
       </div>

        <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_baggage_price">{{__('ERP::attributes.flight.baggage_price')}}</label>
          <input id="row_buses_r0099_baggage_price" type="number" name="buses[r0099][baggage_price]" placeholder="00.00" class="form-control baggage_price general_price_input_group" step=".01">
          <input type="hidden" name="buses[r0099][auto_baggage_price]" class="auto_baggage_price">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_buses_r0099_baggage_cost">{{__('ERP::attributes.flight.baggage_cost')}}</label>
          <input id="row_buses_r0099_baggage_cost" type="number" name="buses[r0099][baggage_cost]" placeholder="00.00" class="form-control baggage_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="buses[r0099][auto_baggage_cost]" class="auto_baggage_cost">

      
        </div> {{-- end row --}}

          <div class="row">



          <div class="form-group col-md-2">
                   <label for="row_buses_r0099_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_buses_r0099_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>


          <div class="form-group col-md-2">
                   <label for="row_buses_r0099_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_buses_r0099_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>

                          <div class="form-group col-md-2">
            <label for="row_buses_r0099_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_buses_r0099_due_date" type="text" name="buses[r0099][due_date]" class="form-control datepicker">
            </div>

              <div class="form-group col-md-2">
                   <label for="row_buses_r0099_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_buses_r0099_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="buses[r0099][prepay_percent]">
        </div>

                           <div class="form-group col-md-2">
                   <label for="row_buses_r0099_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_buses_r0099_reg_code" type="text" name="buses[r0099][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>
         
          <div class="form-group col-md-2">
            <label for="row_buses_r0099_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_buses_r0099_notes" type="text" name="buses[r0099][booking_notes]" class="form-control">
          </div>



     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="bus"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="remove-row-btn active btn btn-danger" data-row_id="row_buses_r0099" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
</div>


<div id="get_ferries_orders">

<div id="row_ferries_r0099" class="ferry-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="r0099">
   <div class="alert alert-danger" style="display: none;" id="alert_row_ferries_r0099">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>

    <input type="hidden" value="true" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row">
                   <label for="row_ferries_r0099_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="ferries[r0099][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

{{--            <div class="form-group col-md-2">
            <label for="row_ferries_r0099_type">{{__('ERP::attributes.order.type')}}</label>
               <select class="form-control ferry_type" id="row_ferries_r0099_type" name="ferries[r0099][transport_type]">

                @foreach(trans('ERP::attributes.order.public_trans_type') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div> --}}

 <div class="form-group col-md-2">
            <label for="row_ferries_r0099_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select3" id="row_ferries_r0099_provider" name="ferries[r0099][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>

           <div class="form-group col-md-2">
            <label for="row_ferries_r0099_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select3  with-dest-country" id="row_ferries_r0099_from_country" name="ferries[r0099][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_ferries_r0099_from_city' data-select2_class= 'with-select3'  data-closest_class ='ferry-row' data-item_type='countries' data-currency_div_id="row_ferries_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_ferries_r0099_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select3 cities-list_1 with-dest-city" id="row_ferries_r0099_from_city" name="ferries[r0099][from_city_id]" >
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

                  <div class="form-group col-md-2">
            <label for="row_ferries_r0099_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select3  with-dest-country general_price_input_group" id="row_ferries_r0099_to_country" name="ferries[r0099][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_ferries_r0099_to_city' data-select2_class= 'with-select3'  data-closest_class ='ferry-row' data-item_type='countries' data-currency_div_id="row_ferries_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_ferries_r0099_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select3 cities-list_2 with-dest-city" id="row_ferries_r0099_to_city" name="ferries[r0099][to_city_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

  

      
           </div> {{-- end row --}}

           <div class="row">

                    <div class="form-group col-md-2 required-field">
            <label for="row_ferries_r0099_ferry">{{__('ERP::attributes.order.ferry')}}</label>
               <select class="form-control selected-service with-select3" id="row_ferries_r0099_ferry" name="ferries[r0099][transport_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($ferries as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>

         

        <div class="form-group col-md-2 required-field">
            <label for="row_ferries_r0099_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_ferries_r0099_leave_date" type="text" name="ferries[r0099][leave_date]" class="form-control start-date-input datepicker" readonly="">
            </div>
        <div class="form-group col-md-2">
            <label for="row_ferries_r0099_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_ferries_r0099_leave_time" type="text" name="ferries[r0099][leave_time]" class="form-control leave-time-input timepicker" >
            </div>



  
      <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_adults_number">{{__('ERP::attributes.order.adult_numbers')}}</label>
          <input id="row_ferries_r0099_adults_number" type="number" name="ferries[r0099][adult_numbers]" placeholder="0" class="form-control adult_numbers general_price_input_group">
       </div>
     <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_adult_price">{{__('ERP::attributes.flight.price_adult')}}</label>
          <input id="row_ferries_r0099_adult_price" type="number" name="ferries[r0099][adult_price]" placeholder="00.00" class="form-control adult_price general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="ferries[r0099][auto_adult_price]" class="auto_adult_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_adult_cost">{{__('ERP::attributes.flight.cost_adult')}}</label>
          <input id="row_ferries_r0099_adult_cost" type="number" name="ferries[r0099][adult_cost]" placeholder="00.00" class="form-control adult_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="ferries[r0099][auto_adult_cost]" class="auto_adult_cost">


         
   
           </div> {{-- end row --}}

             <div class="row">


       <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_child_number">{{__('ERP::attributes.order.child_numbers')}}</label>
          <input id="row_ferries_r0099_child_number" type="number" name="ferries[r0099][child_numbers]" placeholder="0" class="form-control child_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_child_price">{{__('ERP::attributes.flight.price_child')}}</label>
          <input id="row_ferries_r0099_child_price" type="number" name="ferries[r0099][child_price]" placeholder="00.00" class="form-control child_price general_price_input_group" step=".01">

       </div>
       <input type="hidden" name="ferries[r0099][auto_child_price]" class="auto_child_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_child_cost">{{__('ERP::attributes.flight.cost_child')}}</label>
          <input id="row_ferries_r0099_child_cost" type="number" name="ferries[r0099][child_cost]" placeholder="00.00" class="form-control child_cost general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="ferries[r0099][auto_child_cost]" class="auto_child_cost">
                <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_infant_number">{{__('ERP::attributes.order.infant_numbers')}}</label>
          <input id="row_ferries_r0099_infant_number" type="number" name="ferries[r0099][infant_numbers]" placeholder="0" class="form-control infant_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_infant_price">{{__('ERP::attributes.flight.price_infant')}}</label>
          <input id="row_ferries_r0099_infant_price" type="number" name="ferries[r0099][infant_price]" placeholder="00.00" class="form-control infant_price general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="ferries[r0099][auto_infant_price]" class="auto_infant_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_infant_cost">{{__('ERP::attributes.flight.cost_infant')}}</label>
          <input id="row_ferries_r0099_infant_cost" type="number" name="ferries[r0099][infant_cost]" placeholder="00.00" class="form-control infant_cost general_price_input_group" step=".01">
       </div>
        <input type="hidden" name="ferries[r0099][auto_infant_cost]" class="auto_infant_cost">
  </div> {{-- end row --}}
<div class="row">


        <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_baggage_weight">{{__('ERP::attributes.flight.baggage_weight')}}</label>
          <input id="row_ferries_r0099_baggage_weight" type="number" name="ferries[r0099][baggage_weight]" placeholder="00.00" class="form-control baggage_weight general_price_input_group" step=".01">
       </div>

        <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_baggage_price">{{__('ERP::attributes.flight.baggage_price')}}</label>
          <input id="row_ferries_r0099_baggage_price" type="number" name="ferries[r0099][baggage_price]" placeholder="00.00" class="form-control baggage_price general_price_input_group" step=".01">
          <input type="hidden" name="ferries[r0099][auto_baggage_price]" class="auto_baggage_price">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_ferries_r0099_baggage_cost">{{__('ERP::attributes.flight.baggage_cost')}}</label>
          <input id="row_ferries_r0099_baggage_cost" type="number" name="ferries[r0099][baggage_cost]" placeholder="00.00" class="form-control baggage_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="ferries[r0099][auto_baggage_cost]" class="auto_baggage_cost">


           <div class="form-group col-md-2 required-fields">
            <label for="row_ferries_r0099_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control ferry_price_type" id="row_ferries_r0099_price_type" name="ferries[r0099][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

  
         


          <div class="form-group col-md-2">
                   <label for="row_ferries_r0099_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_ferries_r0099_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>


          <div class="form-group col-md-2">
                   <label for="row_ferries_r0099_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_ferries_r0099_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>

      
        </div> {{-- end row --}}

          <div class="row">



            <div class="form-group col-md-2">
            <label for="row_ferries_r0099_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select3 get-currency-rate" id="row_ferries_r0099_value_currency_id" name="ferries[r0099][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2">
                   <label for="row_ferries_r0099_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_ferries_r0099_value_currency_rate" type="number" name="ferries[r0099][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="ferries[r0099][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="ferries[r0099][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="ferries[r0099][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="ferries[r0099][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_ferries_r0099_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_ferries_r0099_due_date" type="text" name="ferries[r0099][due_date]" class="form-control datepicker">
            </div>

                          <div class="form-group col-md-2">
                   <label for="row_ferries_r0099_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_ferries_r0099_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="ferries[r0099][prepay_percent]">
        </div>
                   <div class="form-group col-md-2">
                   <label for="row_ferries_r0099_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_ferries_r0099_reg_code" type="text" name="ferries[r0099][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>

          <div class="form-group col-md-2">
                   <label for="row_ferries_r0099_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_ferries_r0099_notes" type="text" name="ferries[r0099][booking_notes]" class="form-control">
          </div>


        

       


     </div> {{-- end row --}}



     <div class="row">


     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="ferry"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="remove-row-btn active btn btn-danger" data-row_id="row_ferries_r0099" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>

<br>
</div>





<div id="get_flights_orders">

<div id="row_flights_r0099" class="flight-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="r0099">
   <div class="alert alert-danger" style="display: none;" id="alert_row_flights_r0099">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
    <input type="hidden" value="true" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_flights_r0099_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="flights[r0099][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

                   <div class="form-group col-md-2">
                   <label for="row_flights_r0099_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_flights_r0099_reg_code" type="text" name="flights[r0099][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>

 <div class="form-group col-md-2">
            <label for="row_flights_r0099_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select3" id="row_flights_r0099_provider" name="flights[r0099][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
  </div>

           <div class="form-group col-md-2">
            <label for="row_flights_r0099_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select3  with-dest-country" id="row_flights_r0099_from_country" name="flights[r0099][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_flights_r0099_from_city' data-select2_class= 'with-select3'  data-closest_class ='flight-row' data-item_type='countries' data-currency_div_id="row_flights_r0099_value_currency_id" data-geo_child_class="geo_child" >
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_flights_r0099_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select3 cities-list_1 with-dest-city" id="row_flights_r0099_from_city" name="flights[r0099][from_city_id]" data-list_type= 'airports' data-other_select_id= 'row_flights_r0099_from_airport' data-select2_class= 'with-select3'  data-closest_class ='flight-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

  
           <div class="form-group col-md-2 required-field">
            <label for="row_flights_r0099_from_airport" class="select-from-airport">{{__('ERP::attributes.order.from_airport')}}</label>
               <select class="form-control airports-list with-select3" id="row_flights_r0099_from_airport" name="flights[r0099][from_airport_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             
             
            </select>
            </div>

      
           </div> {{-- end row --}}

           <div class="row">

                    <div class="form-group col-md-2 required-field">
            <label for="row_flights_r0099_airlines">{{__('ERP::attributes.main.airlines')}}</label>
               <select class="form-control selected-service with-select3" id="row_flights_r0099_airlines" name="flights[r0099][airline_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($airlines as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>

         

        <div class="form-group col-md-2 required-field">
            <label for="row_flights_r0099_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_flights_r0099_leave_date" type="text" name="flights[r0099][leave_date]" class="form-control start-date-input datepicker" readonly="">
            </div>
        <div class="form-group col-md-2">
            <label for="row_flights_r0099_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_flights_r0099_leave_time" type="text" name="flights[r0099][leave_time]" class="form-control leave-time-input timepicker" >
            </div>


          <div class="form-group col-md-2">
            <label for="row_flights_r0099_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select3  with-dest-country general_price_input_group" id="row_flights_r0099_to_country" name="flights[r0099][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_flights_r0099_to_city' data-select2_class= 'with-select3'  data-closest_class ='flight-row' data-item_type='countries' data-currency_div_id="row_flights_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_flights_r0099_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select3 cities-list_2 with-dest-city" id="row_flights_r0099_to_city" name="flights[r0099][to_city_id]" data-list_type= 'airports' data-other_select_id= 'row_flights_r0099_to_airport' data-select2_class= 'with-select3'  data-closest_class ='flight-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>
  
           <div class="form-group col-md-2 required-field">
            <label for="row_flights_r0099_to_airport" class="select-to-airport">{{__('ERP::attributes.order.to_airport')}}</label>
               <select class="form-control airports-list with-select3" id="row_flights_r0099_to_airport" name="flights[r0099][to_airport_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                          
            </select>
            </div>


         
   
           </div> {{-- end row --}}

             <div class="row">
      <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_adults_number">{{__('ERP::attributes.order.adult_numbers')}}</label>
          <input id="row_flights_r0099_adults_number" type="number" name="flights[r0099][adult_numbers]" placeholder="0" class="form-control adult_numbers general_price_input_group">
       </div>
     <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_adult_price">{{__('ERP::attributes.flight.price_adult')}}</label>
          <input id="row_flights_r0099_adult_price" type="number" name="flights[r0099][adult_price]" placeholder="00.00" class="form-control adult_price general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="flights[r0099][auto_adult_price]" class="auto_adult_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_adult_cost">{{__('ERP::attributes.flight.cost_adult')}}</label>
          <input id="row_flights_r0099_adult_cost" type="number" name="flights[r0099][adult_cost]" placeholder="00.00" class="form-control adult_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="flights[r0099][auto_adult_cost]" class="auto_adult_cost">

       <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_child_number">{{__('ERP::attributes.order.child_numbers')}}</label>
          <input id="row_flights_r0099_child_number" type="number" name="flights[r0099][child_numbers]" placeholder="0" class="form-control child_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_child_price">{{__('ERP::attributes.flight.price_child')}}</label>
          <input id="row_flights_r0099_child_price" type="number" name="flights[r0099][child_price]" placeholder="00.00" class="form-control child_price general_price_input_group" step=".01">

       </div>
       <input type="hidden" name="flights[r0099][auto_child_price]" class="auto_child_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_child_cost">{{__('ERP::attributes.flight.cost_child')}}</label>
          <input id="row_flights_r0099_child_cost" type="number" name="flights[r0099][child_cost]" placeholder="00.00" class="form-control child_cost general_price_input_group" step=".01">
       </div>
       <input type="hidden" name="flights[r0099][auto_child_cost]" class="auto_child_cost">
  </div> {{-- end row --}}
<div class="row">
         <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_infant_number">{{__('ERP::attributes.order.infant_numbers')}}</label>
          <input id="row_flights_r0099_infant_number" type="number" name="flights[r0099][infant_numbers]" placeholder="0" class="form-control infant_numbers general_price_input_group">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_infant_price">{{__('ERP::attributes.flight.price_infant')}}</label>
          <input id="row_flights_r0099_infant_price" type="number" name="flights[r0099][infant_price]" placeholder="00.00" class="form-control infant_price general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="flights[r0099][auto_infant_price]" class="auto_infant_price">

       <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_infant_cost">{{__('ERP::attributes.flight.cost_infant')}}</label>
          <input id="row_flights_r0099_infant_cost" type="number" name="flights[r0099][infant_cost]" placeholder="00.00" class="form-control infant_cost general_price_input_group" step=".01">
       </div>
        <input type="hidden" name="flights[r0099][auto_infant_cost]" class="auto_infant_cost">

        <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_baggage_weight">{{__('ERP::attributes.flight.baggage_weight')}}</label>
          <input id="row_flights_r0099_baggage_weight" type="number" name="flights[r0099][baggage_weight]" placeholder="00.00" class="form-control baggage_weight general_price_input_group" step=".01">
       </div>

        <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_baggage_price">{{__('ERP::attributes.flight.baggage_price')}}</label>
          <input id="row_flights_r0099_baggage_price" type="number" name="flights[r0099][baggage_price]" placeholder="00.00" class="form-control baggage_price general_price_input_group" step=".01">
          <input type="hidden" name="flights[r0099][auto_baggage_price]" class="auto_baggage_price">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_flights_r0099_baggage_cost">{{__('ERP::attributes.flight.baggage_cost')}}</label>
          <input id="row_flights_r0099_baggage_cost" type="number" name="flights[r0099][baggage_cost]" placeholder="00.00" class="form-control baggage_cost general_price_input_group" step=".01">
       </div>

        <input type="hidden" name="flights[r0099][auto_baggage_cost]" class="auto_baggage_cost">

      
        </div> {{-- end row --}}

          <div class="row">

           <div class="form-group col-md-2 required-field">
            <label for="row_flights_r0099_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control flight_price_type" id="row_flights_r0099_price_type" name="flights[r0099][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

  
         


          <div class="form-group col-md-2">
                   <label for="row_flights_r0099_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_flights_r0099_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>


          <div class="form-group col-md-2">
                   <label for="row_flights_r0099_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_flights_r0099_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>


            <div class="form-group col-md-2 required-field">
            <label for="row_flights_r0099_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select3 get-currency-rate" id="row_flights_r0099_value_currency_id" name="flights[r0099][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_flights_r0099_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_flights_r0099_value_currency_rate" type="number" name="flights[r0099][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="flights[r0099][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="flights[r0099][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="flights[r0099][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="flights[r0099][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_flights_r0099_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_flights_r0099_due_date" type="text" name="flights[r0099][due_date]" class="form-control datepicker">
            </div>

     </div> {{-- end row --}}



     <div class="row">

              <div class="form-group col-md-2">
                   <label for="row_flights_r0099_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_flights_r0099_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="flights[r0099][prepay_percent]">
        </div>


          <div class="form-group col-md-4">
                   <label for="row_flights_r0099_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_flights_r0099_notes" type="text" name="flights[r0099][booking_notes]" class="form-control">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="flight"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="remove-row-btn active btn btn-danger" data-row_id="row_flights_r0099" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>

<br>
</div>



<div id="get_services_orders">

<div id="row_services_r0099" class="service-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="r0099">
   <div class="alert alert-danger" style="display: none;" id="alert_row_services_r0099">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>

    <input type="hidden" value="false" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_services_r0099_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="services[r0099][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

 <div class="form-group col-md-2 required-field">
            <label for="row_services_r0099_start_date">{{__('ERP::attributes.order.start_date')}}</label>
              <input id="row_services_r0099_start_date" type="text" name="services[r0099][start_date]" class="form-control start-date-input datepicker" readonly="">
        </div>

        <div class="form-group col-md-2">
            <label for="row_services_r0099_start_time">{{__('ERP::attributes.order.start_time')}}</label>
              <input id="row_services_r0099_start_time" type="text" name="services[r0099][start_time]" class="form-control timepicker" >
        </div>

           <div class="form-group col-md-2">
            <label for="row_services_r0099_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list_1 with-select3  with-dest-country general_price_input_group" id="row_services_r0099_country" name="services[r0099][country_id]" data-list_type= 'cities' data-other_select_id= 'row_services_r0099_city' data-select2_class= 'with-select3'  data-closest_class ='service-row' data-item_type='countries' data-currency_div_id="row_services_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
           </div>

        <div class="form-group col-md-2"> 
            <label for="row_services_r0099_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select3 cities-list_1 with-dest-city get_geo_lists" id="row_services_r0099_city" name="services[r0099][city_id]" data-list_type= 'services' data-other_select_id= 'row_services_r0099_service' data-select2_class= 'with-select3'  data-closest_class ='service-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

  
           <div class="form-group col-md-2 required-field">
            <label for="row_services_r0099_service">{{__('ERP::attributes.order.service')}}</label>
               <select class="form-control selected-service with-select3 geo_child" id="row_services_r0099_service" name="services[r0099][service_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             
             
            </select>
            </div>

      
           </div> {{-- end row --}}


           <div class="row">



          <div class="form-group col-md-2 required-field">
            <label for="row_services_r0099_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control service_price_type" id="row_services_r0099_price_type" name="services[r0099][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

            <div class="form-group col-md-2 required-field">
                   <label for="row_services_r0099_quantity">{{__('ERP::attributes.order.quantity')}}</label>
               <input id="row_services_r0099_quantity" type="number" name="services[r0099][quantity]" placeholder="1" class="form-control general_price_input_group quantity" value="1">
          </div>


          <div class="form-group col-md-2 required-field">
                   <label for="row_services_r0099_price">{{__('ERP::attributes.order.price')}}</label>
               <input id="row_services_r0099_price" type="number" name="services[r0099][price]" placeholder="00.00" class="form-control general_price_input_group price-input" step=".01">
          </div>

  
          <input type="hidden" name="services[r0099][auto_price]" class="auto_price">


          <div class="form-group col-md-2">
                   <label for="row_services_r0099_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_services_r0099_total_price" type="text"  placeholder="00.00" class="form-control total-price" step=".01" readonly="">
          </div>

            <div class="form-group col-md-2 required-field">
                   <label for="row_services_r0099_cost">{{__('ERP::attributes.order.cost')}}</label>
               <input id="row_services_r0099_cost" type="number" name="services[r0099][cost]" placeholder="00.00" class="form-control general_price_input_group cost-input" step=".01">
          </div>

          <input type="hidden" name="services[r0099][auto_cost]" class="auto_cost">


          <div class="form-group col-md-2">
                   <label for="row_services_r0099_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_services_r0099_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>


     </div> {{-- end row --}}

  

          <div class="row">


          <div class="form-group col-md-2">
            <label for="row_services_r0099_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select3" id="row_services_r0099_provider" name="services[r0099][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>


            <div class="form-group col-md-2 required-field">
            <label for="row_services_r0099_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select3 get-currency-rate" id="row_services_r0099_value_currency_id" name="services[r0099][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_services_r0099_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_services_r0099_value_currency_rate" type="number" name="services[r0099][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="services[r0099][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="services[r0099][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="services[r0099][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="services[r0099][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_services_r0099_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_services_r0099_due_date" type="text" name="services[r0099][due_date]" class="form-control datepicker">
            </div>

             <div class="form-group col-md-2">
                   <label for="row_services_r0099_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_services_r0099_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="services[r0099][prepay_percent]">
        </div>
                   <div class="form-group col-md-2">
                   <label for="row_services_r0099_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_services_r0099_reg_code" type="text" name="services[r0099][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>


        

       


     </div> {{-- end row --}}



     <div class="row">

             

          <div class="form-group col-md-4">
                   <label for="row_services_r0099_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_services_r0099_notes" type="text" name="services[r0099][booking_notes]" class="form-control">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="service"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="remove-row-btn active btn btn-danger" data-row_id="row_services_r0099" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
</div>



<div id="get_transports_orders">

<div id="row_transports_r0099" class="transport-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="r0099">
   <div class="alert alert-danger" style="display: none;" id="alert_row_transports_r0099">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
  <input type="hidden" value="false" class="classfy-prices">
<div class="row">
         
          <div class="form-group col-md-2 day-row required-field">
                   <label for="row_transports_r0099_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="transports[r0099][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

        <div class="form-group col-md-2">
            <label for="row_transports_r0099_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select3" id="row_transports_r0099_provider" name="transports[r0099][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
            </div>



           <div class="form-group col-md-2">
            <label for="row_transports_r0099_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select3  with-dest-country general_price_input_group" id="row_transports_r0099_from_country" name="transports[r0099][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_transports_r0099_from_city' data-select2_class= 'with-select3'  data-closest_class ='transport-row' data-item_type='countries' data-currency_div_id="row_transports_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_transports_r0099_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select3 cities-list_1 with-dest-city get_places_cat" id="row_transports_r0099_from_city" name="transports[r0099][from_city_id]" data-place_cat_id="row_transports_r0099_source_type" data-place_id="row_transports_r0099_source_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>
  
           <div class="form-group col-md-2">
            <label for="row_transports_r0099_source_type">{{__('ERP::attributes.transport.source_type')}}</label>
               <select class="form-control source-type-list with-select3 get_place_type_lists geo_child" id="row_transports_r0099_source_type" name="transports[r0099][sourcable_type]" data-list_type= 'places' data-other_select_id= 'row_transports_r0099_source_place' data-select2_class= 'with-select3'  data-closest_class ='transport-row' data-item_type='places_types' data-city_div_id="row_transports_r0099_from_city">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
 
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_r0099_source_place">{{__('ERP::attributes.transport.source_place')}}</label>
               <select class="form-control with-select3 source-places-list geo_child" id="row_transports_r0099_source_place" name="transports[r0099][sourcable_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

      
      </div> {{-- end row --}}

           <div class="row">


        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_r0099_vehicle_type">{{__('ERP::attributes.transport.vehicle_type')}}</label>
               <select class="form-control selected-service with-select3 vehicles_types-list" id="row_transports_r0099_vehicle_type" name="transports[r0099][vehicle_type_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($vehiclesTypes as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

         <div class="form-group col-md-2 required-field">
            <label for="row_transports_r0099_vehicles_num">{{__('ERP::attributes.order.number')}}</label>
            <input id="row_transports_r0099_vehicles_num" type="number" name="transports[r0099][vehicles_num]" placeholder="1" class="form-control general_price_input_group vehicles_num quantity" value="1">
              
        </div>

          <div class="form-group col-md-2">
            <label for="row_transports_r0099_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select3 with-dest-country general_price_input_group" id="row_transports_r0099_to_country" name="transports[r0099][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_transports_r0099_to_city' data-select2_class= 'with-select3'  data-closest_class ='transport-row' data-item_type='countries' data-currency_div_id="row_transports_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_transports_r0099_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select3 cities-list_2 with-dest-city get_places_cat" id="row_transports_r0099_to_city" name="transports[r0099][to_city_id]" data-place_cat_id="row_transports_r0099_target_type" data-place_id="row_transports_r0099_target_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>
  
           <div class="form-group col-md-2">
            <label for="row_transports_r0099_target_type">{{__('ERP::attributes.transport.target_type')}}</label>
               <select class="form-control target-type-list with-select3 get_place_type_lists geo_child" id="row_transports_r0099_target_type" name="transports[r0099][targetable_type]" data-list_type= 'places' data-other_select_id= 'row_transports_r0099_target_place' data-select2_class= 'with-select3'  data-closest_class ='transport-row' data-item_type='places_types' data-city_div_id="row_transports_r0099_to_city">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
{{--               @foreach($placesType as $key => $value)
               <option value="{{$key}}">{{$value}}</option>
              @endforeach --}}
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_r0099_target_place">{{__('ERP::attributes.transport.target_place')}}</label>
               <select class="form-control with-select3 target-places-list geo_child" id="row_transports_r0099_target_place" name="transports[r0099][targetable_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

         
   
           </div> {{-- end row --}}

                    <div class="row">



                   <div class="form-group col-md-2 required-field">
            <label for="row_transports_r0099_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control transport_price_type" id="row_transports_r0099_price_type" name="transports[r0099][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_transports_r0099_price">{{__('ERP::attributes.order.price')}}</label>
               <input id="row_transports_r0099_price" type="number" name="transports[r0099][vehicle_price]" placeholder="00.00" class="form-control general_price_input_group price-input" step=".01">
          </div>

  
          <input type="hidden" name="transports[r0099][auto_vehicle_price]" class="auto_price">


          <div class="form-group col-md-2">
                   <label for="row_transports_r0099_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_transports_r0099_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>

                    <div class="form-group col-md-2 required-field">
                   <label for="row_transports_r0099_cost">{{__('ERP::attributes.order.cost')}}</label>
               <input id="row_transports_r0099_cost" type="number" name="transports[r0099][vehicle_cost]" placeholder="00.00" class="form-control general_price_input_group cost-input" step=".01">
          </div>

          <input type="hidden" name="transports[r0099][auto_vehicle_cost]" class="auto_cost">


          <div class="form-group col-md-2">
                   <label for="row_transports_r0099_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_transports_r0099_total_cost" type="text"  placeholder="00.00" class="form-control total-cost" step=".01" readonly="">
          </div>

                  <div class="form-group col-md-2">
            <label for="row_transports_r0099_driver_id">{{__('ERP::attributes.main.driver')}}</label>
               <select class="form-control drivers-list with-select3 " id="row_transports_r0099_driver_id" name="transports[r0099][driver_id]" >
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($drivers as $key => $value)

               <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>



     </div> {{-- end row --}}


      <div class="row">
                  <div class="form-group col-md-2 required-field">
            <label for="row_transports_r0099_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_transports_r0099_leave_date" type="text" name="transports[r0099][leave_date]" class="form-control start-date-input datepicker" readonly="">
            </div>

         <div class="form-group col-md-2">
            <label for="row_transports_r0099_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_transports_r0099_leave_time" type="text" name="transports[r0099][leave_time]" class="form-control timepicker" >
            </div>



            <div class="form-group col-md-2 required-field">
            <label for="row_transports_r0099_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select3 get-currency-rate" id="row_transports_r0099_value_currency_id" name="transports[r0099][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_transports_r0099_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_transports_r0099_value_currency_rate" type="number" name="transports[r0099][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="transports[r0099][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="transports[r0099][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="transports[r0099][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="transports[r0099][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_transports_r0099_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_transports_r0099_due_date" type="text" name="transports[r0099][due_date]" class="form-control datepicker">
            </div>
             <div class="form-group col-md-2">
                   <label for="row_transports_r0099_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_transports_r0099_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="transports[r0099][prepay_percent]">
        </div>


     </div> {{-- end row --}}

     <div class="row">

                   <div class="form-group col-md-2">
                   <label for="row_transports_r0099_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_transports_r0099_reg_code" type="text" name="transports[r0099][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>

          <div class="form-group col-md-4">
                   <label for="row_transports_r0099_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_transports_r0099_notes" type="text" name="transports[r0099][order_notes]" class="form-control">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
        <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="transport"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="remove-row-btn active btn btn-danger" data-row_id="row_transports_r0099" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
</div>



<div id="get_manualservices_orders">

<div id="row_manualservices_r0099" class="manualservice-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="r0099">
   <div class="alert alert-danger" style="display: none;" id="alert_row_manualservices_r0099">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>

    <input type="hidden" value="false" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_manualservices_r0099_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="manual_services[r0099][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

                    <div class="form-group col-md-2">
            <label for="row_manualservices_r0099_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select3" id="row_manualservices_r0099_provider" name="manual_services[r0099][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>

           <div class="form-group col-md-2 required-field">
            <label for="row_manualservices_r0099_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list_1 with-select3  with-dest-country general_price_input_group" id="row_manualservices_r0099_country" name="manual_services[r0099][country_id]" data-list_type= 'cities' data-other_select_id= 'row_manualservices_r0099_city' data-select2_class= 'with-select3'  data-closest_class ='manualservice-row' data-item_type='countries' data-currency_div_id="row_manualservices_r0099_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_manualservices_r0099_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select3 cities-list_1 with-dest-city" id="row_manualservices_r0099_city" name="manual_services[r0099][city_id]" data-list_type= 'manualservices' data-other_select_id= 'row_manualservices_r0099_manualservice' data-select2_class= 'with-select3'  data-closest_class ='manualservice-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>


        @foreach (\Language::allowed() as $code => $name) 

        <div class="form-group col-md-2 required-field">
                   <label for="row_manualservices_r0099_service_name_{{$code}}">{{__('ERP::attributes.order.service_name').' ( '.$code.' )'}}</label>
               <input id="row_manualservices_r0099_service_name_{{$code}}" type="text" name="manual_services[r0099][service_name][{{$code}}]"  class="form-control" placeholder="{{'( '.$name.' )'}}">
          </div>

        @endforeach



  


      
           </div> {{-- end row --}}


        <div class="row">

                 <div class="form-group col-md-2">
           <label for="row_manualservices_r0099_price_type">{{__('ERP::attributes.order.price_type')}}</label>
            <select class="form-control hotel_price_type" id="row_manualservices_r0099_price_type" readonly="true">

              <option value="manual">{{trans('ERP::attributes.order.manual_or_auto.manual')}}</option>
            </select>
          <input type="hidden" name="manual_services[r0099][price_type]" value="manual">
        </div>

         <div class="form-group col-md-2 required-field">
            <label for="row_manualservices_r0099_start_date">{{__('ERP::attributes.order.start_date')}}</label>
              <input id="row_manualservices_r0099_start_date" type="text" name="manual_services[r0099][start_date]" class="form-control start-date-input datepicker" readonly="">
        </div>

        <div class="form-group col-md-2">
            <label for="row_manualservices_r0099_start_time">{{__('ERP::attributes.order.start_time')}}</label>
              <input id="row_manualservices_r0099_start_time" type="text" name="manual_services[r0099][start_time]" class="form-control timepicker" >
        </div>

            <div class="form-group col-md-2 required-field">
                   <label for="row_manualservices_r0099_quantity">{{__('ERP::attributes.order.quantity')}}</label>
               <input id="row_manualservices_r0099_quantity" type="number" name="manual_services[r0099][quantity]" placeholder="1" class="form-control general_price_input_group quantity" value="1">
          </div>


          <div class="form-group col-md-2 required-field">
                   <label for="row_manualservices_r0099_price">{{__('ERP::attributes.order.price')}}</label>
               <input id="row_manualservices_r0099_price" type="number" name="manual_services[r0099][price]" placeholder="00.00" class="form-control general_price_input_group price-input" step=".01">
          </div>

  
          <input type="hidden"  class="auto_price">


          <div class="form-group col-md-2 ">
                   <label for="row_manualservices_r0099_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_manualservices_r0099_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>




     </div> {{-- end row --}}

  

          <div class="row">


            <div class="form-group col-md-2 required-field">
                   <label for="row_manualservices_r0099_cost">{{__('ERP::attributes.order.cost')}}</label>
               <input id="row_manualservices_r0099_cost" type="number" name="manual_services[r0099][cost]" placeholder="00.00" class="form-control general_price_input_group cost-input" step=".01">
          </div>

          <input type="hidden"  class="auto_cost">


          <div class="form-group col-md-2">
                   <label for="row_manualservices_r0099_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_manualservices_r0099_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>


            <div class="form-group col-md-2 required-field">
            <label for="row_manualservices_r0099_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select3 get-currency-rate" id="row_manualservices_r0099_value_currency_id" name="manual_services[r0099][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_manualservices_r0099_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_manualservices_r0099_value_currency_rate" type="number" name="manual_services[r0099][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="manual_services[r0099][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="manual_services[r0099][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="manual_services[r0099][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="manual_services[r0099][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_manualservices_r0099_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_manualservices_r0099_due_date" type="text" name="manual_services[r0099][due_date]" class="form-control datepicker">
            </div>

           <div class="form-group col-md-2">
                   <label for="row_manualservices_r0099_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_manualservices_r0099_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="manual_services[r0099][prepay_percent]">
        </div>

     </div> {{-- end row --}}



     <div class="row">

         <div class="form-group col-md-2">
             <label for="row_manualservices_r0099_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_manualservices_r0099_reg_code" type="text" name="manual_services[r0099][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>

          <div class="form-group col-md-4">
              <label for="row_manualservices_r0099_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_manualservices_r0099_notes" type="text" name="manual_services[r0099][booking_notes]" class="form-control">
          </div>

     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">

         <a href="javascript:;" class="remove-row-btn active btn btn-danger" data-row_id="row_manualservices_r0099" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
</div>




















