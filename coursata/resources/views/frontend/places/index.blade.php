@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("institutes.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("institutes.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">

        <div class="content">
            @if(Settings::get("show_share_buttons")) <div class="addthis_inline_share_toolbox"></div> @endif
            <div class="institute-list">
                @if($data)
                    <div class="row image-box institute listing-style1">
                        @foreach($data as $institute)
                            <div class="col-sm-6 col-md-4">
                                <article class="box">
                                    <figure>
                                        <a href="{{url("$locale/places/ajax/{$institute->id}/gallery")}}"
                                           class="hover-effect popup-gallery"><img
                                                    width="270" height="160" alt=""
                                                    src="{{url("files/{$institute->photo}?size=270,160&encode=jpg")}}"></a>
                                    </figure>
                                    <div class="details">
                                        @if($institute->price)
                                            <span class="price">
                                                    <small>avg/night</small>
                                                {{$institute->price}}
                                                </span>
                                        @endif
                                        <h4 class="box-title"><a href="{{url("places/$institute->id/".str_slug($institute->name))}}">{{$institute->name}}</a>
                                            <small>{{$institute->city->name}}</small>
                                        </h4>
                                        <div class="feedback">
                                            <div data-placement="bottom" data-toggle="tooltip"
                                                 class="five-stars-container" title="4 stars"><span
                                                        style="width: {{$institute->stars*20}}%;"
                                                        class="five-stars"></span>
                                            </div>

                                        </div>
                                        <p class="description">
                                            {!! str_limit(strip_tags($institute->description),200) !!}
                                        </p>
                                        <div class="action">
                                            <a class="button btn-small"
                                               href="{{url("places/$institute->id/".str_slug($institute->name))}}">{{trans("institutes.btn_details")}}</a>
                                            @if($institute->map)
                                                <a class="button btn-small yellow popup-map" href="#"
                                                   data-box="{{$institute->map}}">{{trans("institutes.btn_show_in_map")}}</a>
                                            @endif
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">{{trans("institutes.no_results_found")}}</div>
                @endif
            </div>
            {{ $data->links() }}
        </div>
    </div>

@endsection