@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("hotels",$localeCode)}}"/>
        @endif
    @endforeach
    <!--next and prev meta-->
    @if($hotels->nextPageUrl())
        <link rel="next" href="{{$hotels->nextPageUrl()}}">
    @endif
    @if($hotels->previousPageUrl())
        <link rel="prev" href="{{$hotels->previousPageUrl()}}">
    @endif
@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("hotels.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("hotels.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">

        <div class="content">
            <div class="col-md-9">
                @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                    <div class="addthis_inline_share_toolbox"></div> @endif
                <div class="hotel-list">
                    @if($data)
                        <div class="row image-box hotel listing-style1">
                            @foreach($data as $country)
                                <div class="col-sm-6 col-md-4">
                                    <article class="box" style="min-height: 100px">


                                        <figure>

                                            <a href="{{\LaravelLocalization::localizeURL("country/$country->id/".make_slug($country->name)."/hotels")}}">
                                                @if(isset($country->photo) && Storage::disk('public')->exists(config('settings.upload_dir')."/".$country->photo))
                                                    <img width="270" height="160" alt="" class="lazy"
                                                         src="{{url("files/{$country->photo}?size=270,160&encode=jpg")}}"
                                                         alt="{{$country->name}}"/></a>
                                            @endif
                                        </figure>

                                        <div class="details">
                                            @if($country->price)
                                                <span class="price">
                                                    <small>avg/night</small>
                                                    {{$country->price}}
                                                </span>
                                            @endif
                                            <h4 class="box-title"><a
                                                        href="{{\LaravelLocalization::localizeURL("country/$country->id/".make_slug($country->name)."/hotels")}}">{{trans("hotels.country_cities_hotels_item",['city'=>$country->name])}}</a>
                                                <small>
                                                    <a href="{{\LaravelLocalization::localizeURL("country/$country->id/".make_slug($country->name))}}">{{$country->name}}</a>
                                                </small>
                                            </h4>

                                            <div class="action">
                                                <a class="button btn-small"
                                                   href="{{\LaravelLocalization::localizeURL("country/$country->id/".make_slug($country->name)."/hotels")}}">{{trans("cities.btn_show_hotels")}}</a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">{{trans("hotels.no_results_found")}}</div>
                    @endif
                </div>
                {{ $data->links() }}

                <br>


                <div class="row">

                    <center>
                        <h2 style="border-top: 1px solid; padding: 10px;">{{trans('hotels.text_all_hotels_list')}}</h2>
                    </center>

                    <div class="hotel-list">
                        @if($hotels)
                            <div class="row image-box hotel listing-style1">
                                @foreach($hotels as $hotel)
                                    <div class="col-sm-6 col-md-4 grid-item">
                                        <article class="box">
                                            <figure>
                                                <a href="{{\LaravelLocalization::localizeURL("$locale/hotels/ajax/{$hotel->id}/gallery")}}"
                                                   class="hover-effect popup-gallery"><img
                                                            width="270" height="160" alt=""
                                                            class="img-responsive lazy"
                                                            src="{{url("files/{$hotel->photo}?size=270,160&encode=jpg")}}"></a>
                                            </figure>
                                            <div class="details">
                                                @if($hotel->price)

                                                    <span class="price">
                                                <small>{{trans("hotels.price_avg_night")}}</small>
                                                        {{((int)settings('currency_on_right ')==1?"":settings("{$locale}_currency"))}}
                                                        {{$hotel->offer_price?:$hotel->price}}
                                                        {{((int)settings('currency_on_right ')==1?settings("{$locale}_currency"):"")}}
                                    </span>
                                                @endif
                                                <h4 class="box-title"><a
                                                            href="{{\LaravelLocalization::localizeURL("hotels/$hotel->id/".make_slug($hotel->name))}}">{{$hotel->name}}</a>
                                                    <small>{{$hotel->city->name}}</small>
                                                </h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip"
                                                         class="five-stars-container" title="4 stars"><span
                                                                style="width: {{$hotel->stars*20}}%;"
                                                                class="five-stars"></span>
                                                    </div>

                                                </div>
                                                <p class="description">
                                                    {!! str_limit(strip_tags($hotel->description),200) !!}
                                                </p>
                                                <div class="action">
                                                    <a class="button btn-small"
                                                       href="{{\LaravelLocalization::localizeURL("hotels/$hotel->id/".make_slug($hotel->name))}}">{{trans("hotels.btn_details")}}</a>
                                                    @if($hotel->map)
                                                        <a class="button btn-small yellow popup-map" href="#"
                                                           data-box="{{$hotel->map}}">{{trans("hotels.btn_show_in_map")}}</a>
                                                    @endif
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning">{{trans("hotels.no_results_found")}}</div>
                        @endif
                    </div>
                    {{ $hotels->links() }}
                </div>
            </div>
            <div class="sidebar col-md-3">

                @if(settings('show_help_box'))
                    <div class="travelo-box contact-box">
                        <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                        <p> {!! settings("{$locale}_help_box_details") !!}</p>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection