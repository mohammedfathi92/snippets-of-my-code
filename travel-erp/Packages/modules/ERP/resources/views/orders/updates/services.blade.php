
<div id="services_orders">

   @foreach($orderServicesList as $serviceOrder)

<div id="row_services_{{$loop->index}}" class="service-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="{{$loop->index}}">
   <div class="alert alert-danger" style="display: none;" id="alert_row_services_{{$loop->index}}">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
          <input type="hidden" name="services[{{$loop->index}}][service_order_id]" value="{{$serviceOrder->hashed_id}}">


    <input type="hidden" value="false" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_services_{{$loop->index}}_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="services[{{$loop->index}}][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                @for($i=1; $i < $order->duration; $i++)
                <option value="{{$i}}" @if($i == $serviceOrder->order_day) selected="true" @endif>{{$i}}</option>
                @endfor
              </select>
               <input type="hidden" class="hidden_day_val" value="{{$serviceOrder->order_day}}">
          </div>

 <div class="form-group col-md-2 required-field">
            <label for="row_services_{{$loop->index}}_start_date">{{__('ERP::attributes.order.start_date')}}</label>
              <input id="row_services_{{$loop->index}}_start_date" type="text" name="services[{{$loop->index}}][start_date]" class="form-control start-date-input datepicker" readonly="" value="{{$serviceOrder->start_date}}">
        </div>

        <div class="form-group col-md-2">
            <label for="row_services_{{$loop->index}}_start_time">{{__('ERP::attributes.order.start_time')}}</label>
              <input id="row_services_{{$loop->index}}_start_time" type="text" name="services[{{$loop->index}}][start_time]" class="form-control timepicker"  value="{{$serviceOrder->start_time}}">
        </div>

           <div class="form-group col-md-2">
            <label for="row_services_{{$loop->index}}_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list_1 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_services_{{$loop->index}}_country" name="services[{{$loop->index}}][country_id]" data-list_type= 'cities' data-other_select_id= 'row_services_{{$loop->index}}_city' data-select2_class= 'with-select2'  data-closest_class ='service-row' data-item_type='countries' data-currency_div_id="row_services_{{$loop->index}}_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}" @if($serviceOrder->country_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>
           </div>

        <div class="form-group col-md-2"> 
            <label for="row_services_{{$loop->index}}_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select2 cities-list_1 with-dest-city get_geo_lists" id="row_services_{{$loop->index}}_city" name="services[{{$loop->index}}][city_id]" data-list_type= 'services' data-other_select_id= 'row_services_{{$loop->index}}_service' data-select2_class= 'with-select2'  data-closest_class ='service-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                             @foreach(\ERP::getCitiesListByCountry($serviceOrder->country_id) as $key => $value)
               <option value="{{$key}}" @if($key == $serviceOrder->city_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

  
           <div class="form-group col-md-2 required-field">
            <label for="row_services_{{$loop->index}}_service">{{__('ERP::attributes.order.service')}}</label>
               <select class="form-control selected-service with-select2 geo_child" id="row_services_{{$loop->index}}_service" name="services[{{$loop->index}}][service_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>

                            @foreach(\ERP::getServicesList($serviceOrder->city_id) as $key => $value)
               <option value="{{$key}}" @if($key == $serviceOrder->service_id) selected="true" @endif>{{$value}}</option>
              @endforeach
             
             
            </select>
            </div>

      
           </div> {{-- end row --}}


           <div class="row">



          <div class="form-group col-md-2 required-field">
            <label for="row_services_{{$loop->index}}_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control service_price_type" id="row_services_{{$loop->index}}_price_type" name="services[{{$loop->index}}][price_type]">
               @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}"  @if($serviceOrder->price_type == $key) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

            <div class="form-group col-md-2 required-field">
                   <label for="row_services_{{$loop->index}}_quantity">{{__('ERP::attributes.order.quantity')}}</label>
               <input id="row_services_{{$loop->index}}_quantity" type="number" name="services[{{$loop->index}}][quantity]" placeholder="1" class="form-control general_price_input_group quantity"  value="{{$serviceOrder->quantity}}">
          </div>


          <div class="form-group col-md-2 required-field">
                   <label for="row_services_{{$loop->index}}_price">{{__('ERP::attributes.order.price')}}</label>
               <input id="row_services_{{$loop->index}}_price" type="number" name="services[{{$loop->index}}][price]" placeholder="00.00" class="form-control general_price_input_group price-input" step=".01"  value="{{$serviceOrder->price}}">
          </div>
          @php
          $total_price = $serviceOrder->quantity * $serviceOrder->price;
          $total_cost = $serviceOrder->quantity * $serviceOrder->cost;
          @endphp

  
        {{--   <input type="hidden" name="services[{{$loop->index}}][auto_price]" class="auto_price"  value="{{$serviceOrder->auto_price}}"> --}}


          <div class="form-group col-md-2">
                   <label for="row_services_{{$loop->index}}_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_services_{{$loop->index}}_total_price" type="text"  placeholder="00.00" class="form-control total-price" step=".01"  value="{{$total_price}}" readonly="true">
          </div>

            <div class="form-group col-md-2 required-field">
                   <label for="row_services_{{$loop->index}}_cost">{{__('ERP::attributes.order.cost')}}</label>
               <input id="row_services_{{$loop->index}}_cost" type="number" name="services[{{$loop->index}}][cost]" placeholder="00.00" class="form-control general_price_input_group cost-input" step=".01"  value="{{$serviceOrder->cost}}">
          </div>

          <input type="hidden" name="services[{{$loop->index}}][auto_cost]" class="auto_cost"   value="{{$serviceOrder->auto_cost}}">


          <div class="form-group col-md-2">
                   <label for="row_services_{{$loop->index}}_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_services_{{$loop->index}}_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01"  readonly="true"  value="{{$total_cost}}">
          </div>


     </div> {{-- end row --}}

  

          <div class="row">


          <div class="form-group col-md-2">
            <label for="row_services_{{$loop->index}}_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_services_{{$loop->index}}_provider" name="services[{{$loop->index}}][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}" @if($serviceOrder->provider_id == $key) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
        </div>


            <div class="form-group col-md-2 required-field">
            <label for="row_services_{{$loop->index}}_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_services_{{$loop->index}}_value_currency_id" name="services[{{$loop->index}}][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}" @if($serviceOrder->new_currency_id == $row->id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_services_{{$loop->index}}_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_services_{{$loop->index}}_value_currency_rate" type="number" name="services[{{$loop->index}}][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001" value="{{$serviceOrder->new_currency_rate}}">
          </div>

           <input type="hidden" name="services[{{$loop->index}}][old_currency_id]" class="orig-exchange-id"  value="{{$serviceOrder->old_currency_id}}">

           <input type="hidden" name="services[{{$loop->index}}][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001"  value="{{$serviceOrder->old_currency_rate}}">

          <input type="hidden" name="services[{{$loop->index}}][main_currency_rate]" value="{{$serviceOrder->main_currency_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="services[{{$loop->index}}][main_currency_id]" value="{{$serviceOrder->main_currency_id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_services_{{$loop->index}}_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_services_{{$loop->index}}_due_date" type="text" name="services[{{$loop->index}}][due_date]" class="form-control datepicker"  value="{{$serviceOrder->due_date}}">
            </div>

             <div class="form-group col-md-2">
                   <label for="row_services_{{$loop->index}}_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_services_{{$loop->index}}_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="services[{{$loop->index}}][prepay_percent]"  value="{{$serviceOrder->prepay_percent}}">
        </div>
                   <div class="form-group col-md-2">
                   <label for="row_services_{{$loop->index}}_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_services_{{$loop->index}}_reg_code" type="text" name="services[{{$loop->index}}][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}"  value="{{$serviceOrder->booking_code}}">
          </div>


        

       


     </div> {{-- end row --}}



     <div class="row">

             

          <div class="form-group col-md-4">
                   <label for="row_services_{{$loop->index}}_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_services_{{$loop->index}}_notes" type="text" name="services[{{$loop->index}}][booking_notes]" class="form-control"  value="{{$serviceOrder->booking_notes}}">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="service"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-row-btn active btn btn-danger" data-row_id="row_services_{{$loop->index}}" ><i class="fa fa-times"></i></a>
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
                <button class="btn btn-info ladda-button new-general-row-btn" type="button" data-main_row_id="services_orders" data-main_row_class="service-row" data-main_row_prefix="row_services_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



