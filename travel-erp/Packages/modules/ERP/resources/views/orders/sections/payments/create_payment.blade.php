   {!! Form::model($payment, ['url' => url($resource_url.'/'.$order->hashed_id.'/payments/store'),'method'=>'POST','files'=>true,'class'=>'ajax-form']) !!}

   <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- payments fields here-->
                        <div class="row">

                        <div class="col-md-4">
                          {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',$payment->exists?true:false,null) !!}
                         </div>

                <div class="col-md-4">
                  {!! PackagesForm::select('sub_type','ERP::attributes.financials.payment_item',__('ERP::attributes.financials.orders_sub_types_options'),true) !!}
                </div>

                         <input type="hidden" name="main_order_id" value="{{$order->id}}">

                         <input type="hidden" name="itemable_id" value="{{$order->id}}">
                         <input type="hidden" name="itemable_type" value="erp_main_order">

{{-- <div class="form-group col-md-4 required-field">
            <label for="row_payment_items">{{__('ERP::attributes.financials.payment_item')}}</label>
               <select class="form-control with-select2" id="row_payment_items" name="itemable_id">

             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>

              <option value="{{$order->id}}" data-type="erp_main_order">{{__('ERP::attributes.financials.for_all_order')}}
              </option>

             @if($hotels->count())

                 <optgroup label="{{__('ERP::attributes.financials.order_groups.hotels')}}">
                 @foreach($hotels as $row)   
                  <option value="{{$row->id}}" data-type="erp_hotel_order">{{$row->hotel?$row->hotel->name:''}}</option>
                  @endforeach
                 </optgroup>
              @endif
              @if($flights->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.flights')}}">
                 @foreach($flights as $row)   
                  <option value="{{$row->id}}" data-type="erp_flight_order">{{$row->airline?$row->airline->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
              @if($ferries->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.ferries')}}">
                 @foreach($ferries as $row)   
                  <option value="{{$row->id}}" data-type="erp_ferry_order">{{$row->ferry?$row->ferry->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
                  @if($buses->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.buses')}}">
                 @foreach($buses as $row)   
                  <option value="{{$row->id}}" data-type="erp_bus_order">{{$row->bus?$row->bus->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
               @if($transports->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.transports')}}">
                 @foreach($transports as $row)   
                  <option value="{{$row->id}}" data-type="erp_transport_order">{{$row->vehicleType?$row->vehicleType->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif

               @if($services->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.services')}}">
                 @foreach($services as $row)   
                  <option value="{{$row->id}}" data-type="erp_service_order">{{$row->service?$row->service->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
               @if($activities->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.activities')}}">
                 @foreach($activities as $row)   
                  <option value="{{$row->id}}" data-type="erp_activity_order">{{$row->activity?$row->activity->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif


            </select>
            <input type="hidden" name="itemable_type" class="itemable-type">
        </div> --}}

         <div class="col-md-4">
         {!! PackagesForm::number('reg_value', 'ERP::attributes.financials.value',true, null, ['step'=> ".01", 'placeholder' => '0.00', 'id' => 'final_value'] ) !!}
             <input type="hidden" name="value_type" value="amount">
             </div>



                        </div>
               <div class="row">
                <div class="col-md-4">
                  {!! PackagesForm::select('to_account_cat_id','ERP::attributes.financials.account_type',\ERP::getCategoriesByType('financial_accounts'),true,null, ['class' => 'get-category-accounts', 'data-other_id' => 'fin_to_account_id'],'select2') !!}
                </div>

                 <div class="col-md-4">
                  {!! PackagesForm::select('to_account_id','ERP::attributes.financials.to_account',[],true,null, ['id' => 'fin_to_account_id'],'select2') !!}
                </div>

                 <div class="col-md-4">
                  {!! PackagesForm::select('pay_method_id','ERP::attributes.financials.payment_method',\ERP::getCategoriesByType('payment_methods'),true,null,[],'select2') !!}
                </div>
                
               </div>         

           <div class="row">
            <div class="form-group col-md-4 required-field">
            <label for="row_payment_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_payment_value_currency_id" name="value_currency_id">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach(\ERP::getCurrenciesData() as $row)
              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-4 required-field">
                   <label for="row_payment_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_payment_value_currency_rate" type="number" name="value_currency_rate" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="old_currency_rate" class="orig-exchange-rate" value="" step=".000000001">

                <input type="hidden" name="main_currency_id" value="{{$main_currency->id}}">

                     <input type="hidden" name="main_currency_rate" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">


                        <div class="col-md-4">
                          {!! PackagesForm::text('fees_percent','ERP::attributes.main.fees_percent',$payment->exists?true:false,null) !!}
                        </div>

        </div>


                    <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::text('payment_date','ERP::attributes.main.payment_date',false,null,['class' => 'datepicker']) !!}
                         </div> 

                        <div class="col-md-4">
                          {!! PackagesForm::text('refrence_code','ERP::attributes.financials.refrence_code',true,null) !!}
                         </div> 

                       <div class="col-md-4">
                          {!! PackagesForm::select('recipient_id','ERP::attributes.financials.recipient',\ERP::getEmployeesList(),true,null, [], 'select2') !!}
                        </div> 
                        <div class="col-md-4">
                          {!! PackagesForm::select('status','ERP::attributes.main.status',__('ERP::attributes.main.int_status_options'),true,null) !!}
                        </div>  
                        
                    </div>

                    <hr>

                                         {{-- translation row --}}
                    <div class="row">
                     @if(count(\Settings::get('supported_languages', [])) > 0)   

                     <div class="nav-tabs-custom" id="tabs">
                        <ul class="nav nav-tabs">
                                @foreach (\Language::allowed() as $code => $name) 
                                  <li class="{{ $code=='ar'?'active':'' }}"><a data-target="#lang_{{ $code }}" data-toggle="tab"  href>{{ $name }}</a></li>
                                @endforeach 
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;">

                     @foreach (\Language::allowed() as $code => $name) 
                     
                    <div class="{{ $code=='ar'?'active':'' }} tab-pane" id="lang_{{ $code }}">

                        {!! PackagesForm::text('description['.$code.']','ERP::attributes.financials.brief_description',false,null,['maxlength' => '100']) !!}

                       {!! PackagesForm::textarea('notes['.$code.']','ERP::attributes.main.notes',false) !!}
                  
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                                    <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::radio('select_commission','ERP::attributes.financials.select_commission',false, __('ERP::attributes.main.yes_no'), 'yes', ['class' => 'create_commission']) !!}

                        </div>
                    </div>

                    <div class="row commission-row" style="display: none;">
                        <div class="col-md-3">
                         <div style="display: inline-flex;">
                            {!! PackagesForm::number('commission[reg_value]', 'ERP::attributes.financials.commission_value',false, null, ['step'=> ".01", 'placeholder' => '0.00', 'id' => 'commission_reg_value'] ) !!}
                             {!! PackagesForm::select('commission[value_type]','ERP::attributes.financials.label_commission_type',__('ERP::attributes.financials.commission_type_options'),false,null, ['class' => 'commission-type']) !!}
                         
                         </div>
                         </div>


                        <div class="col-md-3">
                          {!! PackagesForm::select('commission[to_user_id]','ERP::attributes.financials.to_user',\ERP::getAgentsList(),true,null, ['class' => 'get-user-account', 'data-other_id' => 'commission_to_account'], 'select2') !!}
                        </div>

                         <div class="col-md-3">
                          {!! PackagesForm::select('commission[to_account_id]','ERP::attributes.financials.to_account',[],true,null, ['id' => 'commission_to_account'], 'select2') !!}
                        </div>

                        <div class="col-md-3">
                          {!! PackagesForm::text('commission[reg_code]','ERP::attributes.main.reg_code',$payment->exists?true:false,null) !!}
                         </div>
 

{{--                         <input type="hidden" name="commission[description]" value="{{__('ERP::attributes.financials.disacriptions.commission_order', ['order' => $order->reg_code])}}"> --}}

                    </div>

                    <br>


              </div> 

              </div>     

<div class="col-md-12">
                        <div class="form-group  text-right"><button class="btn btn-success ladda-button" type="button" data-style="expand-right" data-toggle="modal" data-target="#confirm_create_payment"><span class="ladda-label"><i class="fa fa-save"></i>{{__('ERP::attributes.main.create_btn')}}</span><span class="ladda-spinner"></span></button></div>
                    </div>

                      <!-- Modal -->
  <div class="modal fade" id="confirm_create_payment" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
          <p style="text-align: center; font-size: 80px;"><i class="fa fa-warning" style="color: rgba(255, 112, 20, 0.69)"></i></p>
          <h3 style="text-align: center;">{{__('ERP::attributes.financials.confirm_you_request')}}</h3>
          <p style="text-align: center;">{{__('ERP::attributes.financials.alert_modal_create_new_financial')}}</p>
            <button type="submit" class="btn btn-danger">{{__('ERP::attributes.main.confirm_btn')}}</button>&nbsp;&nbsp;<button type="button" class="btn btn-default" data-dismiss="modal">{{__('ERP::attributes.main.cancel_btn')}}</button>

        </div>

      </div>
      
    </div>
  </div>

                     {!! Form::close() !!}
 

