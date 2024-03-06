@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('source_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($source, ['url' => url($resource_url.'/'.$source->hashed_id),'method'=>$source->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- source source fields here-->

                     

                     <div class="row">
                         <div class="col-md-6">
                             {!! PackagesForm::text('name','ERP::attributes.main.name',true) !!}
                             
                         </div>
                         <div class="col-md-6" >
                            {!! PackagesForm::select('type','ERP::attributes.main.source_type',
                                ['To' => 'To', 'From' => 'From'],true,null) !!}
                         </div>
                     </div>
                     {!! PackagesForm::text('notes','ERP::attributes.main.note',false) !!}
                    </div>
                     
                </div>

                {!! PackagesForm::customFields($source) !!}

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