@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("countries.title_country_guide",['country'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li>
                    <a href="{{url("/country/{$country->id}/".str_slug($country->{"name:en"}))}}">{{$country->name}}</a>
                </li>
                <li class="active">{{trans("countries.link_guide")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")

    <div class="col-md-9">
        @if($country->photo)
            <div class="thumbnail">
                <img class="img-responsive lazy" src="{{url("files/{$country->photo}?size=870,395")}}"
                     alt="{{$country->name}}"
                >
            </div>
        @endif
        <article class="travelo-box">
            {!! $country->guide !!}
        </article>
    </div>
    <div class="sidebar col-md-3">
        @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
            <div class="addthis_inline_share_toolbox"></div> @endif
        @if($country->generalCategories()->count())
            <div class="travelo-box filters-container faq-topics">
                <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$country->name]) !!}</h4>
                <ul class="triangle filters-option">
                    @foreach($country->generalCategories as $item)
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

@stop
