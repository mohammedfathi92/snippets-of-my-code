@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('region_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($region, ['url' => url($resource_url.'/'.$region->hashed_id),'method'=>$region->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- place region fields here-->

                     {!! PackagesForm::text('name','ERP::attributes.main.name',true) !!}
                     {!! PackagesForm::text('code','ERP::attributes.main.code',true) !!}
                     {!! PackagesForm::textarea('description',trans('ERP::attributes.main.description'),true) !!}
                     {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options')) !!}
                    </div>
                     
                </div>

                {!! PackagesForm::customFields($region) !!}

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