@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name)."/guide",$localeCode)}}"/>
        @endif
    @endforeach

@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("countries.title_country_guide",['country'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{\LaravelLocalization::localizeURL("/country/{$country->id}/".make_slug($country->name))}}">{{$country->name}}</a>
                </li>
                <li class="active">{{trans("countries.link_guide")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-md-9">
            @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif
            @if($country->photo)
                <div class="thumbnail">
                    <img class="img-responsive lazy" src="{{url("files/{$country->photo}?size=870,395")}}"
                         alt="{{$country->name}}"
                    >
                </div>
            @endif

            <article class="travelo-box">
                <div class="clearfix"></div>

                <span class="help-block"><i class="fa fa-calendar"></i> <strong>{{trans("articles.last_update")}}
                        : </strong><span
                            class="time" style="direction: ltr;text-align: right">{{\Carbon\Carbon::parse($country->updated_at)->format(" d/m/Y - H:i")}}
                    </span>
                </span>
                <div class="clearfix"></div>
                {!! $country->guide !!}
            </article>
            @if($country->tabs()->count())
                <div class="large-block image-box style6">
                    @php
                        $right=true;
                    @endphp
                    @foreach($country->tabs as $tab)

                        <article class="box">
                            <figure class="@if($right) col-md-5 pull-right middle-block @else col-md-5 @endif">
                                @if($tab->photo)
                                    <a href="#" title="" class="middle-block">
                                        <img
                                                class="middle-item lazy"
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
            @if($country->generalCategories()->count())
                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$country->name]) !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($country->generalCategories as $item)
                            <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                <a href="{{\LaravelLocalization::localizeURL("guide/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>

            @endif
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>
                </div>
            @endif

        </div>
    </div>

@stop
