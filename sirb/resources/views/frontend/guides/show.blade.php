@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("guide/{$category->id}/".make_slug($category->name),$localeCode)}}"/>
        @endif
    @endforeach
    @if($topics->nextPageUrl())
        <link rel="next" href="{{$topics->nextPageUrl()}}">
    @endif
    @if($topics->previousPageUrl())
        <link rel="prev" href="{{$topics->previousPageUrl()}}">
    @endif
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
            @if($category->description)
                <article class="travelo-box">
                    {!! $category->description !!}
                </article>
            @endif
            @if($topics->count())
                <div class="cruise-list row image-box listing-style2 add-clearfix">
                    @foreach($topics as $topic)
                        <div class="col-sms-6 col-sm-6 col-md-4">
                            <article class="box">
                                <figure>
                                    <a href="{{\LaravelLocalization::localizeURL("guide/{$category->id}/topic/{$topic->id}/".make_slug($topic->name))}}"><img
                                                class="img-responsive lazy"
                                                src="{{url("files/{$topic->photo}?size=270,160")}}"
                                                alt="{{$topic->name}}"
                                                width="270"
                                                height="160"/></a>
                                </figure>
                                <div class="details">
                                    <a href="{{\LaravelLocalization::localizeURL("guide/{$category->id}/topic/{$topic->id}/".make_slug($topic->name))}}"
                                       class="box-title">{{$topic->name}}</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    {!! trans("articles.no_articles_found") !!}
                </div>
            @endif
            <div class="clearfix"></div>
            <div class="pagination">
                {!! $topics->links() !!}
            </div>
        </div>
        <div class="sidebar col-md-3">
            @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif
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
