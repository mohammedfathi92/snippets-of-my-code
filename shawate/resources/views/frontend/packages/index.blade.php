@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                @if(isset($type))
                    <h2 class="entry-title">{{$type->name}}</h2>
                @else
                    <h2 class="entry-title">{{trans("packages.link_packages")}}</h2>
                @endif
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                @if(isset($type))
                    <li><a href="{{url("/packages")}}">{{trans("packages.link_packages")}}</a></li>
                    <li class="active">{{$type->name}}</li>
                @else
                    <li class="active">{{trans("packages.link_packages")}}</li>
                @endif


            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">

        <div class="col-sm-8 col-md-9">
            <div class="hot-deals-list">

                @if($packages->count())
                    @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                        <div class="addthis_inline_share_toolbox"></div> @endif
                    <div class="row cruise-list image-box style3 cruise listing-style1">
                        @foreach($packages as $package)
                            <div class="col-md-4 col-sm-6">
                                <article class="box @if($package->offer_price) has-discount @endif">
                                    <figure>
                                        <a href="javascript:;" data-url="{{url("packages/ajax/$package->id/gallery")}}"
                                           class="hover-effect popup-gallery">
                                            <img width="270" height="160" alt=""
                                                 class="img-responsive lazy"
                                                 src="{{url("files/$package->photo?size=270,160&encode=jpg")}}">
                                            @if($package->offer_price && $package->price)
                                                <span class="discount"><span class="discount-text">{{(($package->price-$package->offer_price)*100)/$package->price}}
                                                        % {{trans("packages.text_offer")}}</span></span>
                                            @endif
                                        </a>
                                    </figure>
                                    <div class="details">
                                        @if($package->price)
                                            <span class="price"><small>{{trans("packages.text_from")}}</small>{{(!Settings::get('currency_on_right ')?Settings::get("{$locale}_currency"):"")}}{{$package->offer_price?:$package->price}} {{(Settings::get('currency_on_right ')?Settings::get("{$locale}_currency"):"")}}</span>
                                        @endif
                                        <h4 class="box-title">
                                            <a href="{{url("packages/{$package->id}/".str_slug($package->{"name:en"}))}}">{{$package->name}}</a>
                                            @if($package->days)
                                                <small>{{trans("packages.nights_count",['count'=>$package->days])}}</small> @endif
                                        </h4>
                                        <div class="feedback">
                                            <div data-placement="bottom" data-toggle="tooltip"
                                                 class="five-stars-container"
                                                 title="{{trans_choice("packages.package_stars_option",$package->level)}}">
                                                <span style="width: {{$package->level*20}}%;" class="five-stars"></span>
                                            </div>
                                            @if($package->people_count)
                                                <span class="review">{{trans("packages.people_count",['count'=>$package->people_count])}}</span>
                                            @endif
                                        </div>
                                        <div class="row time">

                                            <div class="departure col-xs-6">
                                                <i class="soap-icon-departure yellow-color"></i>
                                                <div>
                                                <span class="skin-color"><a
                                                            href="{{url("country/{$package->country->id}/".str_slug($package->country->name))}}">{{$package->country->name}}</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="description fourty-space"><a
                                                    href="{{url("packages/type/{$package->type->id}/".str_slug($package->type->name))}}">{{$package->type->name}}</a>
                                        </p>
                                        <div class="action">
                                            <a class="button btn-small full-width"
                                               href="{{url("packages/{$package->id}/".str_slug($package->{"name:en"}))}}">{{trans("packages.btn_show_more")}}</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <p>{{trans("packages.no_packages_found")}}</p>
                    </div>
                @endif
            </div>
            {{$packages->links()}}
        </div>
        <div class="sidebar col-md-3 col-sm-4">
            @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                <div class="addthis_inline_share_toolbox"></div> @endif

            @php
                $countries=\App\Country::published();
            @endphp
            @if(isset($country) && $country->package_types()->count())
                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("countries.country_packages_types_box_title",['country'=>$country->name]) !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($country->package_types as $item)
                            <li class="{{($item->id==Request::segment(4)&& Request::segment(3)=="type")?"active":""}}">
                                <a href="{{url("packages/type/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            @else
                @if(isset($types) && $types->count())
                    <div class="travelo-box filters-container faq-topics">
                        <h4 class="box-title">{!! trans("packages.packages_types_box_title") !!}</h4>
                        <ul class="triangle filters-option">
                            @foreach($types as $item)
                                <li class="{{($item->id==Request::segment(4)&& Request::segment(3)=="type")?"active":""}}">
                                    <a href="{{url("packages/type/{$item->id}/".str_slug($item->{"name:en"}))}}">{{$item->name}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endif
            @endif
            @if($countries)
                <div class="travelo-box filters-container faq-topics">
                    <h4>{!! trans("packages.title_cities_have_packages") !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($countries->get() as $c)
                            <li>
                                <a href="{{url("country/{$c->id}/".str_slug($c->{"name:en"})."/packages")}}">{{trans("packages.link_country_packages",['country'=>$c->name])}}</a>
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

@endsection
