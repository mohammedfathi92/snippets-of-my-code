@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("guide/{$category->id}/topic/{$topic->id}/".make_slug($topic->name),$localeCode)}}"/>
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
                <li>
                    <a href="{{\LaravelLocalization::localizeURL("/country/{$country->id}/".make_slug($country->name)."/guide")}}">{{trans("countries.link_guide")}}</a>
                </li>
                <li class="active">{{$category->name}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-md-9">
            @if($errors->count())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if($alert_type=Session::get("alert-type"))
                <div class="alert alert-{{$alert_type=="success"?"success":"danger"}}">
                    <p>{{Session::get("message")}}</p>
                </div>
            @endif

            <div class="block">
                <h1>{{$topic->name}}</h1>
                <span class="help-block"><i class="fa fa-calendar"></i> <strong>{{trans("articles.last_update")}}
                        : </strong><span
                            class="time" style="direction: ltr;text-align: right">{{\Carbon\Carbon::parse($topic->updated_at)->format(" d/m/Y - H:i")}}
                    </span>
                </span>
                <div class="flexslider photo-gallery style3">
                    <img class="img-responsive lazy" src="{{url("files/{$topic->photo}?size=1170,700")}}"
                         alt="{{$topic->name}}">
                </div>
            </div>

            @if($topic->description)
                <article class="travelo-box long-description">
                    {!! $topic->description !!}
                </article>
                @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
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
                $related=$category->articles()->published($topic->id)->take(9);
            @endphp
            @if($related->count())
                <div class="cruise-list row image-box listing-style2 add-clearfix">
                    <h4>{{trans("articles.related_articles_title")}}</h4>
                    @foreach($related->get() as $item)
                        <div class="col-sms-6 col-sm-6 col-md-4">
                            <article class="box">
                                <figure>
                                    <a href="{{\LaravelLocalization::localizeURL("guide/{$category->id}/topic/{$item->id}/".make_slug($item->name))}}"><img
                                                class="img-responsive lazy"
                                                src="{{url("files/{$item->photo}?size=270,160")}}" alt="{{$item->name}}"
                                                width="270"
                                                height="160"/></a>
                                </figure>
                                <div class="details">
                                    <a href="{{\LaravelLocalization::localizeURL("guide/{$category->id}/topic/{$item->id}/".make_slug($item->name))}}"
                                       class="box-title">{{$item->name}}</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @endif


        <!-- Comments $ reviews-->
            @include('frontend.parts.comments_reviews', ['module' => "articles", 'module_data'=>$topic])


        </div>
        <div class="sidebar col-md-3">

            @if($country->generalCategories()->count())
                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$country->name]) !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($country->generalCategories as $item)
                            <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                <a href="{{\LaravelLocalization::localizeURL("guide/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
                                @if($item->subCategories()->count())
                                    <ul class="list-group">
                                        @foreach($item->subCategories as $subItem)
                                            <li class="list-group-item {{($subItem->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                                <a href="{{\LaravelLocalization::localizeURL("guide/{$subItem->id}/".make_slug($subItem->name))}}">{{$subItem->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
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
