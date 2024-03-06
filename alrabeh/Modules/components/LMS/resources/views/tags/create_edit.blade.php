@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_tag_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @component('components.box')
                {!! Form::model($tag, ['url' => url($resource_url.'/'.$tag->hashed_id),'method'=>$tag->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}

                {!! ModulesForm::text('name','LMS::attributes.main.name',true) !!}
                {!! ModulesForm::text('slug','LMS::attributes.main.slug',true) !!}
                {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                {!! ModulesForm::customFields($tag, 'col-md-12') !!}
                {!! ModulesForm::formButtons() !!}

                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection