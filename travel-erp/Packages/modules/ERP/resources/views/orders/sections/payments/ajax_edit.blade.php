

@php
$main_currency = getMainCurrency();
@endphp

 {!! Form::model($payment, ['url' => url('erp/orders/'.$order->hashed_id.'/payments/ajax/'.$payment->hashed_id.'/update'),'method'=>'PUT','files'=>true,'class'=>'ajax-form']) !!}

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{__('ERP::attributes.financials.title_update_financial',['no' => $payment->reg_code])}}</h4>
        </div>
        <div class="modal-body">

   @if($payment->type == 'commission' && $payment->parent)
           <div class="alert alert-info">
  <strong>{{__('ERP::messages.orders.alert_type_name.info')}}!</strong> {{__('ERP::messages.orders.alert_financial_has_commission', ['no' => $payment->reg_code, 'value' => $payment->parent->final_value.' '.($payment->currency?$payment->currency->name:'')])}}.
</div>
<br>
@endif

   <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- payments fields here-->

      <div class="row">
            <div class="form-group col-md-6 required-field">
            <label for="row_payment_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_payment_value_currency_id" name="value_currency_id">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach(\ERP::getCurrenciesData() as $row)
              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}" @if($row->id == ($payment->currency?$payment->currency->id:0)) selected="" @endif>{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-6 required-field">
                   <label for="row_payment_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_payment_value_currency_rate" type="number" name="value_currency_rate" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001" value="{{$payment->currency?$payment->currency->exchange_rate:''}}">
          </div>

           <input type="hidden" name="old_currency_rate" class="orig-exchange-rate" value="" step=".000000001" value="{{$payment->currency?$payment->currency->exchange_rate:''}}">

                <input type="hidden" name="main_currency_id" value="{{$main_currency->id}}">

                     <input type="hidden" name="main_currency_rate" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">


        </div>


                    <div class="row">

                     <div class="col-md-6">
                          {!! PackagesForm::select('status','ERP::attributes.main.status',__('ERP::attributes.main.int_status_options'),true,null) !!}
                        </div> 

                <div class="col-md-6">
                  {!! PackagesForm::select('update_reason_id','ERP::attributes.financials.update_reason',\ERP::getCategoriesByType('update_financial_reasons'),true,null,[],'select2') !!}
                </div>
                    </div>

                    <hr>

                                         {{-- translation row --}}
                    <div class="row">
                     @if(count(\Settings::get('supported_languages', [])) > 0)   

                     <div class="nav-tabs-custom" id="tabs">
                        <ul class="nav nav-tabs">
                                @foreach (\Language::allowed() as $code => $name) 
                                  <li class="{{ $code=='ar'?'active':'' }}"><a data-target="#lang_extra_reasons_{{ $code }}" data-toggle="tab"  href>{{ $name }}</a></li>
                                @endforeach 
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;">

                     @foreach (\Language::allowed() as $code => $name) 
                     
                    <div class="{{ $code=='ar'?'active':'' }} tab-pane" id="lang_extra_reasons_{{ $code }}">

                        {!! PackagesForm::text('extra_update_reasons['.$code.']','ERP::attributes.financials.extra_update_reason',false,$payment->getTranslation('extra_update_reasons', $code),['maxlength' => '100']) !!}
                  
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

              </div> 

              </div>     


 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{__('ERP::attributes.main.close')}}</button> <button class="btn btn-success ladda-button" type="submit" data-style="expand-right"><span class="ladda-label"><i class="fa fa-save"></i>  {{__('ERP::attributes.main.update_btn')}}</span><span class="ladda-spinner"></span></button>
        </div>
                             {!! Form::close() !!}

<script type="text/javascript">
  $('.with-select2').select2();
</script>