@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('post_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            {!! ModulesForm::openForm($post, ['files' => true]) !!}
            {!! Form::model($post, ['url' => url($resource_url.'/'.$post->hashed_id),'method'=>$post->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
            @component('components.box')
                <div class="row">
                    <div class="col-md-4">
                        {!! ModulesForm::text('title','CMS::attributes.content.title',true) !!}
                    </div>
                    <div class="col-md-4">
                        {!! ModulesForm::text('slug','CMS::attributes.content.slug',true) !!}
                    </div>
                    <div class="col-md-4">
                        {!! ModulesForm::select('categories[]','CMS::attributes.content.categories', \CMS::getCategoriesList(),true,null,['multiple'=>true], 'select2') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::textarea('content','CMS::attributes.content.content',true, null, ['class'=>'ckeditor']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! ModulesForm::textarea('meta_keywords','CMS::attributes.content.meta_keywords',false,$post->meta_keywords,['rows'=>4]) !!}
                    </div>
                    <div class="col-md-6">
                        {!! ModulesForm::textarea('meta_description','CMS::attributes.content.meta_description',false,$post->meta_description,['rows'=>4]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                {!! ModulesForm::select('tags[]','CMS::attributes.content.tags', \CMS::getTagsList(),false,null,['class'=>'tags','multiple'=>true], 'select2') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                {!! ModulesForm::checkbox('published', 'CMS::attributes.content.published',$post->published) !!}
                            </div>
                            <div class="col-md-4">
                                {!! ModulesForm::checkbox('private', 'CMS::attributes.content.private',$post->private, 1,
                                ['help_text'=>'CMS::attributes.content.private_help']) !!}
                            </div>
                          {{--   <div class="col-md-4">
                                {!! ModulesForm::checkbox('internal', 'CMS::attributes.content.internal', $post->internal, 1,
                                ['help_text'=>'CMS::attributes.content.internal_help']) !!}
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Featured Image"/>
                            <br/>
                            {!! ModulesForm::checkbox('clear', 'CMS::attributes.content.clear') !!}
                        @endif
                        {!! ModulesForm::file('featured_image', 'CMS::attributes.content.featured_image') !!}
                        -- OR --
                        <br/>
                        <br/>
                        {!! ModulesForm::text('featured_image_link','CMS::attributes.content.featured_image_link') !!}
                    </div>
                </div>
                {!! ModulesForm::customFields($post) !!}
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        {!! ModulesForm::formButtons() !!}
                    </div>
                </div>
            @endcomponent
            {!! ModulesForm::closeForm($post) !!}
        </div>
    </div>
@endsection
