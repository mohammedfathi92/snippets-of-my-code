@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("hotels.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("hotels.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">

        <div class="content">
            <div class="col-md-9">
            @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code"))) <div class="addthis_inline_share_toolbox"></div> @endif
            <div class="hotel-list">
                @if($data)
                    <div class="row image-box hotel listing-style1">
                        @foreach($data as $hotel)
                            <div class="col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a href="{{url("$locale/hotels/ajax/{$hotel->id}/gallery")}}"
                                           class="hover-effect popup-gallery"><img
                                                    width="270" height="160" alt=""
                                                    class="img-responsive lazy" src="{{url("files/{$hotel->photo}?size=270,160&encode=jpg")}}"></a>
                                    </figure>
                                    <div class="details">
                                        @if($hotel->price)

                                            <span class="price">
                                                <small>{{trans("hotels.price_avg_night")}}</small>
                                        {{((int)Settings::get('currency_on_right ')==1?"":Settings::get("{$locale}_currency"))}}
                                                {{$hotel->offer_price?:$hotel->price}}
                                                {{((int)Settings::get('currency_on_right ')==1?Settings::get("{$locale}_currency"):"")}}
                                    </span>
                                        @endif
                                        <h4 class="box-title"><a href="{{url("hotels/$hotel->id/".str_slug($hotel->{"name:en"}))}}">{{$hotel->name}}</a>
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
                                               href="{{url("hotels/$hotel->id/".str_slug($hotel->{"name:en"}))}}">{{trans("hotels.btn_details")}}</a>
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
            {{ $data->links() }}
            </div>
            <div class="sidebar col-md-3">

                @if(Settings::get('show_help_box'))
                    <div class="travelo-box contact-box">
                        <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                        <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection