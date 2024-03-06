@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("testimonials",$localeCode)}}"/>
        @endif
    @endforeach
    @if($data->nextPageUrl())
        <link rel="next" href="{{$data->nextPageUrl()}}">
    @endif
    @if($data->previousPageUrl())
        <link rel="prev" href="{{$data->previousPageUrl()}}">
    @endif
@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("testimonials.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                @if(isset($country))
                    <li><a href="{{\LaravelLocalization::localizeURL("/testimonials")}}">{{trans("testimonials.link_testimonials")}}</a></li>
                    <li class="active">{{$country->name}}</li>
                @else
                    <li class="active">{{trans("testimonials.frontend_page_header")}}</li>
                @endif
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-md-9">
            @if($data->count())
                @foreach($data as $item)
                    <div class="travel-story-container box">
                        <div class="travel-story-content">
                            <div class="avatar">
                                <img class="img-responsive lazy"
                                     src="@if($item->avatar) {{url("files/$item->avatar?size=90,90&encode=jpg")}} @else /images/default-avatar.jpg @endif"
                                     width="90" height="90" alt="">
                                <h5><a href="#">{{$item->visitor_name}}</a></h5>
                            </div>
                            <div class="description">
                                <h4 class="skin-color">{{$item->title}}</h4>
                                <p>{!! $item->description !!}</p>
                                @if($item->gallery()->count())
                                    <div class="my-trip">
                                        <h5>{{trans("testimonials.title_my_trip_photos")}}</h5>
                                        <ul>
                                            @foreach($item->gallery as $image)
                                                <li>
                                                    <a href="{{url("files/{$image->name}/?encode=jpg")}}"
                                                       class="hover-effect" data-fancybox="gallery">
                                                        <img class="img-responsive lazy"
                                                             src="{{url("files/{$image->name}/?size=170,160&encode=jpg")}}"
                                                             alt="">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="travel-story-meta clearfix">
                            <div class="story-meta">
                            <span class="date"><i
                                        class="soap-icon-clock"></i>{{\Carbon\Carbon::instance($item->created_at)->toDateString()}}</span>
                            </div>
                            <span class="travel-miles"><i
                                        class="soap-icon-locations"></i><span><a
                                            href="{{\LaravelLocalization::localizeURL("country/{$item->country->id}/".make_slug($item->country->name))}}">{{$item->country->name}}</a></span></span>
                        </div>
                    </div>
                @endforeach
                {!! $data->links() !!}
            @else
                <div class="alert alert-info"><p>{{trans("testimonials.no_testimonials_found")}}</p></div>
            @endif
        </div>
        <div class="sidebar col-sm-4 col-md-3">
            <div class="travelo-box filters-container faq-topics">

                <h4 class="box-title">{{trans("testimonials.title_all_text_destinations")}}</h4>
                <ul class="triangle filters-option">
                    <li class="{{(!Request::segment(3))?"active":""}}"><a
                                href="{{\LaravelLocalization::localizeURL("testimonials")}}">{{trans("testimonials.link_all_destinations")}}</a></li>
                    @foreach(\Sirb\Country::published()->get() as $c)
                        <li class="{{($c->id==Request::segment(4))?"active":""}}"><a
                                    href="{{\LaravelLocalization::localizeURL("testimonials/destination/$c->id/".make_slug($c->name))}}">{{trans("testimonials.travelers_to_country",["country"=>$c->name])}}</a>
                        </li>
                    @endforeach

                </ul>
                <a href="{{\LaravelLocalization::localizeURL("testimonials/create")}}"
                   class="btn btn-success full-width">{{trans("testimonials.frontend_btn_create")}}</a>
            </div>
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
@section("scripts")
    <script>
        (function ($) {
            $("[data-fancybox]").fancybox();
        })(jQuery)

    </script>
@stop
