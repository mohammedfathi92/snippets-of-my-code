@extends('layouts.crud.create_edit')

@section('css')
<style type="text/css">
    .display-flex{
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px
    }
     .display-flex div:first-child{
        margin: 0 2px;
     }

</style> 
@endsection
 
@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_testimonial_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! Form::model($testimonial, ['url' => url($resource_url.'/'.$testimonial->hashed_id),'method'=>$testimonial->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
            <div class="row">
                <div class="col-md-8">
                    @component('components.box', ['box_title' => __('LMS::attributes.main.general_head')])
                        {!! ModulesForm::text('title','LMS::attributes.main.title',true) !!}
                        {!! ModulesForm::text('user_name','LMS::attributes.main.user_name',true) !!}
                        {!! ModulesForm::textarea('content',trans('LMS::attributes.main.content'),true,null,['class'=>'ckeditor']) !!}
                     
                    @endcomponent

                   
                     
                </div>
                <div class="col-md-4">
               
                    @component('components.box')
                        @if($testimonial->hasMedia($testimonial->mediaCollectionName))
                            <img src="{{ $testimonial->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Thumbnail"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear', 'LMS::attributes.main.clear') !!}
                        @endif
                        {!! ModulesForm::file('thumbnail', 'LMS::attributes.main.featured_image') !!}
                        {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                    @endcomponent

                    
 

                    <div class="clearfix"></div>

                </div>
            </div>
        

            <div class="row">
                @component('components.box')

                    {!! ModulesForm::customFields($testimonial) !!}

                    <div class="row">
                        <div class="col-md-12">
                            {!! ModulesForm::formButtons() !!}
                        </div>
                    </div>
                @endcomponent
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection




@section('js')
@endsection