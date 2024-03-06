@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("packages/{$package->id}/".make_slug($package->name),$localeCode)}}"/>
        @endif
    @endforeach

@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{$package->name}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{\LaravelLocalization::localizeURL("/packages/type/{$package->type->id}/".make_slug($package->type->name))}}">{{$package->type->name}}</a>
                </li>
                <li class="active">{{$package->name}}</li>
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
                                              href="{{\LaravelLocalization::localizeURL("/booking/package/{$package->id}/".make_slug($package->name))}}">{{trans("packages.btn_package_booking")}}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="photos-tab" class="tab-pane fade in active">
                        <div class="photo-gallery style1" data-animation="slide"
                             data-sync="#photos-tab .image-carousel">
                            <ul class="slides">
                                @foreach($gallery as $image)
                                    <li><img class="img-responsive lazy"
                                             src="{{url("files/{$image->name}?size=900,500&encode=jpg")}}"
                                             alt="{{$package->name}}"/></li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="image-carousel style1" data-animation="slide" data-item-width="70"
                             data-item-margin="10"
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
                                          data-toggle="tab"><i
                                    class="glyphicon glyphicon-align-center"></i> {{trans("packages.tab_description")}}
                        </a></li>
                    <li><a href="javascript:;" data-target="#package-hotels"
                           data-toggle="tab"><i class="soap-icon-hotel-1"></i> {{trans("packages.tab_hotels")}}
                        </a></li>
                    <li><a href="javascript:;" data-target="#package-flights"
                           data-toggle="tab"><i class="glyphicon glyphicon-plane"></i> {{trans("packages.tab_flights")}}
                        </a></li>
                    <li><a href="javascript:;" data-target="#package-transports"
                           data-toggle="tab"> <i class="soap-icon-pickanddrop"></i> {{trans("packages.tab_transports")}}</a>
                    </li>

                    @if($faq->count())

                        <li><a href="javascript:;" data-target="#tab-faq"
                               data-toggle="tab">{{trans("hotels.tab_faq")}}</a>
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
                                            <td><label>{{trans("packages.label_package_duration")}}
                                                    :</label></td>
                                            <td>{{trans("packages.nights_count",['count'=>$package->days -1])}}
                                                - {{trans("packages.days_count",['count'=>$package->days])}}</td>
                                        </tr>
                                        <tr>
                                            <td><label>{{trans("packages.label_package_price")}}
                                                    :</label></td>
                                            <td> {{((int)settings('currency_on_right ')==1?"":settings("{$locale}_currency"))}}
                                                {{$package->offer_price?:$package->price}}
                                                {{((int)settings('currency_on_right ')==1?settings("{$locale}_currency"):"")}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>{{trans("packages.label_people_count")}}
                                                    :</label></td>
                                            <td>
                                                {{trans("packages.adults_count",['count'=>$package->adults_count])}}
                                                @if($package->childrens_count)
                                                    - {{trans("packages.childrens_count",['count'=>$package->childrens_count])}}
                                                @endif
                                                @if($package->babies_count)
                                                    - {{trans("packages.babies_count",['count'=>$package->babies_count])}}
                                                @endif
                                            </td>
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
                            <h2 class="panel-heading"><i
                                        class="soap-icon-hotel-1"></i> {{trans("packages.tab_title_hotels")}}</h2>
                            @include('frontend.packages.components.hotels',['package'=>$package])
                            <div class="clearfix"></div>
                        </div>

                        <div class="panel panel-primary">
                            <h2 class="panel-heading"><i
                                        class="glyphicon glyphicon-plane"></i> {{trans("packages.title_package_flights_and_transports")}}
                            </h2>
                            @php $flightData=\Sirb\Flight::where('package_id',$package->id)->orderBy('packages_flights.order', 'asc')->get(); @endphp

                            @if($flightData->count())
                                @include("frontend.packages.components.flights",['flights'=>$flightData])
                            @else
                                <div class="alert alert-info">
                                    <p>{{trans("packages.info_package_flights_not_included")}}</p>
                                </div>
                            @endif
                        </div>
                        <div class="panel panel-primary">
                            <h2 class="panel-heading"><i
                                        class="soap-icon-pickanddrop"></i> {{trans("packages.tab_title_transports")}}</h2>
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
                                                            <h4 class="blue-color"> <a
                                                                        href="{{route("city.details",['id'=>$transport->city->id,'slug'=>$transport->city->name])}}"
                                                                        class="label label-info">{{$transport->city->name}}</a> - {{$transport->name}}
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
                        @include('frontend.packages.components.hotels',['package'=>$package])

                    </div>
                    <div class="tab-pane fade" id="package-flights">
                        @if($flightData->count())
                            <h2>{{trans("packages.tab_title_flights")}}</h2>
                            @include("frontend.packages.components.flights",['flights'=>$flightData])
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
                                                        <h4 class="blue-color"> <a
                                                                    href="{{route("city.details",['id'=>$transport->city->id,'slug'=>make_slug($transport->city->name)])}}"
                                                                    class="label label-info">{{$transport->city->name}}</a> - {{$transport->name}}
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

            <br>

        </div>
        <div class="sidebar col-md-3">
            @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif

            @if($package->notes)
                <div class="travelo-box book-with-us-box">
                    <h4>{{trans("packages.title_notes")}}</h4>
                    <hr>
                    <p class="description">
                        {!! $package->notes !!}
                    </p>
                </div>
            @endif
                     <article class="detailed-logo">
                {{--<figure>
                    <img width="320" height="80" class="img-responsive lazy"
                         src="{{url("files/{$package->photo}?size=320,150&encode=jpg")}}"
                         alt="{{$package->name}}">
                </figure>--}}
                <div class="details">
                    {{--<h2 class="box-title">{{$package->name}}
                        <small>
                            <a href="{{\LaravelLocalization::localizeURL("/packages/type/{$package->type->id}/".make_slug($package->type->name))}}">{{$package->type->name}}</a>
                        </small>
                    </h2>
                    <span class="price clearfix">
                    <small class="pull-left">{{trans("packages.text_from")}}</small>
                    <span class="pull-right">
                        {{((int)settings('currency_on_right ')==1?"":settings("{$locale}_currency"))}}
                        {{$package->offer_price?:$package->price}}
                        {{((int)settings('currency_on_right ')==1?settings("{$locale}_currency"):"")}}
                    </span>
                </span>
                    @if($package->offer_price)
                        <span class="help-block clearfix">

                    <span class="pull-right ">
                        <del>
                        {{((int)settings('currency_on_right ')==1?"":settings("{$locale}_currency"))}}
                            {{$package->price}}
                            {{((int)settings('currency_on_right ')==1?settings("{$locale}_currency"):"")}}
                            </del>
                    </span>
                </span>
                    @endif
                    <div class="feedback clearfix">
                        <div title="{{trans_choice("packages.package_stars_option",$package->level)}}"
                             class="five-stars-container" data-toggle="tooltip" data-placement="bottom">
                            <span class="five-stars" style="width: {{$package->level*20}}%;"></span></div>

                    </div>
                    --}}{{--<p class="description">
                        {!! str_limit(strip_tags($package->description),200) !!}
                    </p>--}}
                    <div>

                        <a href="{{\LaravelLocalization::localizeURL("booking/package/{$package->id}/".make_slug($package->name))}}"
                           class="button btn-large full-width yellow-bg white-color">{{trans("packages.btn_package_booking")}}</a>
                    </div>
                    <div class="text-center">
                        <hr>
                        <a href="{{\LaravelLocalization::localizeURL(settings("booking_terms_page")?:"#")}}"
                           target="_top"
                           class="btn blue-bg white-color">{{trans("packages.btn_package_booking_terms")}}</a>
                        <a href="{{\LaravelLocalization::localizeURL(settings("booking_terms_payments")?:"#")}}"
                           target="_top"
                           class="btn blue-bg white-color">{{trans("packages.btn_package_booking_payments")}}</a>
                    </div>


                </div>
            </article>
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>
                </div>
            @endif


        </div>
    </div>
    <div class="container">
        <!-- Comments & reviews-->
        @include('frontend.parts.comments_reviews', ['module' => "packages", 'module_data'=>$package])

    </div>

@endsection
