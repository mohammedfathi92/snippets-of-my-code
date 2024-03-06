@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("countries.title_country_guide",['country'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{url("/country/{$country->id}/".str_slug($country->{"name:en"}))}}">{{$country->name}}</a>
                </li>
                <li>
                    <a href="{{url("/country/{$country->id}/".str_slug($country->{"name:en"})."/guide")}}">{{trans("countries.link_guide")}}</a>
                </li>
                <li class="active">{{$category->name}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")

    <div class="col-md-9">


        <div class="block">
            <h1>{{$topic->name}}</h1>
            <div class="flexslider photo-gallery style3">
                <img class="img-responsive lazy" src="{{url("files/{$topic->photo}?size=1170,342")}}"
                     alt="{{$topic->name}}">
            </div>
        </div>

        @if($topic->description)
            <article class="travelo-box">
                {!! $topic->description !!}
            </article>
            @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif
        @endif
        @if($topic->tabs()->count())
            <div class="large-block image-box style6">
                @php
                    $right=true;
                @endphp
                @foreach($topic->tabs as $tab)

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
                            <h4 class="box-title flat-blue">{{$tab->title}}</h4>
                            <p>{!! $tab->description !!}</p>
                        </div>
                    </article>
                    @if($right)@php $right=false @endphp @else @php $right=true @endphp @endif
                @endforeach
            </div>
        @endif
        @php
            $related=$category->articles()->published($topic->id);
        @endphp
        @if($related->count())
            <div class="cruise-list row image-box listing-style2 add-clearfix">
                <h4>{{trans("articles.related_articles_title")}}</h4>
                @foreach($related->get() as $item)
                    <div class="col-sms-6 col-sm-6 col-md-4">
                        <article class="box">
                            <figure>
                                <a href="{{url("guide/{$category->id}/topic/{$item->id}/".str_slug($item->{"name:en"}))}}"><img
                                            class="img-responsive lazy"
                                            src="{{url("files/{$topic->photo}?size=270,160")}}" alt="{{$item->name}}"
                                            width="270"
                                            height="160"/></a>
                            </figure>
                            <div class="details">
                                <a href="{{url("guide/{$category->id}/topic/{$item->id}/".str_slug($item->{"name:en"}))}}"
                                   class="box-title">{{$item->name}}</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="sidebar col-md-3">

        @if($country->generalCategories()->count())
            <div class="travelo-box filters-container faq-topics">
                <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$country->name]) !!}</h4>
                <ul class="triangle filters-option">
                    @foreach($country->generalCategories as $item)
                        <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                            <a href="{{url("guide/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                            @if($item->subCategories()->count())
                                <ul class="list-group">
                                    @foreach($item->subCategories as $subItem)
                                        <li class="list-group-item {{($subItem->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                            <a href="{{url("guide/{$subItem->id}/".str_slug($subItem->name))}}">{{$subItem->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>
        @endif
        @if(Settings::get('show_help_box'))
            <div class="travelo-box contact-box">
                <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
            </div>
        @endif

    </div>

@stop
