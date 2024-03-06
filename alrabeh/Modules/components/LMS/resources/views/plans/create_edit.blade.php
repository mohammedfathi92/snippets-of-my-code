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

</style>
@endsection
 
@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_plan_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! Form::model($plan, ['url' => url($resource_url.'/'.$plan->hashed_id),'method'=>$plan->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
            <div class="row">
                <div class="col-md-8">
                    @component('components.box', ['box_title' => __('LMS::attributes.main.general_head')])
                        {!! ModulesForm::text('title','LMS::attributes.main.name',true) !!}
                        {!! ModulesForm::text('slug','LMS::attributes.main.slug',true) !!}
                        {!! ModulesForm::textarea('content',__('LMS::attributes.main.description'),true,null,['class'=>'ckeditor']) !!}
                     
                    @endcomponent

                    @component('components.box', ['box_title' => __('LMS::attributes.main.settings_head')])
                         <div class="col-md-6">


                            {!! ModulesForm::number('price','LMS::attributes.main.price',true, $plan->exists?$plan->price: 0.00,['min'=>0]) !!}
                        
                            </div>

                             <div class="col-md-6">


                            {!! ModulesForm::number('sale_price','LMS::attributes.courses.sale_price',true, $plan->exists?$plan->sale_price:0.00,['min'=>0]) !!}
                        
                            </div>


                             @endcomponent


           


 @component('components.box', ['box_title' => __('LMS::attributes.plans.plan_items')])



     <div class="col-md-12"> {{-- categories --}}
        {!! ModulesForm::select('categories[]','LMS::attributes.main.categories', \LMS::getCategoriesList(),false,null,['multiple'=>true], 'select2') !!}
        
    </div>

    <div class="col-md-12"> {{-- courses --}}
         {!! ModulesForm::select('courses[]','LMS::attributes.main.courses', \LMS::getCoursesList(),false,null,['multiple'=>true], 'select2') !!}
        
    </div>

    <div class="col-md-12"> {{-- quizzes --}}

         {!! ModulesForm::select('quizzes[]','LMS::attributes.main.quizzes', \LMS::getQuizzesList(),false,null,['multiple'=>true], 'select2') !!}
        
    </div>

        <div class="col-md-12"> {{-- books --}}

         {!! ModulesForm::select('books[]','LMS::attributes.main.books', \LMS::getBooksList(),false,null,['multiple'=>true], 'select2') !!}
        
    </div>

   
                   
   @endcomponent   




                    
                </div>


                    <div class="col-md-4">
                    @component('components.box')
                        @if($plan->hasMedia($plan->mediaCollectionName))
                            <img src="{{ $plan->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Thumbnail"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear', 'LMS::attributes.main.clear') !!}
                        @endif
                        {!! ModulesForm::file('thumbnail', 'LMS::attributes.main.featured_image') !!}

                     {!! ModulesForm::select('parent_categories[]','LMS::attributes.main.plan_category', \LMS::getCategoriesList(),false,null,[], 'select2') !!}
                       
                        {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options'),1) !!}
                        <br>
                        {!! ModulesForm::checkbox('is_featured','LMS::attributes.plans.featured',$plan->is_featured >= 1?true:false,true ) !!} 
                    @endcomponent

                    
                    

                    <div class="clearfix"></div>

                </div>
        
            </div>
        

            <div class="row">
                @component('components.box')

                    {!! ModulesForm::customFields($plan) !!}

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
{{-- <script>
$(document).ready(function(){
    // $("#select_plan_duration").on('keyup', function(){
    //     $(".show-duration-div").toggle();
    // });
    $('#select_plan_duration').on('change', function() {
        if(this.value == 'duration'){


  $(".show-duration-div").show();
  $(".show-duration-items-div").hide();
  $(".show-items-div").hide();
  

   }else if(this.value == 'duration_items'){
    $(".show-duration-div").show();
     $(".show-items-div").show();

     $(".show-duration-items-div").show();

    }else if(this.value == 'items'){
    $(".show-duration-items-div").hide();    
    $(".show-duration-div").hide();
     $(".show-items-div").show();
   }else{

     $(".show-duration-items-div").hide();    
    $(".show-duration-div").hide();
     $(".show-items-div").hide();

   }

});
});


</script> --}}
@endsection
