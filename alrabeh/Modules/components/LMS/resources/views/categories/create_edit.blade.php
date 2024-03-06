@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('category_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
{!! Form::model($category, ['url' => url($resource_url.'/'.$category->hashed_id),'method'=>$category->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
    
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                

                {!! ModulesForm::text('name','LMS::attributes.main.name',true) !!}
                {{-- {!! ModulesForm::text('slug','LMS::attributes.main.slug',true) !!} --}}

            {{--     @if (\Modules::isModuleActive('developnet-subscriptions'))
                    {!! ModulesForm::select('subscription_plans[]','LMS', [], false, null,
                    ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                    'model'=>\Modules\Components\Subscriptions\Models\Plan::class,
                    'columns'=> json_encode(['name']),
                    'selected'=>json_encode($category->subscribable_plans(['getData'=>true])->pluck('id')->toArray()),
                    'where'=>json_encode([['field'=>'status','operation'=>'=','value'=>'active']]),
                    ]],'select2') !!}
                @endif --}}

                {!! ModulesForm::select('parent_id','LMS::attributes.main.parent',\LMS::getParentCategoriesList($category->id),false,null,[], 'select2') !!}

               
            @endcomponent
        </div>

        <div class="col-md-4">
            @component('components.box')
                      @if($category->hasMedia($category->mediaCollectionName))
                    <img src="{{ $category->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                         alt="Thumbnail"/>
                    <br/>
                    {!! ModulesForm::checkbox('clear', 'LMS::attributes.main.clear') !!}
                @endif
                {!! ModulesForm::file('thumbnail', 'LMS::attributes.main.featured_image') !!}

                <hr>

     <div class="col-md-12"> {{-- courses --}}
         {!! ModulesForm::select('courses[]','LMS::attributes.main.courses', \LMS::getCoursesList(),false,null,['multiple'=>true], 'select2') !!}
        
    </div>

    <div class="col-md-12"> {{-- quizzes --}}

         {!! ModulesForm::select('quizzes[]','LMS::attributes.main.quizzes', \LMS::getQuizzesList(),false,null,['multiple'=>true], 'select2') !!}
        
    </div>

        <div class="col-md-12"> {{-- books --}}

         {!! ModulesForm::select('books[]','LMS::attributes.main.books', \LMS::getBooksList(),false,null,['multiple'=>true], 'select2') !!}
        
    </div>

                <hr>

                {!! ModulesForm::radio('status','LMS::attributes.main.status',true, trans('LMS::attributes.main.status_options_active'),$category->exists?$category->status:'active', []) !!}
                <br>
                {!! ModulesForm::checkbox('is_featured','LMS::attributes.plans.featured',$category->is_featured >= 1?true:false,true ) !!} 

            @endcomponent

            


            <div class="clearfix"></div>

        </div>
    </div>

     {!! ModulesForm::customFields($category, 'col-md-12') !!}

    {!! ModulesForm::formButtons() !!}
    {!! Form::close() !!}

@endsection

@section('js')
@endsection