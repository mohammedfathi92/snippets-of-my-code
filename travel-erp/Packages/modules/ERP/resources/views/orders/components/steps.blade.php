@php
$last_segm = collect(request()->segments())->last();



@endphp
<div class="box box-success">
            <div class="box-header">
              <div class="row">
  <div class="col-md-12">
        <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-md-2 col-xs-4"> 

                <a href="{{url('/erp/orders/'.$order->hashed_id.'/edit')}}" type="button" class="btn btn-{{($last_segm == 'edit' || $last_segm == 'show')?'success':'default'}} btn-circle" @if(!$order->exists) disabled="true" @endif>1</a>
                <p><strong>{{__('ERP::attributes.order.tabs.details')}}</strong></p>
            </div>

                        <div class="stepwizard-step col-md-2 col-xs-4"> 

                <a href="{{url('/erp/orders/'.$order->hashed_id.'/payments')}}" type="button" class="btn btn-{{$last_segm == 'payments'?'success':'default'}} btn-circle" @if(!$order->exists) disabled="true" @endif>3</a>
                <p><strong>{{__('ERP::attributes.order.tabs.payment')}}</strong></p>
            </div>
                        <div class="stepwizard-step col-md-2 col-xs-4"> 

                <a href="{{url('/erp/orders/'.$order->hashed_id.'/edit_voucher')}}" type="button" class="btn btn-{{$last_segm == 'edit_voucher'?'success':'default'}} btn-circle" @if(!$order->exists) disabled="true" @endif>4</a>
                <p><strong>{{__('ERP::attributes.order.tabs.voucher')}}</strong></p>
            </div>

                    <div class="stepwizard-step col-md-2 col-xs-4"> 

                <a href="{{url('/erp/orders/'.$order->hashed_id.'/guests')}}" type="button" class="btn btn-{{$last_segm == 'guests'?'success':'default'}} btn-circle" @if(!$order->exists) disabled="true" @endif>2</a>
                <p><strong>{{__('ERP::attributes.order.tabs.guests')}}</strong></p>
            </div>
                        <div class="stepwizard-step col-md-3 col-xs-4"> 

                <a href="{{url('/erp/orders/'.$order->hashed_id.'/supervisors')}}" type="button" class="btn btn-{{$last_segm == 'supervisors'?'success':'default'}} btn-circle" @if(!$order->exists) disabled="true" @endif>5</a>
                <p><strong>{{__('ERP::attributes.order.tabs.supervisors')}}</strong></p>
            </div>
{{--                         <div class="stepwizard-step col-md-2 col-xs-4"> 

                <a href="{{url('/erp/orders/'.$order->hashed_id.'/settings')}}" type="button" class="btn btn-{{$last_segm == 'settings'?'success':'default'}} btn-circle" @if(!$order->exists) disabled="true" @endif>6</a>
                <p><strong>{{__('ERP::attributes.order.tabs.settings')}}</strong></p>
            </div> --}}

          
        </div>
    </div>
  </div>
</div>
 </div>
 </div>

 @push('add_css')
 <style>
    .top_space{
        margin-top: 25px;
    }
    table td .form-group{
        min-width: 150px;
    }
</style>
<style type="text/css">
  .stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
</style>
 @endpush
