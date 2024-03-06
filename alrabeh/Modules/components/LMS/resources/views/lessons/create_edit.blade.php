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
            {{ Breadcrumbs::render('lms_lesson_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! Form::model($lesson, ['url' => url($resource_url.'/'.$lesson->hashed_id),'method'=>$lesson->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
            <div class="row">
                <div class="col-md-8">
                    @component('components.box', ['box_title' => __('LMS::attributes.main.general_head')])
                        {!! ModulesForm::text('title','LMS::attributes.main.name',true) !!}
                        {{-- {!! ModulesForm::text('slug','LMS::attributes.main.slug',true) !!} --}}
                        {!! ModulesForm::textarea('content',trans('LMS::attributes.main.content'),true,null,['class'=>'ckeditor']) !!}
                     
                    @endcomponent

                    @component('components.box', ['box_title' => __('LMS::attributes.main.settings_head')])
                         <div style="display: flex;">
                                @php 
                                $lesson_type = [
                                    'standard' => __('LMS::attributes.lessons.standard'),
                                    'video' => __('LMS::attributes.lessons.video'),
                                    'quiz' => __('LMS::attributes.lessons.quiz'),
                                    'audio' => __('LMS::attributes.lessons.audio'),
                                    'docs' => __('LMS::attributes.lessons.docs'),
                                ]

                                
                                @endphp
                            {!! ModulesForm::select('type','LMS::attributes.lessons.lesson_type', $lesson_type,false,$lesson->exists?$lesson->type: 'standard') !!}
                        
                            </div>
                        <div class=" display-flex">
                            <div >
                                {!! ModulesForm::number('duration','LMS::attributes.lessons.lesson_duration',false,$lesson->exists?$lesson->duration: 0.00,['min'=>0])!!}   
                            </div> 
                            <div >
                                    @php 
                                    $duration_unit = [
                                        'minute' => __('LMS::attributes.main.minute'),
                                        'hour' => __('LMS::attributes.main.hour'),
                                        'day' => __('LMS::attributes.main.day'),
                                        'week' => __('LMS::attributes.main.week'),
                                    ]

                                    
                                    @endphp
                                {!! ModulesForm::select('duration_unit',' ', $duration_unit,false,$lesson->exists?$lesson->duration_unit:'minute') !!}
                            </div> 
                        </div>  
                        <br>
                      {{--   {!! ModulesForm::checkbox('private','LMS::attributes.lessons.lesson_private',false) !!} --}}

                        {!! ModulesForm::checkbox('preview','LMS::attributes.lessons.lesson_preview',$lesson->preview >= 1?true:false,true) !!}

                        {{-- {!! ModulesForm::checkbox('allow_comments','LMS::attributes.main.allow_comments',$lesson->allow_comments >= 1?true:false,true ) !!} --}}
                             
                    @endcomponent


                     
                </div>
                <div class="col-md-4">
                    @component('components.box')
                    {!! ModulesForm::text('preview_video','LMS::attributes.main.preview_video',false) !!}
                    <small> {{__('LMS::attributes.main.preview_video_hint')}} </small>
                    @endcomponent
                    @component('components.box')
                        @if($lesson->hasMedia($lesson->mediaCollectionName))
                            <img src="{{ $lesson->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Thumbnail"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear', 'LMS::attributes.main.clear') !!}
                        @endif
                        {!! ModulesForm::file('thumbnail', 'LMS::attributes.main.featured_image') !!}

                        {!! ModulesForm::select('categories[]','LMS::attributes.main.categories', \LMS::getCategoriesList(),false,null,['multiple'=>true], 'select2') !!}
                       {!! ModulesForm::select('tags[]','LMS::attributes.main.tags', \LMS::getTagsList(),false,null,['class'=>'tags','multiple'=>true], 'select2') !!}
                        {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                    @endcomponent

                    
 

                    <div class="clearfix"></div>

                </div>
            </div>
        

            <div class="row">
                @component('components.box')

                    {!! ModulesForm::customFields($lesson) !!}

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