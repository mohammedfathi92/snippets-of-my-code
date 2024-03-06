<div id="activities_orders">

  @foreach($orderActivitiesList as $activityOrder)
<div id="row_activities_{{$loop->index}}" class="activity-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="{{$loop->index}}">
   <div class="alert alert-danger" style="display: none;" id="alert_row_activities_{{$loop->index}}">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
                   <input type="hidden" name="activities[{{$loop->index}}][activity_order_id]" value="{{$activityOrder->hashed_id}}">

  <input type="hidden" value="true" class="classfy-prices">

<div class="row">
         
          <div class="form-group col-md-2 day-row required-field">
            <label for="row_hotels_{{$loop->index}}_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control hotel-day order-days" name="activities[{{$loop->index}}][order_day]">
                @for($i=1; $i < $order->duration; $i++)
                <option value="{{$i}}" @if($i == $activityOrder->order_day) selected="true" @endif>{{$i}}</option>
                @endfor
              </select>
               <input type="hidden" class="hidden_day_val" value="{{$activityOrder->order_day}}">
          </div>

          <div class="form-group col-md-2 required-field">
            <label for="row_activities_{{$loop->index}}_start_date">{{__('ERP::attributes.order.start_date')}}</label>
              <input id="row_activities_{{$loop->index}}_start_date" type="text" name="activities[{{$loop->index}}][start_date]" class="form-control start-date-input datepicker" readonly="" value="{{$activityOrder->start_date}}">
        </div>

        <div class="form-group col-md-2">
            <label for="row_activities_{{$loop->index}}_start_time">{{__('ERP::attributes.order.start_time')}}</label>
              <input id="row_activities_{{$loop->index}}_start_time" type="text" name="activities[{{$loop->index}}][start_time]" class="form-control timepicker" value="{{$activityOrder->start_time}}">
        </div>

           <div class="form-group col-md-2">
            <label for="row_activities_{{$loop->index}}_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list_1 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_activities_{{$loop->index}}_country" name="activities[{{$loop->index}}][country_id]" data-list_type= 'cities' data-other_select_id= 'row_activities_{{$loop->index}}_city' data-select2_class= 'with-select2'  data-closest_class ='activity-row' data-item_type='countries' data-currency_div_id="row_activities_{{$loop->index}}_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}" @if($activityOrder->country_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_activities_{{$loop->index}}_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select2 cities-list_1 with-dest-city get_geo_lists" id="row_activities_{{$loop->index}}_city" name="activities[{{$loop->index}}][city_id]" data-list_type= 'activities' data-other_select_id= 'row_activities_{{$loop->index}}_activity' data-select2_class= 'with-select2'  data-closest_class ='activity-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
               @foreach(\ERP::getCitiesListByCountry($activityOrder->country_id) as $key => $value)
               <option value="{{$key}}" @if($key == $activityOrder->city_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

           <div class="form-group col-md-2 required-field">
            <label for="row_activities_{{$loop->index}}_activity">{{__('ERP::attributes.order.activity')}}</label>
               <select class="form-control selected-service with-select2 geo_child" id="row_activities_{{$loop->index}}_activity" name="activities[{{$loop->index}}][activity_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>

              @foreach(\ERP::getActivitiesList($activityOrder->city_id) as $key => $value)
               <option value="{{$key}}" @if($key == $activityOrder->activity_id) selected="true" @endif>{{$value}}</option>
              @endforeach
             
             
            </select>
            </div>

      
           </div> {{-- end row --}}

          

             <div class="row">
      <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_adults_number">{{__('ERP::attributes.order.adult_numbers')}}</label>
          <input id="row_activities_{{$loop->index}}_adults_number" type="number" name="activities[{{$loop->index}}][adult_numbers]" placeholder="{{$loop->index}}" class="form-control adult_numbers general_price_input_group" value="{{$activityOrder->adult_numbers}}">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_adult_price">{{__('ERP::attributes.flight.price_adult')}}</label>
          <input id="row_activities_{{$loop->index}}_adult_price" type="number" name="activities[{{$loop->index}}][adult_price]" placeholder="00.00" class="form-control adult_price general_price_input_group" step=".001" value="{{$activityOrder->adult_price}}">
       </div>
       <input type="hidden" name="activities[{{$loop->index}}][auto_adult_price]" class="auto_adult_price" value="{{$activityOrder->auto_adult_price}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_adult_cost">{{__('ERP::attributes.flight.cost_adult')}}</label>
          <input id="row_activities_{{$loop->index}}_adult_cost" type="number" name="activities[{{$loop->index}}][adult_cost]" placeholder="00.00" class="form-control adult_cost general_price_input_group" step=".01" value="{{$activityOrder->adult_cost}}">
       </div>

        <input type="hidden" name="activities[{{$loop->index}}][auto_adult_cost]" class="auto_adult_cost" value="{{$activityOrder->auto_adult_cost}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_child_number">{{__('ERP::attributes.order.child_numbers')}}</label>
          <input id="row_activities_{{$loop->index}}_child_number" type="number" name="activities[{{$loop->index}}][child_numbers]" placeholder="{{$loop->index}}" class="form-control child_numbers general_price_input_group"  value="{{$activityOrder->child_numbers}}">
       </div>


     <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_child_price">{{__('ERP::attributes.flight.price_child')}}</label>
          <input id="row_activities_{{$loop->index}}_child_price" type="number" name="activities[{{$loop->index}}][child_price]" placeholder="00.00" class="form-control child_price general_price_input_group" step=".01" value="{{$activityOrder->child_price}}">

       </div>
       <input type="hidden" name="activities[{{$loop->index}}][auto_child_price]" class="auto_child_price"  value="{{$activityOrder->auto_child_price}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_child_cost">{{__('ERP::attributes.flight.cost_child')}}</label>
          <input id="row_activities_{{$loop->index}}_child_cost" type="number" name="activities[{{$loop->index}}][child_cost]" placeholder="00.00" class="form-control child_cost general_price_input_group" step=".01"   value="{{$activityOrder->child_cost}}">
       </div>
       <input type="hidden" name="activities[{{$loop->index}}][auto_child_cost]" class="auto_child_cost"  value="{{$activityOrder->auto_child_cost}}">
  </div> {{-- end row --}}


<div class="row">
         <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_infant_number">{{__('ERP::attributes.order.infant_numbers')}}</label>
          <input id="row_activities_{{$loop->index}}_infant_number" type="number" name="activities[{{$loop->index}}][infant_numbers]" placeholder="{{$loop->index}}" class="form-control infant_numbers general_price_input_group"   value="{{$activityOrder->infant_numbers}}">
       </div>

     <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_infant_price">{{__('ERP::attributes.flight.price_infant')}}</label>
          <input id="row_activities_{{$loop->index}}_infant_price" type="number" name="activities[{{$loop->index}}][infant_price]" placeholder="00.00" class="form-control infant_price general_price_input_group" step=".01" value="{{$activityOrder->infant_price}}">
       </div>

        <input type="hidden" name="activities[{{$loop->index}}][auto_infant_price]" class="auto_infant_price" value="{{$activityOrder->auto_infant_price}}">

       <div class="form-group col-md-2 required-field">
          <label for="row_activities_{{$loop->index}}_infant_cost">{{__('ERP::attributes.flight.cost_infant')}}</label>
          <input id="row_activities_{{$loop->index}}_infant_cost" type="number" name="activities[{{$loop->index}}][infant_cost]" placeholder="00.00" class="form-control infant_cost general_price_input_group" step=".01" value="{{$activityOrder->infant_cost}}">
       </div>
        <input type="hidden" name="activities[{{$loop->index}}][auto_infant_cost]" class="auto_infant_cost"  value="{{$activityOrder->auto_infant_cost}}">

        
           <div class="form-group col-md-2 required-field">
            <label for="row_activities_{{$loop->index}}_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control activity_price_type" id="row_activities_{{$loop->index}}_price_type" name="activities[{{$loop->index}}][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}"  @if($activityOrder->price_type == $key) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>
  
        @php

        $total_price = ($activityOrder->adult_price *  $activityOrder->adult_numbers)+ ($activityOrder->child_price *  $activityOrder->child_numbers) + ($activityOrder->infant_numbers * $activityOrder->infant_price);
        $total_cost = ($activityOrder->adult_cost *  $activityOrder->adult_numbers)+ ($activityOrder->child_cost *  $activityOrder->child_numbers) + ($activityOrder->infant_numbers * $activityOrder->infant_cost);

        @endphp

          <div class="form-group col-md-2">
                   <label for="row_activities_{{$loop->index}}_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_activities_{{$loop->index}}_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="" value="{{number_format($total_price,2)}}">
          </div>


          <div class="form-group col-md-2">
                   <label for="row_activities_{{$loop->index}}_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_activities_{{$loop->index}}_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly=""  value="{{number_format($total_cost,2)}}">
          </div>

      
        </div> {{-- end row --}}

          <div class="row">


          <div class="form-group col-md-2">
            <label for="row_activities_{{$loop->index}}_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_activities_{{$loop->index}}_provider" name="activities[{{$loop->index}}][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}" @if($activityOrder->provider_id == $key) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
        </div>


            <div class="form-group col-md-2 required-field">
            <label for="row_activities_{{$loop->index}}_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_activities_{{$loop->index}}_value_currency_id" name="activities[{{$loop->index}}][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}" @if($activityOrder->new_currency_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_activities_{{$loop->index}}_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_activities_{{$loop->index}}_value_currency_rate" type="number" name="activities[{{$loop->index}}][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001" value="{{$activityOrder->new_currency_rate}}">
          </div>

           <input type="hidden" name="activities[{{$loop->index}}][old_currency_id]" class="orig-exchange-id" value="{{$activityOrder->old_currency_id}}">

           <input type="hidden" name="activities[{{$loop->index}}][old_currency_rate]" class="orig-exchange-rate" value="{{$activityOrder->old_currency_rate}}" step=".000000001">

          <input type="hidden" name="activities[{{$loop->index}}][main_currency_rate]" value="{{$activityOrder->main_currency_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="activities[{{$loop->index}}][main_currency_id]" value="{{$activityOrder->main_currency_id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_activities_{{$loop->index}}_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_activities_{{$loop->index}}_due_date" type="text" name="activities[{{$loop->index}}][due_date]" class="form-control datepicker" value="{{$activityOrder->due_date}}">
            </div>

             <div class="form-group col-md-2">
                   <label for="row_activities_{{$loop->index}}_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_activities_{{$loop->index}}_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="activities[{{$loop->index}}][prepay_percent]"  value="{{$activityOrder->prepay_percent}}">
        </div>
                   <div class="form-group col-md-2">
                   <label for="row_activities_{{$loop->index}}_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_activities_{{$loop->index}}_reg_code" type="text" name="activities[{{$loop->index}}][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}"   value="{{$activityOrder->booking_code}}">
          </div>


        

       


     </div> {{-- end row --}}



     <div class="row">

             

          <div class="form-group col-md-6">
                   <label for="row_activities_{{$loop->index}}_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_activities_{{$loop->index}}_notes" type="text" name="activities[{{$loop->index}}][booking_notes]" class="form-control" value="{{$activityOrder->booking_notes}}">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
        <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="activity"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-row-btn active btn btn-danger" data-row_id="row_activities_{{$loop->index}}" ><i class="fa fa-times"></i></a>
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
                <button class="btn btn-info ladda-button new-general-row-btn" type="button" data-main_row_id="activities_orders" data-main_row_class="activity-row" data-main_row_prefix="row_activities_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



