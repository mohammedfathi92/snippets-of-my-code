@extends('frontend.layouts.master')

@section("content")
  

    <section class="single-page-header" style="background-image: url('/images/countries-background.jpg'); background-repeat: no-repeat;
    background-size: 1400px 470px;">
        <div class="parallax-content-1 my-layer-img">
            <div class="logo_content">
                <div class="animated fadeInDown">
<h1>
                    <a class="title-header-link" href="/countries">{{trans('countries.header_title_countries_page')}}</a>
                    </h1>
                <p>{{trans('countries.header_description_countries_page')}}</p>
                </div>
            </div>
        </div>

    </section><!-- End section -->

    <main style="margin-top:0px;">
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Page active</li>
                </ul>
            </div>
        </div><!-- Position -->
        <div class="container margin_60">
            <div class="row">
                <aside class="col-lg-3 col-md-3">
                 @include('frontend.includes.help_col')
                </aside><!--End aside -->

                <div class="col-lg-9 col-md-8">

                    @if($countries)
                        <div class="row">
                            @foreach($countries as $country)
                                <div class="col-md-4 col-sm-12 wow zoomIn" data-wow-delay="0.1s">
                                    <div class="hotel_container">

                                        <div class="img_container">
                                            <a href="/countries/{{$country->code}}-{{str_slug($country->{"name:en"})."/cities"}}">
                                                <img src="{{url("files/{$country->photo}?size=410,275")}}" width="800"
                                                     height="533"
                                                     class="img-responsive"
                                                     alt="Image">

                                            </a>
                                        </div>
                                        <div class="hotel_title">
                                            <h3>
                                                <a href="{{url("countries/{$country->code}-".str_slug($country->{"name:en"})."/cities")}}">{{$country->name}}</a>
                                            </h3>
                                        </div>
                                    </div><!-- End box tour -->
                                </div><!-- End col-md-6 -->
                            @endforeach
                        </div><!-- End row -->
                        <hr>

                        <div class="text-center">
                            {!! $countries->links() !!}
                        </div><!-- end pagination-->
                    @else
                        <div class="alert alert-info">{{trans("countries.no_results_found")}}</div>
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