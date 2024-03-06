@extends("frontend.layouts.master")
@section("page_title")
    @include("frontend.home.slider")
@endsection
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("/",$localeCode)}}"/>
        @endif
    @endforeach

@endsection
@section("content")
    <!-- Popuplar Destinations -->
    @if($destinations=\Sirb\Country::publishedAtHome())
        <div class="destinations section">
            <div class="container">
                <h2>{{trans("countries.destinations")}}</h2>
                <div class="row add-clearfix image-box style1 tour-locations">
                    @foreach($destinations as $item)

                        <div class="col-sm-6 col-md-4">
                            <article class="box">
                                <figure>
                                    <a href="{{\LaravelLocalization::localizeURL("country/{$item->id}/".make_slug($item->name))}}"
                                       class="hover-effect">
                                        <img class="lazy img-responsive"
                                             src="{{url("/files/{$item->photo}?size=370,266&encode=jpg")}}"
                                             alt="">
                                    </a>
                                </figure>
                                <div class="details">
                                    <h4 class="box-title">
                                        <a href="{{\LaravelLocalization::localizeURL("country/$item->id/".make_slug($item->name))}}">{{trans("countries.destination_page_title",['name'=>$item->name])}}</a>
                                    </h4>
                                    <hr>
                                    <ul class="features check">
                                        <li>{!! Html::link(\LaravelLocalization::localizeURL("/country/{$item->id}/".make_slug($item->name)."/hotels"),trans("countries.country_hotels_title",['name'=>$item->name])) !!}</li>
                                        <li>{!! Html::link(\LaravelLocalization::localizeURL("/country/{$item->id}/".make_slug($item->name)."/places"),trans("countries.country_places_title",['name'=>$item->name])) !!}</li>
                                        <li>{!! Html::link(\LaravelLocalization::localizeURL("/country/{$item->id}/".make_slug($item->name)."/packages"),trans("countries.country_packages_title",['name'=>$item->name])) !!}</li>

                                    </ul>
                                    <hr>

                                    <a href="{{\LaravelLocalization::localizeURL("country/{$item->id}/".make_slug($item->name))}}"
                                       class="button btn-small full-width">{{trans("main.show_more")}}</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Honeymoon -->

    @include('frontend.home.sections.packages',['packages'=>$packages])
    @include('frontend.home.sections.testimonials_videos',['testimonials'=>$testimonials_videos])
    @include('frontend.home.sections.testimonials_text',['testimonials'=>$testimonials_text])



    @if($news->count())
        <!-- Did you Know? section -->
        <div class="offers section">
            <div class="container">
                    <h1 class="text-center">{{trans("news.frontend_home_section_title")}}</h1>
                            <div class="travelo-box">
                                <div class="suggestions image-carousel style2" data-animation="slide" data-item-width="150" data-item-margin="22">
                                    <ul class="slides">
                                         @foreach($news as $topic)
                                        <li>
                                            <a href="{{\LaravelLocalization::localizeURL("news/$topic->id/".make_slug($topic->name))}}"
                                       title="{{$topic->name}}" class="hover-effect">
                                                <img src="{{url("files/{$topic->photo}?size=270,160&encode=jpg")}}" alt="{{$topic->name}}" class="lazy middle-item" />
                                            </a>
                                            <h5 class="caption">{!! Html::link(\LaravelLocalization::localizeURL("news/$topic->id/".make_slug($topic->name)),$topic->name)!!}</h5>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                </div>
            </div>

        <!-- Features section -->
    @endif
@endsection

@section('scripts')

    <script type="text/javascript">
        tjq(document).ready(function () {
            tjq('.revolution-slider').revolution(
                {
                    sliderType: "standard",
                    sliderLayout: "auto",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "on",
                        touch: {
                            touchenabled: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        }
                        ,
                        arrows: {
                            style: "default",
                            enable: true,
                            hide_onmobile: false,
                            hide_onleave: false,
                            tmp: '',
                            left: {
                                h_align: "left",
                                v_align: "center",
                                h_offset: 20,
                                v_offset: 0
                            },
                            right: {
                                h_align: "right",
                                v_align: "center",
                                h_offset: 20,
                                v_offset: 0
                            }
                        }
                    },
                    visibilityLevels: [1240, 1024, 778, 480],
                    gridwidth: 1170,
                    gridheight: 500,
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner4",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
        });


             tjq(document).ready(function () {

                    tjq("a.fancyYoutube").fancybox();


            });


    </script>
@endsection
