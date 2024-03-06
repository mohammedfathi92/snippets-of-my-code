@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('ordertype_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($ordertype, ['url' => url($resource_url.'/'.$ordertype->hashed_id),'method'=>$ordertype->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- ordertype ordertype fields here-->

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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $ordertype->getTranslation('name', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                    

                    </div>
                     
                </div>

                {!! PackagesForm::customFields($ordertype) !!}

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