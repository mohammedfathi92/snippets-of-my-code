@extends("frontend.layouts.master")
@section("page_title")
    @include("frontend.home.slider")
@endsection
@section("content")

    <!-- Popuplar Destinations -->
    @if($destinations=\App\Country::publishedAtHome())
        <div class="destinations section">
            <div class="container">
                <h2>{{trans("countries.destinations")}}</h2>
                <div class="row add-clearfix image-box style1 tour-locations">
                    @foreach($destinations as $item)

                        <div class="col-sm-6 col-md-4">
                            <article class="box">
                                <figure>
                                    <a href="{{url("country/{$item->id}/".str_slug($item->{"name:en"}))}}"
                                       class="hover-effect">
                                        <img class="lazy img-responsive" src="{{url("/files/{$item->photo}?size=370,266&encode=jpg")}}"
                                             alt="">
                                    </a>
                                </figure>
                                <div class="details">
                                    <h4 class="box-title">
                                        <a href="{{url("country/$item->id/".str_slug($item->{"name:en"}))}}">{{trans("countries.destination_page_title",['name'=>$item->name])}}</a>
                                    </h4>
                                    <hr>
                                    <ul class="features check">
                                        <li>{!! Html::link("/country/{$item->id}/".str_slug($item->{"name:en"})."/hotels",trans("countries.country_hotels_title",['name'=>$item->name])) !!}</li>
                                        <li>{!! Html::link("/country/{$item->id}/".str_slug($item->{"name:en"})."/places",trans("countries.country_places_title",['name'=>$item->name])) !!}</li>
                                        <li>{!! Html::link("/country/{$item->id}/".str_slug($item->{"name:en"})."/packages",trans("countries.country_packages_title",['name'=>$item->name])) !!}</li>

                                    </ul>
                                    <hr>

                                    <a href="{{url("country/{$item->id}/".str_slug($item->{"name:en"}))}}"
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
    @php
        $packages=\App\Package::inHome();
    @endphp
    @if($packages->count())

        <div class="honeymoon section global-map-area promo-box parallax" data-stellar-background-ratio="0.5"
             @if(Settings::get('home_packages_section_background')) style="background: url('{{Storage::url(Settings::get('home_packages_section_background'))}}') !important;" @endif >
            <div class="container">
                <div class="col-sm-6 content-section description pull-right">
                    <h1 class="title">{{trans("packages.frontend_home_section_title")}}</h1>
                    {{--<p>Nunc cursus libero purusac congue arcu cursus utsed vitae pulvinar massa idporta neque
                        purusac
                        Etiam elerisque mi id faucibus iaculis vitae pulvinar.</p>--}}
                    <div class="row places image-box style9">
                        @foreach($packages->get() as $package)
                            <div class="col-md-4 col-sm-6">
                                <article class="box">
                                    <figure>
                                        <a href="{{url("packages/$package->id/".str_slug($package->{"name:en"}))}}"
                                           title="{{$package->name}}"
                                           class="hover-effect yellow middle-block animated"
                                           data-animation-type="fadeInUp"
                                           data-animation-duration="1">
                                            <img class="lazy img-responsive"
                                                 src="{{url("/files/{$package->photo}?size=175,175&encode=jpg")}}"
                                                 alt="{{$package->name}}"/></a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">{!! Html::link("packages/$package->id/".str_slug($package->{"name:en"}),$package->name) !!}
                                            <small>${{$package->price}}</small>
                                        </h4>
                                        <a href="{{url("packages/$package->id/".str_slug($package->{"name:en"}))}}"
                                           title=""
                                           class="button">{{trans("packages.btn_show_more")}}</a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6 image-container no-margin">
                    @if(Settings::get('home_packages_section_photo'))
                        <img class="lazy animated img-responsive" src="{{Storage::url(Settings::get('home_packages_section_photo'))}}" alt=""
                              data-animation-type="fadeInUp"
                             data-animation-duration="2">
                    @endif
                </div>
            </div>
        </div>

    @endif
    @php
        $testimonials=\App\Testimonial::whereType('video')->inHome();
    @endphp
    @if($testimonials->count())
        <div class="container">

            <div class="items-container isotope row image-box style9">
                <div class="box">
                    <h3 class="text-center">{{trans("testimonials.title_testimonials")}}</h3>
                    @foreach($testimonials->get() as $item)
                        @if($item->video_url)
                            <div class="iso-item col-xs-12 col-sms-6 col-sm-6 col-md-3 filter-all filter-island filter-beach">
                                <article class="box">
                                    <figure>
                                        @php
                                            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $item->video_url, $matches);
                                        @endphp


                                        <a class="fancyYoutube" title="{{$item->title}}"
                                           href="{{$item->video_url}}">
                                            @if(isset($matches[0]))
                                                <img class="img-responsive" alt=""
                                                     src="{{url("https://img.youtube.com/vi/$matches[0]/0.jpg")}}">
                                            @else
                                                <img width="370" height="190" alt=""
                                                     src="https://placehold.it/370x190">
                                            @endif
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">{{$item->title}}</h4>
                                    </div>
                                </article>
                            </div>
                        @endif
                    @endforeach
                    <div class="clearfix"></div>
                    <a href="/testimonials/videos"
                       class="btn btn-primary">{{trans("testimonials.btn_home_show_more_videos")}} </a>
                    <a href="/testimonials"
                       class="btn btn-primary">{{trans("testimonials.btn_home_show_more_text")}} </a>
                </div>
            </div>
        </div>
    @endif
    @php
        $news=\App\News::inHome();
    @endphp
    @if($news->count())
        <!-- Did you Know? section -->
        <div class="offers section">
            <div class="container">
                <h1 class="text-center">{{trans("news.frontend_home_section_title")}}</h1>
                <div class="row image-box style2">
                    @foreach($news->get() as $topic)
                        <div class="col-md-4 col-sm-6">
                            <article class="box">
                                <div class="animated col-md-4 col-sm-12" data-animation-type="fadeInLeft"
                                     data-animation-duration="1">
                                    <a href="{{url("news/$topic->id/".str_slug($topic->name))}}"
                                       title="{{$topic->name}}">
                                        <img class="lazy img-responsive" src="{{url("files/{$topic->photo}?size=250,188&encode=jpg")}}"
                                             alt=""
                                             width="270"
                                             height="192"/></a>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <h4>{!! Html::link("news/$topic->id/".str_slug($topic->{"name:en"}),$topic->name)!!}</h4>
                                    <p>{!! str_limit(strip_tags($topic->description),200) !!}</p>
                                    <a href="{{url("news/$topic->id/".str_slug($topic->{"name:en"}))}}" title=""
                                       class="button">{{trans("news.btn_show_more")}}</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
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
        (function ($) {
            $(document).ready(function () {
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
            });

        })(jQuery)

    </script>
@endsection