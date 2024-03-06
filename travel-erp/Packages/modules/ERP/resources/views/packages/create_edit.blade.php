@extends('layouts.crud.create_edit')

@section('css')
<style>
    .top_space{
        margin-top: 25px;
    }
    table td .form-group{
        min-width: 150px;
    }
</style>
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('package_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.order.package_data')])
                {!! Form::model($order, ['url' => url($resource_url.'/'.$order->hashed_id),'method'=>$order->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- provider provider fields here-->

                    <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::text('order_code','ERP::attributes.order.package_code',true,null) !!}
                        </div>
                        <div class="col-md-4">
                            {!! PackagesForm::select('agent_id','ERP::attributes.order.agent',\ERP::getAgentsList(),true,null) !!}
                            
                        </div>

                         <div class="col-md-4">
                            <input type="hidden" name="package_type" value="package">
                            
                            {!! PackagesForm::number('adult_numbers','ERP::attributes.order.adult_numbers',false) !!}
                            
                        </div>
                        
                    </div>


                    <div class="row">
                                               
                         
                         <div class="col-md-4">
                           {!! PackagesForm::number('chlid_numbers','ERP::attributes.order.chlid_numbers',false) !!}
                         </div>
                         <div class="col-md-4 ">
                           {!! PackagesForm::number('infant_numbers','ERP::attributes.order.infant_numbers',false) !!}
                         </div>
                         <div class="col-md-4">
                           {!! PackagesForm::text('notes','ERP::attributes.main.note',false) !!}
                         </div>
                      </div>


                    
{{--  
                   </div>
                     
                </div> --}}
            @endcomponent
            @component('components.box' ,['box_title'=>trans('ERP::attributes.order.package_detail')])
            <div class="row form-group">
             <div class="col-md-10 col-md-offset-1">
              {{-- orders  row --}}
                    <div class="row"> 

                     <div class="nav-tabs-custom" id="tabs">
                        <ul class="nav nav-tabs">
                               
                             <li class="active">
                                <a data-target="#hotel_orders" data-toggle="tab"href>{{trans('ERP::attributes.order.hotel_packages')}}
                                </a>
                            </li>  
                            <li class="">
                                <a data-target="#flight_orders" data-toggle="tab"href>{{trans('ERP::attributes.order.flight_packages')}}
                                </a>
                            </li>
                            <li class="">
                                <a data-target="#transport_orders" data-toggle="tab"href>{{trans('ERP::attributes.order.transport_packages')}}
                                </a>
                            </li>       
                               
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;">

                       {{-- hotel orders --}}
                        <div class="active tab-pane" id="hotel_orders">
                            
                            @include('ERP::packages.partials.hotels') 

                        </div> {{-- hotel orders --}}

                        {{-- flight orders --}}
                        <div class="tab-pane" id="flight_orders">
                                 
                            @include('ERP::packages.partials.flights') 

                        </div> {{-- flight orders --}}

                        {{-- transport orders --}}
                        <div class="tab-pane" id="transport_orders">
                                 
                            @include('ERP::packages.partials.transports') 
                            
                        </div> {{-- transport orders --}}
     

                      </div>
                    </div>
                    </div> {{-- end orders  row --}}

             </div>
            </div>

                {!! PackagesForm::customFields($order) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
            

        </div>
    </div>

@endsection

@section('js')
@endsection