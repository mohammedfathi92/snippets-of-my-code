@extends('layouts.crud.create_edit')

@section('css')
    <style type="text/css">
        .display-flex {
            display: flex;
            align-items: flex-end;
            margin-bottom: 10px
        }

        .display-flex div:first-child {
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
            {{ Breadcrumbs::render('lms_question_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! Form::model($question, ['url' => url($resource_url.'/'.$question->hashed_id),'method'=>$question->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
            <div class="row">
                <div class="col-md-8">
                    @component('components.box', ['box_title' => __('LMS::attributes.questions.general_head')])

 {!! ModulesForm::text('title','LMS::attributes.main.title',true,$question->exists?$question->title:$question_title) !!}

                        {!! ModulesForm::textarea('content',trans('LMS::attributes.main.content'),true,null,['class'=>'ckeditor']) !!}
                    @endcomponent

                    @component('components.box', ['box_title' => __('LMS::attributes.main.answers_head')])
                        @include('LMS::questions.answers_v2', ['answers'=>$question->answers??[]])

                    @endcomponent

                    @component('components.box', ['box_title' => __('LMS::attributes.questions.settings_head')])
                        {!! ModulesForm::checkbox('show_question_title','LMS::attributes.questions.show_question_title',$question->show_question_title?:false) !!}
                        {{-- {!! ModulesForm::number('points','LMS::attributes.questions.points',true,$question->points?$question->points:1) !!} --}}
                        {!! ModulesForm::textarea('question_explanation','LMS::attributes.questions.explanation',false,null,['rows' => '4','class'=>'ckeditor']) !!}
                        {{-- {!! ModulesForm::textarea('question_hint','LMS::attributes.questions.hint',false,null,['rows' => '4']) !!} --}}
                    @endcomponent
                </div>
                <div class="col-md-4">
                    @component('components.box')
                        {!! ModulesForm::text('preview_video','LMS::attributes.main.preview_video',false) !!}
                        <small> {{__('LMS::attributes.main.preview_video_hint')}} </small>
                    @endcomponent
                    @component('components.box')
                        {!! ModulesForm::select('quizzes[]','LMS::attributes.main.quizzes', \LMS::getQuizzesList(),false,null,['multiple'=>true], 'select2') !!}
                        {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                    @endcomponent
                    <div class="clearfix"></div>

                </div>
            </div>


            <div class="row">
                @component('components.box')

                    {!! ModulesForm::customFields($question) !!}

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
@push('js')
<script type="text/javascript">
      $('body').on('click', '.disable-answer-btn', function () {
        var index = $(this).data('index');
        $("#tr_" + index).remove();
    });
</script>
<script type="text/javascript">
            $(function () {
           
            
               CKEDITOR.replaceAll('ckeditor2',{
                    pasteFromWordRemoveFontStyles : false,
    pasteFromWordRemoveStyles : false
               });
               // getCkeditorBasics();


        });
              function  getCkeditorBasics(){
        CKEDITOR.config.toolbar = [
   ['Styles','Format','Font','FontSize','CopyFormatting','Maximize','RemoveFormat'],
   '/',
   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
   '/',
   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
   ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
] ;
      }
    
</script>
    <script>


        (function ($) {
            $(document).ready(function () {
                questionTitleSelect('{{route("ajax.questions.title-search")}}');
            });

        })(jQuery)
    </script>
@endpush
