@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{$package->name}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{url("/packages/type/{$package->type->id}/".str_slug($package->type->name))}}">{{$package->type->name}}</a>
                </li>
                <li class="active">{{$package->name}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="col-md-9">

        @php
            $faq=$country->faq()->get();
            $gallery=$package->gallery()->get();
        @endphp
        <div class="tab-container style1" id="cruise-main-content">
            <ul class="tabs">
                <li class="active"><a data-toggle="tab" href="#"
                                      data-target="#photos-tab">{{trans("packages.tab_photos")}}</a></li>
                @if($package->embed_video)
                    <li class=""><a data-toggle="tab" href="#"
                                    data-target="#video-tab">{{trans("packages.tab_video")}}</a></li>
                @endif
                <li class="pull-right"><a class="button btn-small yellow-bg white-color"
                                          href="{{url("/booking/package/{$package->id}/".str_slug($package->{"name:en"}))}}">{{trans("packages.btn_package_booking")}}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="photos-tab" class="tab-pane fade in active">
                    <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                        <ul class="slides">
                            @foreach($gallery as $image)
                                <li><img class="img-responsive lazy"
                                         src="{{url("files/{$image->name}?size=900,500&encode=jpg")}}"
                                         alt="{{$package->name}}"/></li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10"
                         data-sync="#photos-tab .photo-gallery">
                        <ul class="slides">
                            @foreach($gallery as $image)
                                <li><img class="img-responsive lazy"
                                         src="{{url("files/{$image->name}?size=70,70&encode=jpg")}}"
                                         alt="{{$package->name}}"/></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="video-tab" class="tab-pane fade">
                    {!! $package->embed_video !!}
                </div>
            </div>
        </div>

        <div id="cruise-features" class="tab-container">
            <ul class="tabs">
                <li class="active"><a href="javascript:;" data-target="#cruise-description"
                                      data-toggle="tab">{{trans("packages.tab_description")}}</a></li>
                <li><a href="javascript:;" data-target="#package-hotels"
                       data-toggle="tab">{{trans("packages.tab_hotels")}}</a></li>
                <li><a href="javascript:;" data-target="#package-flights"
                       data-toggle="tab">{{trans("packages.tab_flights")}}</a></li>
                <li><a href="javascript:;" data-target="#package-transports"
                       data-toggle="tab">{{trans("packages.tab_transports")}}</a></li>

                @if($faq->count())

                    <li><a href="javascript:;" data-target="#tab-faq" data-toggle="tab">{{trans("hotels.tab_faq")}}</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="cruise-description">
                    <div class="intro table-wrapper full-width hidden-table-sms">


                        <div class="col-sm-12 table-cell cruise-itinerary">
                            <div class="travelo-box">

                                <table>
                                    <tbody>
                                    <tr>
                                        <td><label>{{trans("packages.label_package_nights")}}
                                                :</label></td>
                                        <td>{{trans("packages.nights_count",['count'=>$package->days])}}</td>
                                    </tr>
                                    <tr>
                                        <td><label>{{trans("packages.label_package_price")}}
                                                :</label></td>
                                        <td> {{((int)Settings::get('currency_on_right ')==1?"":Settings::get("{$locale}_currency"))}}
                                            {{$package->offer_price?:$package->price}}
                                            {{((int)Settings::get('currency_on_right ')==1?Settings::get("{$locale}_currency"):"")}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>{{trans("packages.label_people_count")}}
                                                :</label></td>
                                        <td> {{trans_choice("packages.persons_choice",$package->people_count,['count'=>$package->people_count])}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="long-description">
                        {!! $package->description !!}
                    </div>
                    <hr>
                    <div class="panel panel-primary">
                        <h2 class="panel-heading">{{trans("packages.tab_title_hotels")}}</h2>
                        <div class="room-list listing-style3 hotel">
                            @foreach($package->rooms as $room)
                                <article class="box">
                                    <figure class="col-sm-4 col-md-3">
                                        <a class="hover-effect popup-gallery"
                                           href="{{url("hotels/ajax/{$room->hotel->id}/gallery")}}"><img
                                                    class="img-responsive lazy"
                                                    src="{{url("files/{$room->hotel->photo}?size=230,160&encode=jpg")}}"
                                                    alt="{{$room->hotel->name}}"></a>
                                    </figure>
                                    <div class="details col-xs-12 col-sm-8 col-md-9">
                                        <div>
                                            <div>
                                                <div class="box-title">
                                                    <h4 class="title"><a
                                                                href="{{url("hotels/{$room->hotel->id}/".str_slug($room->hotel->name))}}"
                                                                target="_blank">{{$room->hotel->name}}</a></h4>
                                                    <div class="feedback">
                                                        <div data-placement="bottom" data-toggle="tooltip"
                                                             class="five-stars-container" title="4 stars"><span
                                                                    style="width: {{$room->hotel->stars*20}}%;"
                                                                    class="five-stars"></span>
                                                        </div>

                                                    </div>
                                                    <dl class="description">
                                                        <dt>
                                                            <a href="{{url("city/{$room->city->id}/".str_slug($room->city->name))}}"
                                                               target="_blank">{{$room->city->name}}</a></dt>
                                                        <dd>{{trans("packages.text_room")}} : <a href="#"
                                                                                                 class="popup-gallery"
                                                                                                 data-url="{{url("rooms/ajax/{$room->id}/gallery")}}"
                                                                                                 target="_blank">{{$room->name}}</a>
                                                        </dd>
                                                        <dt>{{trans("packages.text_days")}}
                                                            : {{trans("packages.nights_count",['count'=>$room->pivot->days])}}</dt>
                                                        {{--<dd>{{trans("packages.text_persons")}}
                                                            : {{$room->persons}}</dd>--}}
                                                    </dl>
                                                </div>
                                                {{--@if($room->hotel->services()->count())
                                                    <div class="amenities">
                                                        @foreach($room->hotel->services as $service)
                                                            <i class="{{$service->icon_class}} circle"
                                                               title="{{$service->name}}" data-toggle="tooltip"></i>
                                                        @endforeach
                                                    </div>
                                                @endif--}}
                                            </div>

                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                    </div>
                    <div class="panel panel-primary">
                        <h2 class="panel-heading">{{trans("packages.title_package_flights_and_transports")}}</h2>
                        @php $flightData=\App\Flight::where('package_id',$package->id)->get(); @endphp

                        @if($flightData->count())
                            <h2>{{trans("packages.tab_title_flights")}}</h2>
                            @foreach($flightData as $flight)
                                <div class="panel panel-default">
                                    <article class="travelo-box book-with-us-box">
                                        <figure class="col-sm-4 col-md-3">
                                            <img class="img-responsive lazy img-thumbnail"
                                                 src="{{url("files/{$flight->flight->photo}?size=150,90")}}"
                                                 alt="{{$flight->flight->name}}">
                                        </figure>
                                        <div class="details col-xs-12 col-sm-8 col-md-9">
                                            <div>
                                                <div>
                                                    <div class="box-title">
                                                        <h4 class="title">{{$flight->flight->name}}</h4>

                                                        {{--{{dd($flight)}}--}}
                                                        <div class="description">
                                                            <div class="row">
                                                                <span class="col-md-2 label label-info">{!! trans("packages.flight_from") !!}</span>
                                                                <span class="col-md-10">

                                                                {!! Html::link(route("country.details",['id'=>$flight->from_country_id,'slug'=>$flight->fromCountry->{"name:en"}]),$flight->fromCountry->name) !!}
                                                                    -
                                                                    {!! Html::link(route("city.details",['id'=>$flight->from_city_id,'slug'=>$flight->fromCity->{"name:en"}]),$flight->fromCity->name) !!}</span>
                                                            </div>
                                                            <div class="row">
                                                                <span class="col-md-2 label label-info">{!! trans("packages.flight_to") !!}</span>
                                                                <span class="col-md-10">
                                                                {!! Html::link(route("country.details",['id'=>$flight->to_country_id,'slug'=>$flight->toCountry->{"name:en"}]),$flight->toCountry->name) !!}
                                                                    -
                                                                    {!! Html::link(route("city.details",['id'=>$flight->to_city_id,'slug'=>$flight->toCity->{"name:en"}]),$flight->toCity->name) !!}</span>
                                                            </div>
                                                            {!! $flight->flight->description !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </article>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <p>{{trans("packages.info_package_flights_not_included")}}</p>
                            </div>
                        @endif
                    </div>
                    <div class="panel panel-primary">
                        <h2 class="panel-heading">{{trans("packages.tab_title_transports")}}</h2>
                        @if($package->transports()->count())

                            @foreach($package->transports as $transport)
                                <div class="panel panel-default">
                                    <article class="travelo-box book-with-us-box">
                                        <figure class="col-sm-4 col-md-3">
                                            <img class="img-responsive lazy img-thumbnail"
                                                 src="{{url("files/{$transport->photo}?size=150,90&encode=jpg")}}"
                                                 alt="{{$transport->name}}">
                                        </figure>
                                        <div class="details col-xs-12 col-sm-8 col-md-9">
                                            <div>
                                                <div>
                                                    <div class="box-title">
                                                        <h4 class="blue-color">{{$transport->name}} - <a
                                                                    href="{{route("city.details",['id'=>$transport->city->id,'slug'=>$transport->city->{"name:en"}])}}"
                                                                    class="label label-info">{{$transport->city->name}}</a>
                                                        </h4>

                                                        <div class="description" style="color: #000;">
                                                            {!! $transport->description !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </article>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <p>{{trans("packages.info_package_transports_not_included")}}</p>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="tab-pane fade" id="package-hotels">
                    <div class="room-list listing-style3 hotel">
                        @foreach($package->rooms as $room)
                            <article class="box">
                                <figure class="col-sm-4 col-md-3">
                                    <a class="hover-effect popup-gallery"
                                       href="{{url("hotels/ajax/{$room->hotel->id}/gallery")}}"><img
                                                class="img-responsive lazy"
                                                src="{{url("files/{$room->hotel->photo}?size=230,160&encode=jpg")}}"
                                                alt="{{$room->hotel->name}}"></a>
                                </figure>
                                <div class="details col-xs-12 col-sm-8 col-md-9">
                                    <div>
                                        <div>
                                            <div class="box-title">
                                                <h4 class="title"><a
                                                            href="{{url("hotels/{$room->hotel->id}/".str_slug($room->hotel->name))}}"
                                                            target="_blank">{{$room->hotel->name}}</a></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip"
                                                         class="five-stars-container" title="4 stars"><span
                                                                style="width: {{$room->hotel->stars*20}}%;"
                                                                class="five-stars"></span>
                                                    </div>

                                                </div>
                                                <dl class="description">
                                                    <dt>
                                                        <a href="{{url("city/{$room->city->id}/".str_slug($room->city->name))}}"
                                                           target="_blank">{{$room->city->name}}</a></dt>
                                                    <dd>{{trans("packages.text_room")}} : <a href="#"
                                                                                             class="popup-gallery"
                                                                                             data-url="{{url("rooms/ajax/{$room->id}/gallery")}}"
                                                                                             target="_blank">{{$room->name}}</a>
                                                    </dd>
                                                    <dt>{{trans("packages.text_days")}}
                                                        : {{trans("packages.nights_count",['count'=>$room->pivot->days])}}</dt>
                                                    <dd>{{trans("packages.text_persons")}}
                                                        : {{$room->persons}}</dd>
                                                </dl>
                                            </div>
                                            {{--@if($room->hotel->services()->count())
                                                <div class="amenities">
                                                    @foreach($room->hotel->services as $service)
                                                        <i class="{{$service->icon_class}} circle"
                                                           title="{{$service->name}}" data-toggle="tooltip"></i>
                                                    @endforeach
                                                </div>
                                            @endif--}}
                                        </div>

                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane fade" id="package-flights">
                    @if($flightData->count())
                        <h2>{{trans("packages.tab_title_flights")}}</h2>
                        @foreach($flightData as $flight)
                            <div class="panel panel-default">
                                <article class="travelo-box book-with-us-box">
                                    <figure class="col-sm-4 col-md-3">
                                        <img class="img-responsive lazy img-thumbnail"
                                             src="{{url("files/{$flight->flight->photo}?size=150,90")}}"
                                             alt="{{$flight->flight->name}}">
                                    </figure>
                                    <div class="details col-xs-12 col-sm-8 col-md-9">
                                        <div>
                                            <div>
                                                <div class="box-title">
                                                    <h4 class="title">{{$flight->flight->name}}</h4>

                                                    {{--{{dd($flight)}}--}}
                                                    <div class="description">
                                                        <div class="row">
                                                            <span class="col-md-2 label label-info">{!! trans("packages.flight_from") !!}</span>
                                                            <span class="col-md-10">

                                                                {!! Html::link(route("country.details",['id'=>$flight->from_country_id,'slug'=>$flight->fromCountry->{"name:en"}]),$flight->fromCountry->name) !!}
                                                                -
                                                                {!! Html::link(route("city.details",['id'=>$flight->from_city_id,'slug'=>$flight->fromCity->{"name:en"}]),$flight->fromCity->name) !!}</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="col-md-2 label label-info">{!! trans("packages.flight_to") !!}</span>
                                                            <span class="col-md-10">
                                                                {!! Html::link(route("country.details",['id'=>$flight->to_country_id,'slug'=>$flight->toCountry->{"name:en"}]),$flight->toCountry->name) !!}
                                                                -
                                                                {!! Html::link(route("city.details",['id'=>$flight->to_city_id,'slug'=>$flight->toCity->{"name:en"}]),$flight->toCity->name) !!}</span>
                                                        </div>
                                                        {!! $flight->flight->description !!}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </article>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            <p>{{trans("packages.info_package_flights_not_included")}}</p>
                        </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="package-transports">
                    @if($package->transports()->count())
                        <h2>{{trans("packages.tab_title_transports")}}</h2>
                        @foreach($package->transports as $transport)
                            <div class="panel panel-default">
                                <article class="travelo-box book-with-us-box">
                                    <figure class="col-sm-4 col-md-3">
                                        <img class="img-responsive lazy img-thumbnail"
                                             src="{{url("files/{$transport->photo}?size=150,90&encode=jpg")}}"
                                             alt="{{$transport->name}}">
                                    </figure>
                                    <div class="details col-xs-12 col-sm-8 col-md-9">
                                        <div>
                                            <div>
                                                <div class="box-title">
                                                    <h4 class="blue-color">{{$transport->name}} - <a
                                                                href="{{route("city.details",['id'=>$transport->city->id,'slug'=>$transport->city->{"name:en"}])}}"
                                                                class="label label-info">{{$transport->city->name}}</a>
                                                    </h4>
                                                    <div class="description" style="color: #000;">
                                                        {!! $transport->description !!}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </article>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            <p>{{trans("packages.info_package_transports_not_included")}}</p>
                        </div>
                    @endif
                </div>

                @if($faq->count())
                    <div class="tab-pane fade" id="tab-faq">
                        <div class="travelo-box question-list">
                            <div class="toggle-container">
                                @foreach($faq as $faqCategory)
                                    @foreach($faqCategory->questions as $q)
                                        <div class="panel style1">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#question{{$loop->index}}"
                                                   aria-expanded="{{ $loop->index==0?"true":"false" }}"
                                                   class="collapsed">{{$q->question}}</a>
                                            </h4>
                                            <div id="question{{$loop->index}}"
                                                 class="panel-collapse collapse {{ $loop->index==0?"in":"" }}">
                                                <div class="panel-content">
                                                    {!! $q->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <div class="sidebar col-md-3">
        @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
            <div class="addthis_inline_share_toolbox"></div> @endif
        <article class="detailed-logo">
            <figure>
                <img width="320" height="80" class="img-responsive lazy"
                     src="{{url("files/{$package->photo}?size=320,150&encode=jpg")}}"
                     alt="{{$package->name}}">
            </figure>
            <div class="details">
                <h2 class="box-title">{{$package->name}}
                    <small>
                        <a href="{{url("/packages/type/{$package->type->id}/".str_slug($package->type->name))}}">{{$package->type->name}}</a>
                    </small>
                </h2>
                <span class="price clearfix">
                    <small class="pull-left">{{trans("packages.text_from")}}</small>
                    <span class="pull-right">
                        {{((int)Settings::get('currency_on_right ')==1?"":Settings::get("{$locale}_currency"))}}
                        {{$package->offer_price?:$package->price}}
                        {{((int)Settings::get('currency_on_right ')==1?Settings::get("{$locale}_currency"):"")}}
                    </span>
                </span>
                @if($package->offer_price)
                    <span class="help-block clearfix">

                    <span class="pull-right ">
                        <del>
                        {{((int)Settings::get('currency_on_right ')==1?"":Settings::get("{$locale}_currency"))}}
                            {{$package->price}}
                            {{((int)Settings::get('currency_on_right ')==1?Settings::get("{$locale}_currency"):"")}}
                            </del>
                    </span>
                </span>
                @endif
                <div class="feedback clearfix">
                    <div title="{{trans_choice("packages.package_stars_option",$package->level)}}"
                         class="five-stars-container" data-toggle="tooltip" data-placement="bottom">
                        <span class="five-stars" style="width: {{$package->level*20}}%;"></span></div>

                </div>
                {{--<p class="description">
                    {!! str_limit(strip_tags($package->description),200) !!}
                </p>--}}
                <div>

                    <a href="{{url("booking/package/{$package->id}/".str_slug($package->{"name:en"}))}}"
                       class="button btn-large full-width yellow-bg white-color">{{trans("packages.btn_package_booking")}}</a>
                </div>
                <div class="text-center">
                    <hr>
                    <a href="{{url(Settings::get("booking_terms_page")?:"#")}}"
                       class="btn blue-bg white-color">{{trans("packages.btn_package_booking_terms")}}</a>
                    <a href="{{url(Settings::get("booking_terms_payments")?:"#")}}"
                       class="btn blue-bg white-color">{{trans("packages.btn_package_booking_payments")}}</a>
                </div>


            </div>
        </article>
        @if($package->notes)
            <div class="travelo-box book-with-us-box">
                <h4>{{trans("packages.title_notes")}}</h4>
                <p class="description">
                    {!! $package->notes !!}
                </p>
            </div>
        @endif
        @if(Settings::get('show_help_box'))
            <div class="travelo-box contact-box">
                <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
            </div>
        @endif


    </div>
@endsection