@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("news.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li><a href="{{url("/news")}}">{{trans("news.link_news")}}</a></li>
                <li class="active">{{trans("news.link_search")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="col-sm-8 col-md-9">
        <div class="page">

            <div class="post-content">
                <div class="blog-infinite">
                    @if($posts)
                        @foreach($posts as $post)
                            <div class="post">
                                <div class="post-content-wrapper">
                                    @if($post->photo)
                                        <figure class="image-container">
                                            <a href="{{url("news/{$post->id}/".str_slug($post->name))}}" class=""><img
                                                        class="img-responsive lazy" src="{{url("files/{$post->photo}?size=870,342&encode=jpg")}}"
                                                        alt="{{$post->name}}"/></a>
                                        </figure>
                                    @endif
                                    <div class="details">
                                        <h2 class="entry-title"><a
                                                    href="{{url("news/{$post->id}/".str_slug($post->name))}}">{{$post->name}}</a>
                                        </h2>
                                        <div class="excerpt-container">
                                            <p>{!! str_limit(strip_tags($post->description),200) !!}</p>
                                        </div>
                                        <div class="post-meta">
                                            <div class="entry-date">
                                                <label class="date">{{date("d",strtotime($post->created_at))}}</label>
                                                <label class="month">{{date("M",strtotime($post->created_at))}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
    <div class="sidebar col-sm-4 col-md-3">
        @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code"))) <div class="addthis_inline_share_toolbox"></div> @endif
        <div class="travelo-box">
            {!! Form::open(["url"=>"/news/search","method"=>"get"]) !!}
            <h5 class="box-title">{{trans("news.search_box_title")}}</h5>
            <div class="with-icon full-width">
                <input type="text" name="q" class="input-text full-width"
                       placeholder="{{trans("news.search_placeholder")}}" value="{{Request::get("q")}}">
                <button class="icon green-bg white-color"><i class="soap-icon-search"></i></button>
            </div>
            {!! Form::close() !!}
        </div>
        @if(Settings::get('show_help_box'))
            <div class="travelo-box contact-box">
                <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
            </div>
        @endif
    </div>

@endsection