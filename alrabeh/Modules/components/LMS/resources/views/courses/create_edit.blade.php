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
     .flex{
        display: flex;
     }
     .flex div:first-child{ 
        margin-left: 10px;
     }

     .tabbable{
        display: flex;
        margin: -10px;
     }
     .tabbable.tabs-left > .nav-tabs > li{
        min-width: 150px;
     }
     .tabbable.tabs-left > .nav-tabs{
           border-left: 1px solid #ddd; 
           border-right: transparent;
           margin-right: 0;
           margin-left: 19px;
           background:#f5f5f5;
           display: flex;
           flex-direction: column;
     }
    .tabbable.tabs-left > .nav-tabs .active > a,
    .tabbable.tabs-left > .nav-tabs .active > a:hover, 
    .tabbable.tabs-left > .nav-tabs .active > a:focus{
        border-color: #ddd #ddd #ddd transparent;
         margin-left: -2px;
         padding: 15px;


     }
    
     .tabbable.tabs-left li.active a{
        border-color: #ddd;
        background-color: #fff;
     }
     .tabbable .tab-content{
        padding: 10px 0;
     }
     .tabbable.tabs-left > .nav-tabs{
        padding: 20px 0;
     }
     .radio-column .form-group >div{
        display: flex;
        flex-direction: column;
     }
     .radio-column .form-group >label{
        margin-bottom: 15px;
     }
     .radio-column .form-group >div >label{
        margin-bottom: 0;
     }
     @media(max-width: 520px){
        .flex{
            flex-direction: column;

        }
        .tabbable.tabs-left > .nav-tabs > li{
            min-width: auto;
        }
        
     }
  </style>
  
@endsection

