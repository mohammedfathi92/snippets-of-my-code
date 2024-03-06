@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('serviceprice_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.main.general_info')])
                {!! Form::model($service_price, ['url' => url($resource_url.'/'.$service_price->hashed_id),'method'=>$service_price->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">

                          {{-- translation row --}}
                    <div class="row"> 
                         <div class="col-md-8" >
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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $service_price->getTranslation('name', $code)) !!}
                       
                        {!! PackagesForm::textArea('notes['.$code.']','ERP::attributes.main.note',false, $service_price->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                </div>
                    </div> {{-- end translation row --}}

                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::select('currency_id','ERP::attributes.main.currency', \ERP::getCurrenciesList(),true,null,[],'select2') !!}
                             </div>
                             <div class="col-md-4" >
                                 {!! PackagesForm::date('start_date','ERP::attributes.flight.start_date',true,null) !!}
                             </div>
                        </div>

                     <div class="row">

                         <div class="col-md-4" >
                            {!! PackagesForm::select('country_id','ERP::attributes.main.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists',
                             'data-list_type' => 'cities', 'data-other_select_id'=> 'row_services_city', 'data-closest_class' => 'row', 'data-item_type'=>'countries'],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                           
                            {!! PackagesForm::select('city_id','ERP::attributes.main.city', \ERP::getCitiesListByCountry($service_price->country_id),true,null, ['class' => 'cities_list_1 get_geo_lists', 'data-list_type' => 'services', 'data-other_select_id'=> 'row_services_service', 'data-closest_class' => 'row', 'data-item_type'=>'cities', 'id'=>'row_services_city'], 'select2') !!}
                          
                         </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::select('service_id','ERP::attributes.order.service', \ERP::getServicesList($service_price->city_id),true,null, ['class' => 'cities_list_1 geo_child', 'data-list_type' => 'services', 'id' => 'row_services_service'], 'select2') !!}
                         </div>
                        </div>



                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('price','ERP::attributes.order.price',true,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('cost','ERP::attributes.order.cost',true,null) !!}
                                 
                             </div>
                             
                        </div>




                            <div class="row">
    <div class="col-md-4">
        {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $service_price->exists?$service_price->status:1) !!}
        
    </div>
</div>
                    
                    </div>
                     
                </div>
                     
                   

                {!! PackagesForm::customFields($service_price) !!}

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
@include('ERP::partials.scripts.general_scripts')
@endsection