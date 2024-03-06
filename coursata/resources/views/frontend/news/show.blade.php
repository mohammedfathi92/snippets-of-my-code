@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("news.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("news.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="col-sm-8 col-md-9">
        <div class="page">

            <div class="post-content">
                <div class="blog-infinite">

                    <div class="post">

                        <div class="post-content-wrapper">
                            @if($post->photo)
                                <figure class="image-container">
                                    <img
                                            src="{{url("files/{$post->photo}?size=870,342&encode=jpg")}}"
                                            alt="{{$post->name}}"/>
                                </figure>
                            @endif
                            <div class="details">
                                <h2 class="entry-title">{{$post->name}}
                                </h2>
                                <div class="excerpt-container">
                                    <p>{!! $post->description !!}</p>
                                </div>
                                <div class="post-meta">
                                    <div class="entry-date">
                                        <label class="date">{{date("d",strtotime($post->created_at))}}</label>
                                        <label class="month">{{date("M",strtotime($post->created_at))}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Settings::get("show_share_buttons")) <div class="addthis_inline_share_toolbox"></div> @endif
                    </div>
                </div>

                @if($related->count())
                    <h2>{{trans("news.title_related_posts")}}</h2>
                    <div class="travelo-box">
                        <div class="suggestions image-carousel style2" data-animation="slide" data-item-width="150"
                             data-item-margin="22">
                            <ul class="slides">
                                @foreach($related->get() as $item)
                                    <li>
                                        <a href="{{url("news/{$item->id}/".str_slug($item->name))}}" class="">
                                            <img src="{{url("files/{$item->photo}?size=170,170&encode=jpg")}}"
                                                 alt="{{$item->name}}" class="middle-item"/>
                                        </a>
                                        <h5 class="caption">{{$item->name}}</h5>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="sidebar col-sm-4 col-md-3">
            @if(Settings::get("show_share_buttons")) <div class="addthis_inline_share_toolbox"></div> @endif

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
                <address class="contact-details">
                    @if(Settings::get('help_phone'))
                        <span class="contact-phone"><i
                                    class="soap-icon-phone"></i>{{Settings::get('help_phone')}}</span>
                    @endif
                    <br>
                    @if(Settings::get('help_email'))
                        <a class="contact-email"
                           href="mailto:{{Settings::get('help_email')}}">{{Settings::get('help_email')}}</a>
                    @endif
                </address>
            </div>
        @endif

    </div>

@endsection