@section('content_header')
@component('components.content_header')
@slot('page_title')
{{ $title_singular }}
@endslot
@slot('breadcrumb')
{{ Breadcrumbs::render('lms_course_create_edit') }}
@endslot
@endcomponent
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">

        {!! Form::model($course, ['url' => url($resource_url.'/'.$course->hashed_id),'method'=>$course->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
        <div class="row">
            <div class="col-md-8">
                @component('components.box')
                
                {!! ModulesForm::text('title','LMS::attributes.main.name',true) !!}
                {{-- {!! ModulesForm::text('slug','LMS::attributes.main.slug',true) !!} --}}
                
                
                {!! ModulesForm::textarea('content',trans('LMS::attributes.main.content'),true,null,['class'=>'ckeditor']) !!}
                {!! ModulesForm::textarea('summary',trans('LMS::attributes.courses.summary')) !!}
                @endcomponent
            </div>
            <div class="col-md-4">
            @component('components.box')
            {!! ModulesForm::text('preview_video','LMS::attributes.main.preview_video',false) !!}
            <small> {{__('LMS::attributes.main.preview_video_hint')}} </small>
            @endcomponent
                @component('components.box')
               @if($course->hasMedia($course->mediaCollectionName))
                            <img src="{{ $course->thumbnail }}" class="img-responsive" style="max-width: 100%;"
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

            <div class="col-md-8">
           
                @component('components.box',['box_title'=>__('LMS::attributes.courses.units')])
      <div class="row" style="display: flex; justify-content: center;">
       
       
            {{-- sections --}}
            <div class="col-md-12">
                <div id="alert_error_section"></div>

    <div  class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

              <div class="input-group margin" id="createCourseSection">
                <input type="text" class="form-control" placeholder="{{ __('LMS::attributes.courses.new_unit')}}" name="course_item_title">
                <span class="input-group-btn">
                  <a href="javascript:;" class="btn btn-info btn-flat" onclick="createCourseItem('section', 'createCourseSection')">{{ __('LMS::attributes.courses.create_unit')}}</a>
                </span>
              </div> 


              
           
          </div>             

            
            </div>
          

              <hr>
               <div class="row">
                 <div class="col-sm-12">
                   <div class="box box-solid">
         
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="course-items-list-group">
          
                @foreach($course->sections()->orderBy('order', 'asc')->get() as $section)
              
              @include('LMS::courses.partials.selected_items', ['section', $section])

              @endforeach
              

                <div id="new_course_item_row"></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
   
           </div>
      </div>
      <!-- /.row -->
                    @endcomponent
       </div>
   </div>


      
   <div class="row">

    <div class="col-md-8">

       @component('components.box',['box_title'=>__('LMS::attributes.main.settings_head')])

                <!-- tabs -->
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings_general" data-toggle="tab"><i
                            class="fas fa-wrench"></i> {{trans('LMS::attributes.main.general_settings')}}
                        </a></li>
                        <li>
                            <a href="#settings_assessment" data-toggle="tab"><i
                                class="fas fa-percent"></i> {{trans('LMS::attributes.main.assessment')}}
                            </a>
                        </li>
                        <li><a href="#settings_pricing" data-toggle="tab"><i
                                class="fa fa-money"></i> {{trans('LMS::attributes.main.pricing')}}
                            </a>
                        </li>
                        <li><a href="#settings_author" data-toggle="tab"><i
                                class="fa fa-user"></i> {{trans('LMS::attributes.courses.author')}}
                            </a>
                        </li>
                    </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="settings_general">
                           <div>
                                {!! ModulesForm::select('certificate_id','LMS::attributes.main.certificate',\LMS::getCertificatesList(),false,$course->certificate_id,['class' => 'select2']) !!}
                                </div>
                            <div class=" display-flex">
                             

                                <div >
                                    {!! ModulesForm::number('duration','LMS::attributes.courses.course_duration',false, $course->exists?$course->duration: 0.00,
                                    ['min'=>0])!!}  
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
                                    {!! ModulesForm::select('duration_unit',' ', $duration_unit,false,$course->exists?$course->duration_unit:'week') !!}
                                </div> 
                            </div> 
                            <br>
                            <div class="flex">
                               {!! ModulesForm::number('max_students','LMS::attributes.courses.max_students',false,$course->exists?$course->max_students: 0.00,['min'=>0])!!}  
                            
                              {!! ModulesForm::number('enrolled_students','LMS::attributes.courses.enrolled_students',false,$course->exists?$course->enrolled_students: 0.00,['min'=>0])!!}  
                            </div>
                            <div class="flex">
                                {!! ModulesForm::number('retake_count','LMS::attributes.courses.retake_count',false,$course->exists?$course->retake_count: '1',['min'=>0])!!}
                                {!! ModulesForm::number('passing_grade','LMS::attributes.courses.passing_condition',false,$course->exists?$course->passing_condition: '50',['min'=>0])!!}
                            </div>
                            <br>
                             
                            {!! ModulesForm::checkbox('is_featured','LMS::attributes.courses.featured',$course->is_featured >= 1?true:false) !!}

                             {!! ModulesForm::checkbox('pagination_lessons','LMS::attributes.courses.pagination_lessons',$course->pagination_lessons >= 1?true:false) !!}
                             <small>@lang('LMS::attributes.courses.pagination_lessons_hint')</small>

                           {{--  {!! ModulesForm::checkbox('block_lessons','LMS::attributes.courses.block_lessons',$course->block_lessons >= 1?true:false) !!}

                            {!! ModulesForm::checkbox('allow_comments','LMS::attributes.main.allow_comments',$course->allow_comments >= 1?true:false) !!}
 --}}
                           

                            <div style="width: 50%">
                                {!! ModulesForm::date('started_at','LMS::attributes.courses.started_at',false,$course->started_at) !!}
                            </div>
                    </div>
                    <div class="tab-pane" id="settings_assessment">
                        <div class="radio-column">
                            
                           {!! ModulesForm::radio('evaluation_type','LMS::attributes.courses.course_result_evaluation',false, trans('LMS::attributes.courses.evaluation_type_options'),1) !!}
                        </div>
                    </div>

                    <div class="tab-pane" id="settings_pricing">
                            <div class="flex">


                                {!! ModulesForm::number('price','LMS::attributes.courses.price',true, $course->exists?$course->price: 0.00,['min'=>0])!!}
                                {!! ModulesForm::number('sale_price','LMS::attributes.courses.sale_price',true, $course->exists?$course->sale_price: 0.00,['min'=>0])!!}
                            </div>
                    </div>
                    <div class="tab-pane" id="settings_author">
                        

                        {!! ModulesForm::select('author_id','LMS::attributes.courses.author',\LMS::getAuthorsList(),true) !!}
                    </div>
                </div> 
        </div>
        <!-- /tabs -->
        @endcomponent 
    </div>
</div>
<div class="row">
    @component('components.box')

    {!! ModulesForm::customFields($course) !!}

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

@include('LMS::courses.partials.modals')

@endsection


@section('js')



@include('LMS::courses.partials.scripts', ['course_session_id' => $course_session_id])
@endsection