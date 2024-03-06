@extends('layouts.crud.create_edit')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('order_create_edit') }}
        @endslot
    @endcomponent
@endsection

@php

$hotels = $order->hotelsOrders()->get();
$flights = $order->flightsOrders()->get();
$transports = $order->transportsOrders()->get();
$services = $order->servicesOrders()->get();
$activities = $order->activitiesOrders()->get();
$ferries = $order->ferriesOrders()->get();
$buses = $order->busesOrders()->get();

$ferries_buses = collect($ferries->toArray())->merge($buses->toArray());

$arr_ferries_buses = $ferries_buses->sortBy('order_day')->sortBy('leave_time')->values()->all();

@endphp

@php
$main_currency = getMainCurrency();
$hotels_costs = [];
$flights_costs = [];
$transports_costs = [];
$ferries_buses_costs = [];
$activities_costs = [];
$services_costs = [];
@endphp

@php 
$page_locale_code = 'en';
$customerNationality = '';
if($customer = $order->customer){
  $customerNationality = $customer->nationality?$customer->nationality->getTranslation('name', $page_locale_code):'';
}
$order_currency_name = $order->currency?$order->currency->name:'';

$voucherOptions = json_decode($voucher->settings, true);

if(!is_array($voucherOptions)){
$voucherOptions = [];
}
@endphp
{{-- {{dd(1)}} --}}
@section('content')
    <div class="row">
        <div class="col-md-12">

          @include('ERP::orders.components.steps', ['order' => $order, 'current_step' => 3])
        </div>
      </div>

          {!! Form::model($voucher, ['url' => url($resource_url.'/'.$order->hashed_id.'/update_voucher'),'method'=>'POST','files'=>true,'class'=>'ajax-form']) !!}
              <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.vouchers.voucher')])

              <div class="row form-group">
                <div class="col-md-10 col-md-offset-1">
                    <!-- vouchers fields here-->
     <div class="voucher-tools"> 
      <div class="row">
        {{-- {{dd($voucherOptions)}} --}}
        @if($show_as == 'web')
                          <div class="col-md-3" >
                            {!! PackagesForm::checkbox('settings[show_logo]','ERP::attributes.vouchers.show_logo',(!$voucher->exists || (isset($voucherOptions['show_logo']) && $voucherOptions['show_logo'] > 0))?true:false,1,['class'=>'show_voucher_elements', 'data-target'=>".show_logo"]) !!}
                         </div>

                         <div class="col-md-3" >
                            {!! PackagesForm::checkbox('settings[show_contacts]','ERP::attributes.vouchers.show_contacts',(!$voucher->exists || (isset($voucherOptions['show_contacts']) && $voucherOptions['show_contacts'] > 0))?true:false,1,['class'=>'show_voucher_elements', 'data-target'=>".show_contacts"]) !!}
                         </div>

                        <div class="col-md-3" >
                            {!! PackagesForm::checkbox('settings[show_header]','ERP::attributes.vouchers.show_header',(!$voucher->exists || (isset($voucherOptions['show_header']) && $voucherOptions['show_header'] > 0))?true:false,1,['class'=>'show_voucher_elements', 'data-target'=>".show_header"]) !!}
                         </div>

                          <div class="col-md-3" >
                            <a class="btn btn-default" href="{{url('erp/orders/'.$order->hashed_id.'/edit_voucher?show_as=text')}}">{{__('ERP::attributes.vouchers.show_as_text_btn')}}</a>
                         </div>


                   @endif
                   @if($show_as == 'text')

                            <div class="col-md-3" >
                            <a class="btn btn-default" href="{{url('erp/orders/'.$order->hashed_id.'/edit_voucher?show_as=web')}}">{{__('ERP::attributes.vouchers.show_as_web_btn')}}</a>
                         </div>

                   @endif 

                          <div class="col-md-3" >
                            <a class="btn btn-default" href="{{url('erp/orders/'.$order->hashed_id.'/edit_voucher?show_as='.$show_as.'&show_original=true')}}">{{__('ERP::attributes.vouchers.show_original_btn')}}</a>
                         </div>     
      


                   



      </div>

     </div>



              </div>      



</div>
        
            @endcomponent

        
            </div>
  </div>

                       @if(count(\Settings::get('supported_languages', [])) > 0)   

                     <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                                @foreach (\Language::allowed() as $page_locale_code => $name) 
                                  <li class="{{ $page_locale_code=='ar'?'active':'' }}"><a data-target="#lang_{{ $page_locale_code }}" data-toggle="tab"  href>{{ $name }}</a></li>
                                @endforeach 
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;"  id="full-tab-content">

                     @foreach (\Language::allowed() as $page_locale_code => $name) 

                     
                    <div class="{{ $page_locale_code=='ar'?'active':'' }} tab-pane" id="lang_{{ $page_locale_code }}" >

                  @if($show_as == 'web')

                  <input type="hidden" name="show_as" value="web">

                         
                  <div>
                     <textarea name="web_html_content[{{$page_locale_code}}]" contenteditable="true" id="textarea-content-{{$loop->index}}" class="ckeditor-inline">

                      @if(!empty($voucher->web_html_content) && $show_original == 'false')

                      {!! $voucher->getTranslation('web_html_content', $page_locale_code)!!}

                      @else

                     @include('ERP::orders.sections.vouchers.partials.web_create_edit')

                      @endif

                    </textarea>
                  </div> {{-- end web container --}}
                  @else
                   <input type="hidden" name="show_as" value="text">

                  <div>
                     <textarea name="text_html_content[{{$page_locale_code}}]" contenteditable="true" id="textarea-content-{{$loop->index}}" class="ckeditor-inline">

                      @if(!empty($voucher->text_html_content) && $show_original == 'false')

                      {!! $voucher->getTranslation('text_html_content', $page_locale_code)!!}

                      @else

                     @include('ERP::orders.sections.vouchers.partials.text_create_edit')

                      @endif

                    </textarea>
                  </div> {{-- end web container --}}

                  @endif
                         </div> {{-- end local tab content --}}

                       
                      
                      @endforeach

                      </div> 
                    </div> {{-- end all tabs --}}
                    @endif

                        <div class="clearfix"></div>
                    <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
         {!! Form::close() !!}

    @endsection

@section('css')
<style type="text/css">
  .table-orders th {
   text-align: center;   
}
  .table-content-center {
   text-align: center;   
}

.text-align-en th{
  text-align: left;
}

.text-align-ar th{
  text-align: right;
}

</style>
@endsection
@section('js')
<script type="text/javascript">

   CKEDITOR.disableAutoInline = false;
   $(".ckeditor-inline").each(function () {
         CKEDITOR.inline( $(this).attr("id") );
});

              $(function() {
            $('body').on('change', '.show_voucher_elements', function() {
              
              var target = $(this).data('target');
              if ($(this).is(':checked')) {
                $(target).show();
              }else{
                $(target).hide();
              }



                        });
        });


   

</script>
@endsection