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
                    <a href="{{url("/city/{$city->id}/".str_slug($city->name))}}">{{$city->name}}</a>
                </li>
                <li class="active">{{trans("places.page_title_city_places",['city'=>$city->name])}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">

        <div class="content">
            @if(Settings::get("show_share_buttons")) <div class="addthis_inline_share_toolbox"></div> @endif
            <div class="institute-list">
                @if($places)
                    <div class="row image-box institute listing-style1">
                        @foreach($places as $place)
                            <div class="col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a href="{{url("$locale/places/ajax/{$place->id}/gallery")}}"
                                           class="hover-effect popup-gallery"><img
                                                    width="270" height="160" alt=""
                                                    src="{{url("files/{$place->photo}?size=270,160&encode=jpg")}}"></a>
                                    </figure>
                                    <div class="details">
                                        @if($place->price)
                                            <span class="price">
                                                    <small>avg/night</small>
                                                {{$place->price}}
                                                </span>
                                        @endif
                                        <h4 class="box-title">{{$place->name}}
                                            <small>{{$place->city->name}}</small>
                                        </h4>
                                        <p class="description">
                                            {!! str_limit(strip_tags($place->description),200) !!}
                                        </p>
                                        <div class="action">
                                            <a class="button btn-small"
                                               href="{{url("places/$place->id/".str_slug($place->name))}}">{{trans("places.btn_show")}}</a>
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
            {{ $places->links() }}
        </div>
    </div>

@endsection
