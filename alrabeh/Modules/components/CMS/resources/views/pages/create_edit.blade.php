@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('page_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! ModulesForm::openForm($page, ['files'=>true]) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! ModulesForm::text('title','CMS::attributes.content.title',true) !!}
                    </div>
                    <div class="col-md-4">
                        {!! ModulesForm::text('slug','CMS::attributes.content.slug',true) !!}
                    </div>
                </div>
                @if($page->exists)
                    <div class="row">
                        <div class="col-md-2">
                            <div class="m-b-10">
                                {!! ModulesForm::link(url($resource_url.'/'.$page->hashed_id.'/design'), 'CMS::labels.page.edit_in_designer',['target'=>'_blank', 'class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::textarea('content','CMS::attributes.content.content',false, null, ['class'=>'ckeditor']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! ModulesForm::textarea('meta_keywords','CMS::attributes.content.meta_keywords',false,$page->meta_keywords,['rows'=>4]) !!}
                    </div>
                    <div class="col-md-6">
                        {!! ModulesForm::textarea('meta_description','CMS::attributes.content.meta_description',false,$page->meta_description,['rows'=>4]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                {!! ModulesForm::checkbox('published', 'CMS::attributes.content.published',$page->published) !!}
                            </div>
                            <div class="col-md-4">
                                {!! ModulesForm::checkbox('private', 'CMS::attributes.content.private',$page->private, 1,
                                ['help_text'=>'CMS::attributes.content.private_help']) !!}
                            </div>
                           {{--  <div class="col-md-4">
                                {!! ModulesForm::checkbox('internal', 'CMS::attributes.content.internal', $page->internal, 1,
                                ['help_text'=>'CMS::attributes.content.internal_help']) !!}
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! ModulesForm::select('template','CMS::attributes.content.template', \CMS::getFrontendThemeTemplates()) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($page->featured_image)
                            <img src="{{ $page->featured_image }}" class="img-responsive" style="max-width: 100%;"
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
                {!! ModulesForm::customFields($page) !!}
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        {!! ModulesForm::formButtons() !!}
                    </div>
                </div>
                {!! ModulesForm::closeForm($page) !!}
                <hr/>
                <div class="row">
                    <div class="col-md-5">
                        <small>@lang('CMS::labels.page.designer_powered')</small>
                        <h4><img src="{{ asset('assets/modules/plugins/page-designer/grapesjs-logo.png') }}"
                                 height="20"
                                 alt="GrapesJS Logo"/> @lang('CMS::labels.page.grapes_js') </h4>
                        <blockquote>
                            @lang('CMS::labels.page.paragraph_grapes')
                        </blockquote>
                        <div class="help-text text-muted">
                            @lang('CMS::labels.page.for_demo_and_docs')
                            <a href="http://grapesjs.com/" target="_blank">http://grapesjs.com/</a>
                        </div>
                        <br/>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
@endsection
