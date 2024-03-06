

@php
$main_currency = getMainCurrency();
@endphp



        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{__('ERP::attributes.financials.title_update_financial',['no' => $payment->reg_code])}}</h4>
        </div>
        <div class="modal-body">


              <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <a href="{{ \Settings::get('public_site_url')}}" title="logo {{\Settings::get('public_site_name_'.\Language::getCode())}}">
            <img src="{{ \Settings::get('site_logo') }}" class="" style="max-height: 50px;"></a>
             <span class="pull-right"> <small>{{__('ERP::attributes.main.record_code')}}:&nbsp;{{$payment->reg_code}}</small><br>@if($payment->refrence_code)<small>{{__('ERP::attributes.financials.refrence_code')}}:&nbsp;{{$payment->refrence_code}}</small>@endif</span>
           
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          {{__('ERP::attributes.financials.from')}}
          <address>
            <strong>{{\Settings::get('public_site_name_'.\Language::getCode())}}</strong><br>
{{--             795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br> --}}
            {{__('ERP::attributes.financials.phone')}}: {{\Settings::get('whatsapp_no')}}<br>
            {{__('ERP::attributes.financials.email')}}: {{\Settings::get('public_site_email')}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          {{__('ERP::attributes.financials.to')}}
          <address>
            <strong>{{$order->customer?$order->customer->translated_name:''}}</strong><br>
{{--             795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br> --}}
            {{__('ERP::attributes.financials.phone')}}: {{$order->customer?$order->customer->primary_phone:''}}<br>
            {{__('ERP::attributes.financials.email')}}: @if($order->customer){{$order->customer->has_email?$order->customer->email:'@@@@@@@'}} @endif
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">

          <b>{{__('ERP::attributes.financials.order_id')}}:</b> {{$order->reg_code}}<br>
          <b>{{__('ERP::attributes.financials.payment_due')}}:</b> {{$payment->payment_date}}<br>
          <b>{{__('ERP::attributes.financials.payment_method')}}:</b> {{$payment->pay_method?$payment->pay_method->name:'#####'}}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>{{__('ERP::attributes.financials.description')}}</th>
              <th>{{__('ERP::attributes.financials.amount')}}</th>

            </tr>
            </thead>
            <tbody>
            <tr>
              <td><span>{{$payment->description}}<span></td>
              <td>{{(float)$payment->final_value}}&nbsp;{{$payment->currency?$payment->currency->name:''}}</td>

            </tr>

            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">{{__('ERP::attributes.financials.sub_total')}}:</th>
                <td>{{(float)$payment->final_value}}&nbsp;{{$payment->currency?$payment->currency->name:''}}</td>
              </tr>
              <tr>
                <th>{{__('ERP::attributes.financials.tax', ['tax_value' => $payment->fees_percent.'%'])}}:</th>
                <td>{{(float)$payment->final_value*((float)$payment->fees_percent/100)}}&nbsp;{{$payment->currency?$payment->currency->name:''}}</td>
              </tr>
              <tr>
                <th>{{__('ERP::attributes.financials.total')}}:</th>
                <td>{{(float)$payment->final_value - ((float)$payment->final_value*((float)$payment->fees_percent/100))}}&nbsp;{{$payment->currency?$payment->currency->name:''}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
   

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{__('ERP::attributes.main.close')}}</button> {{-- <a href="#" class="btn btn-info ladda-button" data-style="expand-right"><span class="ladda-label"><i class="fa fa-print"></i> print </span><span class="ladda-spinner"></span></a> --}}
        </div>



