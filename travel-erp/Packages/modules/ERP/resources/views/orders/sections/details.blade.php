  <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- provider provider fields here-->

            <div class="row">
             <div class="col-md-3">
              {!! PackagesForm::text('general_data[reg_code]','ERP::attributes.main.reg_code',false,$order->reg_code) !!}
                 </div>

             <div class="col-md-3" >
               {!! PackagesForm::select('general_data[branch_id]','ERP::attributes.main.branch', $branches,true,$order->branch_id,[],'select2') !!}
                         </div>
                <div class="col-md-3" >
               {!! PackagesForm::select('general_data[purpose_id]','ERP::attributes.vouchers.purpose', \ERP::getCategoriesByType('orders_purposes'),true,null,[],'select2') !!}
                         </div>

                 <div class="col-md-3 ">

                  <div class="form-group required-field">

               <label for="order_type">{{__('ERP::attributes.order.customer')}}</label>

              <div class="input-group">

              <select class="form-control with-select2" id="customer_id" name="general_data[customer_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($customers as $row)
              <option value="{{$row->id}}" @if($order->customer_id == $row->id) selected="" @endif>{{$row->translated_name.' - '.$row->user_code}}</option>
              @endforeach
              
            </select>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" id="open_new_customer_modal"><i class="fa fa-plus-circle"></i></button>
                    </span>
          </div>
                 </div>
                 
                 </div>


                    </div>

                    <div class="row">

                  <div class="col-md-3">
                           {!! PackagesForm::select('general_data[agent_id]','ERP::attributes.users.agent',$agents,false,$order->agent_id, [], 'select2') !!}

                        </div>

                        <div class="col-md-3">
              <div class="form-group required-field">

               <label for="destination_id">{{__('ERP::attributes.order.destination')}}</label>


              <select class="form-control with-select2" id="destination_id" name="general_data[destination_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
              <option value="{{$row->id}}" data-currency="{{$row->currency_id}}" @if($order->destination_id == $row->id) selected="" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>
              @if ($errors->has('destination_id'))
                  <span class="help-block" style="color: red;">
                    <strong>{{ $errors->first('destination_id') }}</strong>
                  </span>
              @endif

                 </div>
                        </div>
                        <div class="col-md-3">

               <div class="form-group required-field">

               <label for="currency_id">{{__('ERP::attributes.main.currency')}}</label>


              <select class="form-control get-currency-rate with-select2" id="currency_id" name="general_data[currency_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>

              @foreach($currencies as $row)
              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}" @if($order->currency_id == $row->id) selected="" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>

                 </div>


                        </div>

                         <div class="col-md-3" >
                                                   
                          <div class="form-group required-field">
                   <label for="manual_currency_rate">{{__('ERP::attributes.order.currency_rate')}} </label>

                           <input id="manual_currency_rate" type="number" name="general_data[manual_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001" value="{{$order->manual_currency_rate}}">
                         </div>
                       
                               {{-- hiddens info --}}
                      <input type="hidden" name="general_data[auto_currency_rate]" class="orig-exchange-rate" value="{{$order->auto_currency_rate}}">
                      <input type="hidden" name="general_data[main_currency_rate]" value="{{$order->exists?$order->main_currency_rate:$main_currency->exchange_rate}}" class="main-currency-rate">
                    <input type="hidden" name="general_data[main_currency_id]" value="{{$order->exists?$order->main_currency_id:$main_currency->id}}" class="main-currency-id">


                         </div>

                      </div>

@php
$dateNow = \Carbon\Carbon::now()->toDateString();
$dateTimeNow = \Carbon\Carbon::now()->toDateTimeString();
@endphp
                    <div class="row">
                        <div class="col-md-3">
                          {!! PackagesForm::text('general_data[order_date]','ERP::attributes.order.reg_date',true,$order->order_date?$order->order_date:$dateNow,['class' => 'datepicker']) !!}
                            
                            
                        </div>
                         <div class="col-md-3">
                            {!! PackagesForm::text('general_data[start_date]','ERP::attributes.order.start_date',true,$order->start_date?$order->start_date:$dateNow,['id' => 'general_data_start_date', 'class' => 'datepicker']) !!}
                             
                         </div>
                        <div class="col-md-3 ">
                           {!! PackagesForm::number('general_data[duration]','ERP::attributes.order.duration',true,$order->exists?$order->duration:1,['min'=>'1', 'id' => 'order_duration_value']) !!}
                         </div>
                         <div class="col-md-3">
                           {!! PackagesForm::text('general_data[end_date]','ERP::attributes.order.end_date',true,$order->end_date?$order->end_date:$dateNow,['id' => 'general_data_end_date', 'class' => 'datepicker']) !!}
                             
                         </div>

                         
                      </div>

                    <div class="row">
                         
                         <div class="col-md-3">
                            {!! PackagesForm::number('general_data[adult_numbers]','ERP::attributes.order.adult_numbers',false,$order->adult_numbers) !!}
                         </div>
                         <div class="col-md-3">
                           {!! PackagesForm::number('general_data[child_numbers]','ERP::attributes.order.child_numbers',false,$order->child_numbers) !!}
                         </div>
                         <div class="col-md-3 ">
                           {!! PackagesForm::number('general_data[infant_numbers]','ERP::attributes.order.infant_numbers',false,$order->infant_numbers) !!}
                         </div>
                        <div class="col-md-3">
                              {!! PackagesForm::select('general_data[referred_by_id]','ERP::attributes.order.referred_by', \ERP::getCategoriesByType('referred_by'),false,$order->referred_by_id,[], 'select2') !!}
                         </div>
                      </div>


                       <div class="row">
                          <div class="col-md-3" > 
                             {!! PackagesForm::select('general_data[status]','ERP::attributes.order.order_status',__('ERP::attributes.order.order_int_status_options'),true,$order->status) !!}
                         </div>
                       </div>
                      <div class="row">
                    
                         <div class="col-md-6" > 
                           {!! PackagesForm::textArea('general_data[agent_notes]','ERP::attributes.order.agent_notes',false,$order->agent_notes) !!}
                         </div>
                     <div class="col-md-6" > 
                           {!! PackagesForm::textArea('general_data[order_notes]','ERP::attributes.order.general_notes',false,$order->order_notes) !!}
                         </div>
                    
                      </div>
                   
                   </div>
                     
                </div>