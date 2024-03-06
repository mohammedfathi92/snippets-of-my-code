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
            {{ Breadcrumbs::render('books_management_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! Form::model($book, ['url' => url($resource_url.'/'.$book->hashed_id),'method'=>$book->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
            <div class="row">
                <div class="col-md-8">
                    @component('components.box', ['box_title' => __('LMS::attributes.main.general_head')])
                        {!! ModulesForm::text('title','LMS::attributes.main.name',true) !!}
                        {{-- {!! ModulesForm::text('slug','LMS::attributes.main.slug',true) !!} --}}
                        {!! ModulesForm::textarea('content',trans('LMS::attributes.main.description'),false,null,['class'=>'ckeditor']) !!}
                     
                    @endcomponent

                    @component('components.box', ['box_title' => __('LMS::attributes.main.settings_head')])
                                                <div class="row">
                             <div class="col-md-6">
                                   
{!! ModulesForm::number('pages_count','LMS::attributes.books.page_numbers',false,$book->pages_count,['min'=>0]) !!}
                            
                                 
                             </div>
                             <div class="col-md-6">
                             {!! ModulesForm::select('author_id','LMS::attributes.courses.author',\LMS::getAuthorsList(),true) !!}
                         </div>
                         </div>

                        {{--  <div class="row">
                             <div class="col-md-12">
                                 {!! ModulesForm::radio('can_download','LMS::attributes.books.can_download',true, trans('LMS::attributes.main.yes_no'),$book->can_download?:0) !!}
                             </div>
                         </div> --}}


                         
                         <div class="row">
                             <div class="col-md-6">
                                   


                                {!! ModulesForm::number('price','LMS::attributes.main.price',true, $book->exists?$book->price: 0.00,['min'=>0])!!}
                               
                                 
                             </div>
                                <div class="col-md-6">
                                   
                                {!! ModulesForm::number('sale_price','LMS::attributes.main.sale_price',false, $book->exists?$book->sale_price: 0.00,['min'=>0])!!}
                           
                                 
                             </div>
                         </div>


                        {{-- {!! ModulesForm::checkbox('allow_comments','LMS::attributes.main.allow_comments',$book->allow_comments >= 1?true:false,true ) !!} --}}
                             
                    @endcomponent


                     
                </div>
                <div class="col-md-4">
                    @component('components.box')
                    {!! ModulesForm::text('preview_video','LMS::attributes.main.preview_video',false) !!}
                    <small> {{__('LMS::attributes.main.preview_video_hint')}} </small>
                    @endcomponent
                    @component('components.box')
                     @if($book->hasMedia($book->fileCollectionName))
                     <br>
                            {{-- <p><a href="{{url(config('lms.models.book.resource_url').'/'.$book->hashed_id.'/show')}}" class="btn btn-primary" target="_blank"><i class="fa fa-book"></i> عرض الكتاب</a></p> --}}
                            <p><a href="{{'/ViewerJS/#..'.$book->file}}" class="btn btn-primary" target="_blank"><i class="fa fa-book"></i> عرض الكتاب</a></p>
                            
                            <br/>
                            {{-- {!! ModulesForm::checkbox('file_clear', 'LMS::attributes.main.clear') !!} --}}
                        @endif
                        {!! ModulesForm::file('book_file', 'LMS::attributes.books.book_file', $book->hasMedia($book->fileCollectionName)?false:true, ['accept'=>"application/pdf,application/vnd.ms-powerpoint"]) !!}

                        @if($book->hasMedia($book->mediaCollectionName))
                            <img src="{{ $book->thumbnail }}" class="img-responsive" style="max-width: 100%;"
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

                    {!! ModulesForm::customFields($book) !!}

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