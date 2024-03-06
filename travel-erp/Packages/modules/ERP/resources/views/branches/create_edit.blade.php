@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('branch_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($branch, ['url' => url($resource_url.'/'.$branch->hashed_id),'method'=>$branch->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- branch branch fields here-->
                     
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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $branch->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $branch->getTranslation('description', $code)) !!}
                        {!! PackagesForm::textarea('notes['.$code.']','ERP::attributes.main.note',false, $branch->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                <div class="row">
                            <div class="col-md-4" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists', 'data-other_select_id' => 'row_city_id', 'data-item_type' => 'countries', 'data-list_type' => 'cities'],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                            <div id="cities_list_div">
                            {!! PackagesForm::select('city_id','ERP::attributes.hotel.city', \ERP::getCitiesListByCountry($branch->country_id),true,null, ['id' => 'row_city_id'], 'select2') !!}
                            </div>
                         </div>
                          <div class="col-md-4">
                         {!! PackagesForm::text('address', 'ERP::attributes.main.address' , true, null) !!}
                       </div>
                     </div>

                <div class="row">
                        <div class="col-md-4">

                          {!! PackagesForm::text('primary_phone', 'ERP::attributes.main.primary_phone' , false, null, ['pattern'=>"^[0-9-+s()]*$"]) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('phone_one', 'ERP::attributes.main.phone_one' , false, null, ['pattern'=>"^[0-9-+s()]*$"]) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('phone_two', 'ERP::attributes.main.phone_two', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                           
                            
                        </div>
                    
                   </div> 

                 <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::text('fax_number', 'ERP::attributes.main.fax' , false, null, ['pattern'=>"^[0-9-+s()]*$"]) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::email('email', 'ERP::attributes.main.email' ) !!}
                           
                            
                        </div>

                       <div class="col-md-4">

                       {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'),$branch->exists?$branch->status:1) !!}
                      
                    </div>
                  
                    
                </div>     


                    </div>
                     
                </div>

                {!! PackagesForm::customFields($branch) !!}

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