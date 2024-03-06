@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("testimonials/videos",$localeCode)}}"/>
        @endif
    @endforeach

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
        <div class="sidebar col-sm-4 col-md-3">
            <div class="travelo-box filters-container faq-topics">

                <h4 class="box-title">{{trans("testimonials.title_all_video_destinations")}}</h4>
                <ul class="triangle filters-option">
                    <li class="{{(!Request::segment(3))?"active":""}}"><a
                                href="{{\LaravelLocalization::localizeURL("testimonials/videos")}}">{{trans("testimonials.link_all_destinations")}}</a>
                    </li>
                    @foreach(\Sirb\Country::published()->get() as $c)
                        <li class="{{($c->id==Request::segment(4))?"active":""}}"><a
                                    href="{{\LaravelLocalization::localizeURL("testimonials/videos/destination/$c->id/".make_slug($c->name))}}">{{trans("testimonials.travelers_to_country",["country"=>$c->name])}}</a>
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
        <div class="col-md-9">
            @if($data->count())
                <div class="items-container isotope row image-box style9">
                    @foreach($data as $item)
                        <div class="iso-item col-xs-12 col-sms-6 col-sm-6 col-md-4 filter-all filter-island filter-beach">
                            <article class="box">
                                <figure>
                                    @php
                                        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $item->video_url, $matches);
                                    @endphp


                                    <a class="fancyYoutube" title="{{$item->title}}"
                                       href="{{$item->video_url}}">
                                        @if($item->video_url)
                                            <img width="370" height="190" alt=""
                                                 src="{{url("https://img.youtube.com/vi/$matches[0]/0.jpg")}}">
                                        @else
                                            <img width="370" height="190" alt=""
                                                 src="https://placehold.it/370x190">
                                        @endif
                                        <div class="details">
                                            <h4 class="box-title">{{$item->title}}</h4>
                                        </div>
                                    </a>
                                </figure>

                            </article>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info"><p>{{trans("testimonials.no_testimonials_found")}}</p></div>
            @endif
        </div>

    </div>
@endsection
@section("scripts")
    <script>
        (function ($) {
            $("a.fancyYoutube").click(function () {
                $.fancybox({
                    'padding': 0,
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'title': this.title,
                    'width': 680,
                    'height': 495,
                    'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                    'type': 'swf',
                    'swf': {
                        'wmode': 'transparent',
                        'allowfullscreen': 'true'
                    }
                });

                return false;
            });

        })(jQuery)

    </script>
@stop
