@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{$page->name}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{$page->name}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")

    <div class="col-md-9">
        @if($page->gallery()->count())
            <div class="block">

                <div class="flexslider photo-gallery style4">
                    <ul class="slides">
                        @foreach($page->gallery as $photo)
                            <li><img class="img-responsive lazy"
                                     src="{{url("files/{$photo->name}?size=1170,342")}}"
                                     alt="{{$page->name}}"></li>
                        @endforeach
                    </ul>
                </div>

            </div>
        @elseif($page->photo)
            <div class="block">
                <div class="flexslider photo-gallery style4">
                    <ul class="slides">

                        <li><img class="img-responsive lazy"
                                 src="{{url("files/{$page->photo}?size=1170,342")}}" alt="{{$page->name}}">
                        </li>
                    </ul>
                </div>

            </div>
        @endif

        @if($page->content)
            <article class="travelo-box">
                {!! $page->content !!}
            </article>
        @endif
        @if($page->tabs()->count())
            <div class="large-block image-box style6">
                @php
                    $right=true;
                @endphp
                @foreach($page->tabs as $tab)

                    <article class="box">
                        <figure class="@if($right) col-md-5 pull-right middle-block @else col-md-5 @endif">
                            @if($tab->photo)
                                <a href="#" title="" class="middle-block">
                                    <img class="middle-item lazy"
                                         src="{{url("files/{$tab->photo}?size=476,318&encode=jpg")}}"
                                         alt="{{$tab->title}}"
                                         width="476" height="318"/></a>
                            @endif()
                        </figure>
                        <div class="@if($right)details col-md-7 @else details col-md-offset-5 @endif">
                            <h4 class="box-title">{{$tab->title}}</h4>
                            <p>{!! $tab->description !!}</p>
                        </div>
                    </article>
                    @if($right)@php $right=false @endphp @else @php $right=true @endphp @endif
                @endforeach
            </div>
        @endif
    </div>
    <div class="sidebar col-md-3">
        @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
            <div class="addthis_inline_share_toolbox"></div> @endif
        @if(Settings::get('show_help_box'))
            <div class="travelo-box contact-box">
                <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
            </div>
        @endif

    </div>

@stop
