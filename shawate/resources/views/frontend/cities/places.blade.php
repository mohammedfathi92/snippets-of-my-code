@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("places.page_title_city_places",['city'=>$city->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{url("/country/{$city->country->id}/".str_slug($city->country->name))}}">{{$city->country->name}}</a>
                    <a href="{{url("/city/{$city->id}/".str_slug($city->{"name:en"}))}}">{{$city->name}}</a>
                </li>
                <li class="active">{{trans("places.page_title_city_places",['city'=>$city->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">

        <div class="content">
            <div class="col-md-9">
                @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                    <div class="addthis_inline_share_toolbox"></div> @endif
                <div class="hotel-list">
                    @if($places->count())
                        <div class="row image-box hotel listing-style1">
                            @foreach($places as $place)
                                <div class="col-sm-6 col-md-4">
                                    <article class="box">
                                        <figure>
                                            <a href="{{url("$locale/places/ajax/{$place->id}/gallery")}}"
                                               class="hover-effect popup-gallery"><img
                                                        width="270" height="160" alt=""
                                                        class="lazy"
                                                        src="{{url("files/{$place->photo}?size=270,160&encode=jpg")}}"></a>
                                        </figure>
                                        <div class="details">
                                            @if($place->price)
                                                <span class="price">
                                                    <small>avg/night</small>
                                                    {{$place->price}}
                                                </span>
                                            @endif
                                            <h4 class="box-title"><a
                                                        href="{{url("places/{$place->id}/".str_slug($place->{"name:en"}))}}">{{$place->name}}</a>
                                                <small>{{$place->city->name}}</small>
                                            </h4>
                                            <p class="description">
                                                {!! str_limit(strip_tags($place->description),200) !!}
                                            </p>
                                            <div class="action">
                                                <a class="button btn-small"
                                                   href="{{url("places/$place->id/".str_slug($place->{"name:en"}))}}">{{trans("places.btn_show")}}</a>
                                                @if($place->map)
                                                    <a class="button btn-small yellow popup-map" href="#"
                                                       data-box="{{$place->map}}">{{trans("places.btn_show_in_map")}}</a>
                                                @endif
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">{{trans("places.no_results_found")}}</div>
                    @endif
                </div>
                {!! $places->links() !!}
            </div>

            <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                @if($city->generalCategories()->count())
                    <div class="travelo-box filters-container faq-topics">
                        <h4 class="box-title">{!! trans("cities.city_guide_box_title",['city'=>$city->name]) !!}</h4>
                        <ul class="triangle filters-option">
                            @foreach($city->generalCategories as $item)
                                <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                    <a href="{{url("guide/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                                    @if($item->subCategories()->count())
                                        <ul class="list-group">
                                            @foreach($item->subCategories as $subItem)
                                                <li class="list-group-item {{($subItem->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                                    <a href="{{url("guide/{$subItem->id}/".str_slug($subItem->name))}}">{{$subItem->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endif

                @if($city->country->generalCategories()->count())
                    <div class="travelo-box filters-container faq-topics">
                        <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$city->country->name]) !!}</h4>
                        <ul class="triangle filters-option">
                            @foreach($city->country->generalCategories as $item)
                                <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                    <a href="{{url("guide/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endif
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
