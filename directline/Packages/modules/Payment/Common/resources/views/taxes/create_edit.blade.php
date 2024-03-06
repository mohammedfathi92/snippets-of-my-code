@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('tax_create_edit',$tax_class) }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($tax, ['url' => trim(url($resource_url.'/'.$tax->hashed_id),'/'),'method'=>$tax->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-3">
                        {!! PackagesForm::text('name','Payment::attributes.tax.name',true) !!}
                    </div>
                    <div class="col-md-3">
                        {!! PackagesForm::radio('status','Packages::attributes.status',true, trans('Packages::attributes.status_options')) !!}
                    </div>
                    <div class="col-md-3">
                        {!! PackagesForm::number('priority','Payment::attributes.tax.priority',true,null,['step'=>1,'min'=>0,'max'=>999999]) !!}
                    </div>
                    <div class="col-md-3">
                        {!! PackagesForm::number('rate','Payment::attributes.tax.rate',true,null,['right_addon'=>'<i class="fa fa-percent"></i>']) !!}
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! PackagesForm::select('country', 'Payment::attributes.tax.country', \Settings::getCountriesList()) !!}
                    </div>
                    <div class="col-md-3">
                        {!! PackagesForm::text('state', 'Payment::attributes.tax.state') !!}
                    </div>
                    <div class="col-md-3">
                        {!! PackagesForm::text('zip', 'Payment::attributes.tax.zip',false) !!}
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! PackagesForm::checkbox('compound', 'Payment::attributes.tax.compound',$tax->compound) !!}
                    </div>

                </div>
                {!! PackagesForm::customFields($tax) !!}
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection