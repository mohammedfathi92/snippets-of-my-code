
<div id="transports_orders">
      @foreach($orderTransportsList as $transportOrder)

<div id="row_transports_{{$loop->index}}" class="transport-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="{{$loop->index}}">
   <div class="alert alert-danger" style="display: none;" id="alert_row_transports_{{$loop->index}}">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
  <input type="hidden" value="false" class="classfy-prices">
            <input type="hidden" name="transports[{{$loop->index}}][transport_order_id]" value="{{$transportOrder->hashed_id}}">

<div class="row">
         
          <div class="form-group col-md-2 day-row required-field">
                   <label for="row_transports_{{$loop->index}}_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="transports[{{$loop->index}}][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                @for($i=1; $i < $order->duration; $i++)
                <option value="{{$i}}" @if($i == $transportOrder->order_day) selected="true" @endif>{{$i}}</option>
                @endfor
              </select>
               <input type="hidden" class="hidden_day_val" value="{{$transportOrder->order_day}}">
          </div>

        <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_transports_{{$loop->index}}_provider" name="transports[{{$loop->index}}][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}" @if($transportOrder->provider_id == $key) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
            </div>



           <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_transports_{{$loop->index}}_from_country" name="transports[{{$loop->index}}][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_transports_{{$loop->index}}_from_city' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='countries' data-currency_div_id="row_transports_{{$loop->index}}_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" @if($transportOrder->from_country_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_transports_{{$loop->index}}_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select2 cities-list_1 with-dest-city get_places_cat" id="row_transports_{{$loop->index}}_from_city" name="transports[{{$loop->index}}][from_city_id]" data-place_cat_id="row_transports_{{$loop->index}}_source_type" data-place_id="row_transports_{{$loop->index}}_source_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                            @foreach(\ERP::getCitiesListByCountry($transportOrder->from_country_id) as $key => $value)
               <option value="{{$key}}" @if($key == $transportOrder->from_city_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>
  
           <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_source_type">{{__('ERP::attributes.transport.source_type')}}</label>
               <select class="form-control source-type-list with-select2 get_place_type_lists geo_child" id="row_transports_{{$loop->index}}_source_type" name="transports[{{$loop->index}}][sourcable_type]" data-list_type= 'places' data-other_select_id= 'row_transports_{{$loop->index}}_source_place' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='places_types' data-city_div_id="row_transports_{{$loop->index}}_from_city">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                            @foreach(__('ERP::attributes.transport_places') as $key => $value)
               <option value="{{$key}}" @if($key == $transportOrder->sourcable_type) selected="true" @endif>{{$value}}</option>
              @endforeach
 
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_{{$loop->index}}_source_place">{{__('ERP::attributes.transport.source_place')}}</label>
               <select class="form-control with-select2 source-places-list geo_child" id="row_transports_{{$loop->index}}_source_place" name="transports[{{$loop->index}}][sourcable_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                            @foreach(\ERP::getPlacesByType($transportOrder->sourcable_type, $transportOrder->from_city_id) as $key => $value)
               <option value="{{$key}}"@if($key == $transportOrder->sourcable_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

      
      </div> {{-- end row --}}

           <div class="row">


        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_{{$loop->index}}_vehicle_type">{{__('ERP::attributes.transport.vehicle_type')}}</label>
               <select class="form-control selected-service with-select2 vehicles_types-list" id="row_transports_{{$loop->index}}_vehicle_type" name="transports[{{$loop->index}}][vehicle_type_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($vehiclesTypes as $key => $value)
              <option value="{{$key}}" @if($key == $transportOrder->vehicle_type_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

         <div class="form-group col-md-2 required-field">
            <label for="row_transports_{{$loop->index}}_vehicles_num">{{__('ERP::attributes.order.number')}}</label>
            <input id="row_transports_{{$loop->index}}_vehicles_num" type="number" name="transports[{{$loop->index}}][vehicles_num]" placeholder="1" class="form-control general_price_input_group vehicles_num quantity" value="{{$transportOrder->vehicles_num}}">
              
        </div>

          <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_transports_{{$loop->index}}_to_country" name="transports[{{$loop->index}}][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_transports_{{$loop->index}}_to_city' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='countries' data-currency_div_id="row_transports_{{$loop->index}}_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}"  data-currency="{{$row->currency_id}}" @if($transportOrder->to_country_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_transports_{{$loop->index}}_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select2 cities-list_2 with-dest-city get_places_cat" id="row_transports_{{$loop->index}}_to_city" name="transports[{{$loop->index}}][to_city_id]" data-place_cat_id="row_transports_{{$loop->index}}_target_type" data-place_id="row_transports_{{$loop->index}}_target_place" data-geo_child_class="geo_child">
            @foreach(\ERP::getCitiesListByCountry($transportOrder->to_city_id) as $key => $value)
               <option value="{{$key}}" @if($key == $transportOrder->to_city_id) selected="true" @endif>{{$value}}</option>
              @endforeach            </select>
        </div>
  
           <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_target_type">{{__('ERP::attributes.transport.target_type')}}</label>
               <select class="form-control target-type-list with-select2 get_place_type_lists geo_child" id="row_transports_{{$loop->index}}_target_type" name="transports[{{$loop->index}}][targetable_type]" data-list_type= 'places' data-other_select_id= 'row_transports_{{$loop->index}}_target_place' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='places_types' data-city_div_id="row_transports_{{$loop->index}}_to_city">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach(__('ERP::attributes.transport_places') as $key => $value)
               <option value="{{$key}}"@if($key == $transportOrder->targetable_type) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_{{$loop->index}}_target_place">{{__('ERP::attributes.transport.target_place')}}</label>
               <select class="form-control with-select2 target-places-list geo_child" id="row_transports_{{$loop->index}}_target_place" name="transports[{{$loop->index}}][targetable_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                           @foreach(\ERP::getPlacesByType($transportOrder->targetable_type, $transportOrder->to_city_id) as $key => $value)
               <option value="{{$key}}"@if($key == $transportOrder->targetable_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

         
   
           </div> {{-- end row --}}

                    <div class="row">



                   <div class="form-group col-md-2 required-field">
            <label for="row_transports_{{$loop->index}}_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control transport_price_type" id="row_transports_{{$loop->index}}_price_type" name="transports[{{$loop->index}}][price_type]">
                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}" @if($key == $transportOrder->price_type) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_transports_{{$loop->index}}_price">{{__('ERP::attributes.order.price')}}</label>
               <input id="row_transports_{{$loop->index}}_price" type="number" name="transports[{{$loop->index}}][vehicle_price]" placeholder="00.00" class="form-control general_price_input_group price-input" step=".01" value="{{$transportOrder->vehicle_price}}">
          </div>

  
          <input type="hidden" name="transports[{{$loop->index}}][auto_vehicle_price]" class="auto_price"  value="{{$transportOrder->auto_vehicle_price}}">

          @php
          $total_price = ($transportOrder->vehicle_price * $transportOrder->vehicles_num);
          $total_cost = ($transportOrder->vehicle_cost * $transportOrder->vehicles_num);
          @endphp

          <div class="form-group col-md-2">
                   <label for="row_transports_{{$loop->index}}_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_transports_{{$loop->index}}_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="" value="{{$total_price}}">
          </div>

                    <div class="form-group col-md-2 required-field">
                   <label for="row_transports_{{$loop->index}}_cost">{{__('ERP::attributes.order.cost')}}</label>
               <input id="row_transports_{{$loop->index}}_cost" type="number" name="transports[{{$loop->index}}][vehicle_cost]" placeholder="00.00" class="form-control general_price_input_group cost-input" step=".01"  value="{{$transportOrder->vehicle_cost}}">
          </div>

          <input type="hidden" name="transports[{{$loop->index}}][auto_vehicle_cost]" class="auto_cost" value="{{$transportOrder->auto_vehicle_cost}}">


          <div class="form-group col-md-2">
                   <label for="row_transports_{{$loop->index}}_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_transports_{{$loop->index}}_total_cost" type="text"  placeholder="00.00" class="form-control total-cost" step=".01" readonly=""  value="{{$total_cost}}">
          </div>

                  <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_driver_id">{{__('ERP::attributes.main.driver')}}</label>
               <select class="form-control drivers-list with-select2 " id="row_transports_{{$loop->index}}_driver_id" name="transports[{{$loop->index}}][driver_id]" >
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($drivers as $key => $value)

               <option value="{{$key}}" @if($key == $transportOrder->driver_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>



     </div> {{-- end row --}}


      <div class="row">
                  <div class="form-group col-md-2 required-field">
            <label for="row_transports_{{$loop->index}}_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_transports_{{$loop->index}}_leave_date" type="text" name="transports[{{$loop->index}}][leave_date]" class="form-control start-date-input datepicker" readonly=""  value="{{$transportOrder->leave_date}}">
            </div>

         <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_transports_{{$loop->index}}_leave_time" type="text" name="transports[{{$loop->index}}][leave_time]" class="form-control timepicker"   value="{{$transportOrder->leave_time}}">
            </div>

            <div class="form-group col-md-2 required-field">
            <label for="row_transports_{{$loop->index}}_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_transports_{{$loop->index}}_value_currency_id" name="transports[{{$loop->index}}][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

         <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}"  @if($row->id == $transportOrder->new_currency_id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_transports_{{$loop->index}}_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_transports_{{$loop->index}}_value_currency_rate" type="number" name="transports[{{$loop->index}}][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001"  value="{{$transportOrder->new_currency_rate}}">
          </div>

           <input type="hidden" name="transports[{{$loop->index}}][old_currency_id]" class="orig-exchange-id"   value="{{$transportOrder->old_currency_id}}">

           <input type="hidden" name="transports[{{$loop->index}}][old_currency_rate]" class="orig-exchange-rate" step=".000000001"  value="{{$transportOrder->old_currency_rate}}">

          <input type="hidden" name="transports[{{$loop->index}}][main_currency_rate]"  value="{{$transportOrder->main_currency_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="transports[{{$loop->index}}][main_currency_id]" value="{{$transportOrder->main_currency_id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_transports_{{$loop->index}}_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_transports_{{$loop->index}}_due_date" type="text" name="transports[{{$loop->index}}][due_date]" class="form-control datepicker"  value="{{$transportOrder->due_date}}">
            </div>
                                <div class="form-group col-md-2">
                   <label for="row_transports_{{$loop->index}}_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_transports_{{$loop->index}}_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="transports[{{$loop->index}}][prepay_percent]"  value="{{$transportOrder->prepay_percent}}">
        </div>


     </div> {{-- end row --}}

     <div class="row">

                   <div class="form-group col-md-2">
                   <label for="row_transports_{{$loop->index}}_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_transports_{{$loop->index}}_reg_code" type="text" name="transports[{{$loop->index}}][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}"   value="{{$transportOrder->booking_code}}">
          </div>

          <div class="form-group col-md-4">
                   <label for="row_transports_{{$loop->index}}_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_transports_{{$loop->index}}_notes" type="text" name="transports[{{$loop->index}}][order_notes]" class="form-control"  value="{{$transportOrder->order_notes}}">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
        <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="transport"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-row-btn active btn btn-danger" data-row_id="row_transports_{{$loop->index}}" ><i class="fa fa-times"></i></a>
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
                <button class="btn btn-info ladda-button new-general-row-btn" type="button" data-main_row_id="transports_orders" data-main_row_class="transport-row" data-main_row_prefix="row_transports_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



