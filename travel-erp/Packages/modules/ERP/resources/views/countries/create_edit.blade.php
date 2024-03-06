@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('country_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($country, ['url' => url($resource_url.'/'.$country->hashed_id),'method'=>$country->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">

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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $country->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $country->getTranslation('description', $code)) !!}
                         
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}
                    <!-- place country fields here-->
                    <div class="row">
                      <div class="col-md-4">
                          {!! PackagesForm::text('code','ERP::attributes.main.code',false) !!}
                        
                      </div>
                      
                      <div class="col-md-4">
                         {!! PackagesForm::select('currency_id','ERP::attributes.flight.currency_id', \ERP::getCurrenciesList(), false, null, [], 'select2') !!} 
                        
                      </div>
                    </div>

            



                     {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'),$country->exists?$country->status:1) !!}
                    </div>
                     
                </div>

                {!! PackagesForm::customFields($country) !!}

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