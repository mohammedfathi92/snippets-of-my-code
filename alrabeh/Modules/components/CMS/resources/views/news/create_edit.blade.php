@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('news_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            {!! ModulesForm::openForm($news, ['files'=>true]) !!}
            @component('components.box')
                <div class="row">
                    <div class="col-md-4">
                        {!! ModulesForm::text('title','CMS::attributes.content.title',true) !!}
                    </div>
                    <div class="col-md-4">
                        {!! ModulesForm::text('slug','CMS::attributes.content.slug',true) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::textarea('content','CMS::attributes.content.content',true, null, ['class'=>'ckeditor']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! ModulesForm::textarea('meta_keywords','CMS::attributes.content.meta_keywords',false,$news->meta_keywords,['rows'=>4]) !!}
                    </div>
                    <div class="col-md-6">
                        {!! ModulesForm::textarea('meta_description','CMS::attributes.content.meta_description',false,$news->meta_description,['rows'=>4]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                @if($news->featured_image)
                                    <img src="{{ $news->featured_image }}" class="img-responsive"
                                         style="max-width: 100%;"
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
                        <div class="row">
                            <div class="col-md-4">
                                {!! ModulesForm::checkbox('published', 'CMS::attributes.content.published',$news->published) !!}
                            </div>
                            <div class="col-md-4">
                                {!! ModulesForm::checkbox('private', 'CMS::attributes.content.private',$news->private, 1,
                                ['help_text'=>'CMS::attributes.content.private_help']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! ModulesForm::checkbox('internal', 'CMS::attributes.content.internal', $news->internal, 1,
                                ['help_text'=>'CMS::attributes.content.internal_help']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! ModulesForm::select('template','CMS::attributes.content.template', \CMS::getFrontendThemeTemplates() ) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {!! ModulesForm::customFields($news) !!}
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        {!! ModulesForm::formButtons() !!}
                    </div>
                </div>
            @endcomponent
            {!! ModulesForm::closeForm($news) !!}
        </div>
    </div>
@endsection
