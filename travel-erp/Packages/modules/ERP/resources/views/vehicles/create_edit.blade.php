@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('vehicle_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($vehicle, ['url' => url($resource_url.'/'.$vehicle->hashed_id),'method'=>$vehicle->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- vehicle vehicle fields here-->

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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $vehicle->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $vehicle->getTranslation('description', $code)) !!}
                        {!! PackagesForm::text('notes['.$code.']','ERP::attributes.main.note',false, $vehicle->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                     <div class="row">

                          <div class="col-md-4" >
                              {!! PackagesForm::select('category_id','ERP::attributes.main.vehicle_type', \ERP::getCategoriesByType('vehicles'),true,null,[], 'select2') !!}
                         </div>

                         <div class="col-md-4" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists', 'data-other_select_id' => 'row_driver_id', 'data-item_type' => 'countries', 'data-list_type' => 'drivers'],
                               'select2') !!}
                        </div>

                        <div class="col-md-4">
                            {!! PackagesForm::select('driver_id','ERP::attributes.main.driver', \ERP::getDriversListByCountry($vehicle->country_id),true,null, ['id' => 'row_driver_id'], 'select2') !!}
                            
                        </div>
                

                     </div>

                      <div class="row">

                          <div class="col-md-4" >
                             {!! PackagesForm::text('vehicle_number','ERP::attributes.vehicles.vehicle_number') !!}
                         </div>

                  <div class="col-md-4" >
                             {!! PackagesForm::text('vehicle_model','ERP::attributes.vehicles.vehicle_model',false,null,['placeholder' => __('ERP::attributes.vehicles.vehicle_type_model_ex')]) !!}
                         </div>

                         @php

                         $years = [];

                         for ($i=1970; $i <= 2040; $i++) { 
                             $years[$i] = $i;     
                         }

                         @endphp

                          <div class="col-md-4">
                            {!! PackagesForm::select('model_year','ERP::attributes.vehicles.model_year', $years ,false,null,[],
                               'select2') !!}
                         </div>

                     </div>

                 <div class="col-md-12">

                       {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $vehicle->exists?$vehicle->status:1) !!}
                      
                    </div>

                
                    </div>
                     
                </div>

                {!! PackagesForm::customFields($vehicle) !!}

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