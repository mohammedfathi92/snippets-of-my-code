@extends('layouts.crud.create_edit')

@php

$branches = \ERP::getBranchesList();
$agents = \ERP::getAgentsList();
$providers = \ERP::getProvidersList();
$countries = \ERP::getCountriesData();
$currencies = \ERP::getCurrenciesData();
$vehiclesTypes = \ERP::getCategoriesByType('vehicles');
$drivers =  \ERP::getDriversList();
$airlines =  \ERP::getAirlinesList();
$buses =  \ERP::getBusesList();
$ferries =  \ERP::getFerriesList();
$roomsTypes = \ERP::getCategoriesByType('rooms')


@endphp

@section('css')
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
@endsection

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

@section('content')



    <div class="row">
        <div class="col-md-12">

          @include('ERP::orders.components.steps', ['order' => $order, 'current_step' => 1])

          {!! Form::model($order, ['url' => url($resource_url.'/'.$order->hashed_id),'method'=>$order->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}


            @component('components.box',['box_title'=>trans('ERP::attributes.order.customer_data')])
              @include('ERP::orders.sections.details')
            @endcomponent
            @component('components.box' ,['box_title'=>trans('ERP::attributes.order.orders')])
            <div class="row">
             <div class="col-md-12 ">
              {{-- orders  row --}}
                    <div class="row"> 

                     <div class="nav-tabs-custom" id="tabs">
                        <ul class="nav nav-tabs">
                               
                             <li class="active">
                                <a data-target="#hotels_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.main.hotels')}}
                                </a>
                            </li>  
                            <li class="">
                                <a data-target="#flights_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.order.flights_orders')}}
                                </a>
                            </li>

                             <li class="">
                                <a data-target="#ferries_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.order.ferries_orders')}}
                                </a>
                            </li>
                            <li class="">
                                <a data-target="#buses_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.order.buses_orders')}}
                                </a>
                            </li>
                            <li class="">
                                <a data-target="#transport_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.main.transports')}}
                                </a>
                            </li>
                            <li class="">
                                <a data-target="#activities_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.main.activities')}}
                                </a>
                            </li>

                           <li class="">
                                <a data-target="#services_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.main.services')}}
                                </a>
                            </li>
                            
                            <li class="">
                                <a data-target="#manual_hotel_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.order.manual_hotel_orders')}}
                                </a>
                            </li> 

                             <li class="">
                                <a data-target="#manual_services_orders_tab" data-toggle="tab"href>{{trans('ERP::attributes.order.manual_services_orders')}}
                                </a>
                            </li>       
                                
                        </ul>
     <div class="tab-content">
    @php
    $orderHotelsList = $order->hotelsOrders()->get();
    $orderFlightsList = $order->flightsOrders()->get();
    $orderActivitiesList = $order->activitiesOrders()->get();
    $orderBusesList = $order->busesOrders()->get();
    $orderFerriesList = $order->ferriesOrders()->get();
    $orderTransportsList = $order->transportsOrders()->get();
    $orderServicesList = $order->servicesOrders()->get();


    @endphp

                       {{-- hotel orders --}}
      <div class="active tab-pane" id="hotels_orders_tab">
        @if($orderHotelsList->count())
    
        @include('ERP::orders.updates.hotels')

        @else
           @include('ERP::orders.partials.hotels')
         @endif  


     
                        </div> {{-- hotel orders --}}

                        {{-- flight orders --}}
                        <div class="tab-pane" id="flights_orders_tab">

                                  @if($orderFlightsList->count())
        @include('ERP::orders.updates.flights')
        @else
           @include('ERP::orders.partials.flights')
         @endif 

                                 
                           
                            

                        </div> {{-- flight orders --}}

                         {{-- ferry orders --}}
                        <div class="tab-pane" id="ferries_orders_tab">
                                 

                                  @if($orderFerriesList->count())
        @include('ERP::orders.updates.ferries')
        @else
           @include('ERP::orders.partials.ferries')
         @endif 
                            

                        </div> {{-- ferry orders --}}

                         {{-- buses orders --}}
                        <div class="tab-pane" id="buses_orders_tab">
                                 
                          @if($orderBusesList->count())
        @include('ERP::orders.updates.buses')
        @else
           @include('ERP::orders.partials.buses')
         @endif 
                            

                        </div> {{-- busess orders --}}

                        {{-- transport orders --}}
                        <div class="tab-pane" id="transport_orders_tab">
                                 

                           @if($order->transportsOrders()->count())
        @include('ERP::orders.updates.transports')
        @else
           @include('ERP::orders.partials.transports')
         @endif 
                            
                        </div> {{-- transport orders --}}

                      <div class="tab-pane" id="activities_orders_tab">
                                 

                      @if($orderActivitiesList->count())
        @include('ERP::orders.updates.activities')
        @else
           @include('ERP::orders.partials.activities')
         @endif 
                            
                        </div> {{-- activities orders --}}

                       <div class="tab-pane" id="services_orders_tab">
                                 

                                            @if($order->servicesOrders()->count())
        @include('ERP::orders.updates.services')
        @else
           @include('ERP::orders.partials.services')
         @endif 
                            
                        </div> {{-- services orders --}}

                        {{-- manual hotel orders --}}
                        <div class="tab-pane" id="manual_hotel_orders_tab">
                                 
                            @include('ERP::orders.partials.manual_hotels') 
                            
                        </div> {{-- manual hotel orders --}}

                        <div class="tab-pane" id="manual_services_orders_tab">
                                 
                            @include('ERP::orders.partials.manual_services') 
                            
                        </div> {{-- manual hotel orders --}}

                        


                      

                      </div>
                    </div>
                    </div> {{-- end orders  row --}}

             </div>
            </div>

             @endcomponent

                {!! PackagesForm::customFields($order) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
               

            

        </div>
    </div>
     {!! Form::close() !!}



                            <!-- Modal -->
                            <div class="modal fade" id="add_customer_modal" tabindex="-1" role="dialog" aria-labelledby="customer_title" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="customer_title">
                                        {{trans('ERP::attributes.order.add_customer')}}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">    
                                      <div class="alert print-error-msg  alert-danger" style="display: none;" role="alert" >
                                        <strong>Errors:</strong>
                                        <ul>
                                          <li></li>
                                        </ul>
                                      </div>
                                      @php
                                    $customer =  new \Packages\Modules\ERP\Models\UserErp();
                                      @endphp
                                    @include('ERP::orders.partials.add_customer', ['customer' => $customer])
                                  </div>
                        {{--           <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">X</button>
                                        
                                    <button type="button" id="btn_customer" class="btn btn-success">{{trans('ERP::attributes.order.add_customer')}}</button>
                                    
                                  </div> --}}
                                </div>
                              </div>
                            </div> <!-- end modal -->

@endsection

@section('js')
@include('ERP::partials.scripts.general_scripts')
@include('ERP::partials.scripts.get_category_places')
@include('ERP::orders.scripts.main')
<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click', '#open_new_customer_modal', function () {

      var modal = $('#add_customer_modal');

      modal.modal('show');


      });
    });
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('submit', '.ajax-form-order-user', function (event) {
    event.preventDefault();

    $('.has-error .help-block').html('');

    $('.form-group').removeClass('has-error');

    $('.nav.nav-tabs li a').removeClass('c-red');

    $form = $(this);

    ajax_form_user_order($form);

});

   
    });

  function ajax_form_user_order($form) {
    var page_action = $form.data('page_action');
    var actionData = $form.data('action_data');
    var table = $form.data('table');

    console.log($form.get(0));

    var formData = new FormData($form.get(0));

    console.log(formData);

    var button = $('button[name]:focus', $form);

    if (button.length) {
        formData.append(button.attr('name'), button.attr('value'));
    }

    var url = $form.attr('action');

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response, textStatus, jqXHR) {
            handleAjaxSubmitSuccess(response, textStatus, jqXHR, page_action, actionData, table, $form);
      $("#customer_id").append("<option value='"+response.data['id']+"' selected>"+response.data['name']+" - "+response.data['code']+"</option>");

      $('#ajax-form-order-user')[0].reset();
      
     $('#add_customer_modal').modal('hide');
        },
        error: function (response, textStatus, jqXHR) {
            handleAjaxSubmitError(response, textStatus, jqXHR, $form)
        }
    });
}


</script>

@endsection

