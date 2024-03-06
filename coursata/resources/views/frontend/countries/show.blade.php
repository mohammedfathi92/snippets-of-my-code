@extends('frontend.layouts.master')

@section("content")
    <!-- End section -->
    <main >
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
                    <li><a href="/countries">{{trans("countries.link_countries")}}</a></li>
                    <li>{{$country->name}}</li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="collapse row" id="collapseMap">
            <div id="map" class="map"></div>
        </div><!-- End Map -->

        <div class="container margin_60">

            <div class="row">
                <aside class="col-lg-3 col-md-3">

                    <div id="filters_col">
                        <!--End filters col-->
                       @include('frontend.includes.help_col')
                    </div>
                </aside>

                <!--End aside -->

                <div class="col-lg-9 col-md-9">

                    <div id="tools">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <h3 class="sorted">الترتيب حسب</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="styled-select-filters">
                                    <select name="sort_rating" id="sort_rating">
                                        <option value="" selected>Sort by ranking</option>
                                        <option value="lower">Lowest ranking</option>
                                        <option value="higher">Highest ranking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="text-center cpmarebtn">
                                    <a href="#" class="btn_1 medium">مقارنة</a>
                                </p>
                            </div>

                        </div>
                    </div>
                    <!--/tools -->
                    @if($institutes->count())
                        @foreach($institutes as $institute)
                            <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="wishlist">
                                            <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span
                                                        class="tooltip-content-flip"><span
                                                            class="tooltip-back">{{trans("institutes.btn_add_to_wish_list")}}</span></span></a>
                                        </div>
                                        <div class="img_list">
                                            <a href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}">
                                                <div class="ribbon popular"></div>
                                                <img src="{{url("files/{$institute->photo}?size=293,220&encode=jpg")}}"
                                                     alt="">
                                                <div class="short_info"></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix visible-xs-block"></div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="tour_list_desc">
                                            <div class="score">
                                                <div class="rating" data-toggle="tooltip"
                                                     title="{{trans("institutes.text_locale_rating")}}">
                                                    {{trans("institutes.text_locale_rating")}}
                                                    <i class="{{$institute->locale_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->locale_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->locale_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->locale_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->locale_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                                                </div>
                                                <div class="rating" data-toggle="tooltip"
                                                     title="{{trans("institutes.text_international_rating")}}">
                                                    {{trans("institutes.text_international_rating")}}
                                                    <i class="{{$institute->international_rate >=1?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->international_rate >=2?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->international_rate >=3?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->international_rate >=4?"icon-star voted":"icon-star-empty"}}"></i>
                                                    <i class="{{$institute->international_rate >=5?"icon-star voted":"icon-star-empty"}}"></i>
                                                </div>

                                            </div>

                                            <h3>
                                                <a href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}"><strong>{{$institute->name}}</strong></a>
                                            </h3>
                                            @if($institute->city)
                                                <div class="location">
                                                    <h5>
                                                        <a href="{{url("institutes/{$institute->id}-".str_slug($institute->{"name:en"}))}}">{{$institute->city->name}}</a>
                                                    </h5>
                                                </div>
                                            @endif
                                            <p>{!! str_limit(strip_tags($institute->description),200) !!}</p>
                                            <div class="add_info">
                                                <div class="row">
                                                    @if($institute->services()->groupBy("type")->count())
                                                        @foreach($institute->services()->groupBy("type")->get() as $service)
                                                            <div class="col-md-6 col-xs-6 col-sm-6">
                                                                <div class="CourseIcons ">
                                                                    <a href="javascript:void(0);" class="tooltip-1"
                                                                       data-placement="top"
                                                                       title="{{$service->name}}">
                                                                        @if($service->type=="house")
                                                                            <i class="icon_set_2_icon-115"></i>
                                                                        @elseif($service->type=="transport")
                                                                            <i class="icon-flight"></i>
                                                                        @elseif($service->type=="adviser")
                                                                            <i class="icon_set_1_icon-57"></i>
                                                                        @elseif($service->type=="insurance")
                                                                            <i class=" icon-stethoscope"></i>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="CourseIcons_D">
                                                                    <span>{{$service->name}}</span>
                                                                </div>

                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif

                <!--End strip -->
                    <hr>

                    <div class="text-center">
                        {!! $institutes->links() !!}
                    </div>
                    <!-- end pagination-->

                </div>
                <!-- End col lg-9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>

@endsection
@section("scripts")
   {{-- <script src="/assets/js/modernizr.js"></script>
    <script src="/assets/js/video_header.js"></script>
    <script>

        $(document).ready(function () {

            HeaderVideo.init({
                container: $('.header-video'),
                header: $('.header-video--media'),
                videoTrigger: $("#video-trigger"),
                autoPlayVideo: false
            });

        });
    </script>--}}
@stop