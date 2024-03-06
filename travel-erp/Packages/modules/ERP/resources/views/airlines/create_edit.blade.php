@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('airline_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($airline, ['url' => url($resource_url.'/'.$airline->hashed_id),'method'=>$airline->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- airline airline fields here-->

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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $airline->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $airline->getTranslation('description', $code)) !!}
                        {!! PackagesForm::text('notes['.$code.']','ERP::attributes.main.note',false, $airline->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}
                    <input type="hidden" name="transport_type" value="airline">

                                         <div class="row">

                         <div class="col-md-4">
                            {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',true) !!}
                             
                         </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::text('primary_phone', 'ERP::attributes.main.primary_phone', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('phone_one', 'ERP::attributes.main.phone_one', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                         
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('phone_two', 'ERP::attributes.main.phone_two', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                            
                        </div>
                    
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::text('fax_number', 'ERP::attributes.main.fax', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                        </div>


                         <div class="col-md-4">
                            {!! PackagesForm::email('email', 'ERP::attributes.main.email', false) !!}
                         </div>

                

                    <div class="col-md-4">
                          {!! PackagesForm::text('website_link', 'ERP::attributes.users.website_link' ) !!}
                           
                            
                        </div> 
                       
                    
                     </div>
                     <div class="row">
                       <div class="col-md-4">
                          {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $airline->exists?$airline->status:1) !!}
                          </div>
                     </div>

                    </div>
                     
                </div>

                {!! PackagesForm::customFields($airline) !!}

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