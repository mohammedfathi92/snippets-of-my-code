@extends('frontend.layouts.master')

@section("content")
    <section class="single-page-header" style="background-image: url('{{$country->photo? url("/files/{$country->photo}?size=1400,470") :'/images/page-backgrpund.jpg'}}'); background-repeat: no-repeat;
    background-size: 1400px 470px;">
        <div class="parallax-content-1 my-layer-img">
            <div class="logo_content">
                <div class="animated fadeInDown">

                   <h1>
                        <a class="title-header-link" href="{{url("countries/{$country->code}-".str_slug($country->{"name:en"})."/cities")}}">{{$country->name}}</a>
                    </h1>
                    <p>{!! str_limit(strip_tags($country->description)) !!}</p>
                </div>
                </div>
            </div>
        </div>

    </section><!-- End section -->
    <main style="margin-top:0px;">
        <div id="position">
            <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_home")}}</a></li>
                    <li><a href="/cities">{{trans("cities.link_cities")}}</a></li>
                    <li>{{$country->name}}</li>
                </ul>
            </div>
        </div>
        </div><!-- Position -->
        <div class="container margin_60">
            <div class="row">
                <aside class="col-lg-3 col-md-3">
                   @include('frontend.includes.help_col')
                </aside><!--End aside -->

                <div class="col-lg-9 col-md-8">

                    @if($cities)
                        <div class="row">
                            @foreach($cities as $city)
                                <div class="col-md-4 col-sm-12 wow zoomIn" data-wow-delay="0.1s">
                                    <div class="hotel_container">

                                        <div class="img_container">
                                            <a href="{{url("/city/{$city->id}-".str_slug($city->{"name:en"}))}}">
                                                @if($city->photo)
                                                <img src="{{url("files/{$city->photo}?size=410,275")}}" width="800"
                                                     height="533"
                                                     class="img-responsive"
                                                     alt="Image">
                                                @else
                                                 <img src="/images/no_image.png" width="410"
                                                     height="275"
                                                     class="img-responsive"
                                                     alt="Image">
                                                     @endif    

                                            </a>
                                        </div>
                                        <div class="hotel_title">
                                            <h3>
                                                <a href="{{url("/city/{$city->id}-".str_slug($city->{"name:en"}))}}">{{$city->name}}</a>
                                            </h3>
                                          <!--   <hr>
                                            <span><img src="/images/no_image.png" width="410"
                                                     height="275"
                                                     class="img-responsive"
                                                     alt="Image"><strong>institutes No.: 25</strong></span> -->
                                        </div>
                                    </div><!-- End box tour -->
                                </div><!-- End col-md-6 -->
                            @endforeach
                        </div><!-- End row -->
                        <hr>

                        <div class="text-center">
                            {!! $cities->links() !!}
                        </div><!-- end pagination-->
                    @else
                        <div class="alert alert-info">{{trans("cities.no_results_found")}}</div>
                    @endif


                </div><!-- End col lg 9 -->
            </div><!-- End row -->
        </div><!-- End container -->

    </main>
@endsection
@section("scripts")
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="/assets/js/map_hotels.js"></script>
    <script src="/assets/js/infobox.js"></script>
    <script src="/assets/js/icheck.js"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey',
        });
    </script>
 
@stop