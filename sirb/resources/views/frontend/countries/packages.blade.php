@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name)."/packages",$localeCode)}}"/>
        @endif
    @endforeach
    @if($packages->nextPageUrl())
        <link rel="next" href="{{$packages->nextPageUrl()}}">
    @endif
    @if($packages->previousPageUrl())
        <link rel="prev" href="{{$packages->previousPageUrl()}}">
    @endif
@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">

                <h2 class="entry-title">{{trans("packages.title_country_packages",['country'=>$country->name])}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>

                <li>
                    <a href="{{\LaravelLocalization::localizeURL("/country/$country->id/".make_slug($country->name))}}">{{$country->name}}</a>
                </li>
                <li class="active">{{trans("packages.link_packages")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">

        <div class="col-sm-12 col-md-9">
            <div class="hot-deals-list">
                @if((bool)settings("show_share_buttons") && !empty(settings("addthis_code")))
                    <div class="addthis_inline_share_toolbox"></div> @endif
                <div class="row cruise-list image-box style3 cruise listing-style1">
                    @foreach($packages as $package)
                        <div class="col-md-4">
                            <article class="box @if($package->offer_price) has-discount @endif">
                                <figure>
                                    <a href="javascript:;"
                                       data-url="{{\LaravelLocalization::localizeURL("packages/ajax/$package->id/gallery")}}"
                                       class="hover-effect popup-gallery">
                                        <img width="270" height="160" alt=""
                                             class="lazy"
                                             src="{{url("files/$package->photo?size=270,160&encode=jpg")}}">
                                        @if($package->offer_price && $package->price)
                                            <span class="discount">
                                                <span class="discount-text">{{round((float)((($package->price-$package->offer_price)*100)/$package->price))}}
                                                    % {{trans("packages.text_offer")}}</span>
                                            </span>
                                        @endif
                                    </a>
                                </figure>
                                <div class="details">
                                    <h4 class="box-title"><a
                                                href="{{\LaravelLocalization::localizeURL("packages/{$package->id}/".make_slug($package->name))}}"> {{$package->name}}</a>
                                        @if($package->days)
                                            <small>
                                                {{trans("packages.nights_count",['count'=>$package->days-1])}}
                                                - {{trans("packages.days_count",['count'=>$package->days])}}
                                            </small>
                                        @endif
                                    </h4>
                                    @if($package->price)
                                        <span class="price">
                                           <!--  <small>{{trans("packages.text_from")}}</small> -->
                                            {{(!settings('currency_on_right ')?settings("{$locale}_currency"):"")}}{{$package->offer_price?:$package->price}} {{(settings('currency_on_right ')?settings("{$locale}_currency"):"")}}</span>
                                        <div class="clearfix"></div>
                                    @endif

                                    <div class="feedback">
                                        <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container"
                                             title="{{trans_choice("packages.package_stars_option",$package->level)}}">
                                            <span style="width: {{$package->level*20}}%;" class="five-stars"></span>
                                        </div>
                                        @if($package->adults_count)
                                            <span class="review">{{trans("packages.adults_count",['count'=>$package->adults_count])}}</span>
                                        @endif
                                    </div>
                                    <div class="row time">

                                        <div class="departure col-xs-6">
                                            <i class="soap-icon-departure yellow-color"></i>
                                            <div>
                                                <span class="skin-color"><a
                                                            href="{{\LaravelLocalization::localizeURL("country/{$package->country->id}/".make_slug($package->country->name))}}">{{$package->country->name}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="description fourty-space"><a
                                                href="{{\LaravelLocalization::localizeURL("packages/type/{$package->type->id}/".make_slug($package->type->name))}}">{{$package->type->name}}</a>
                                    </p>
                                    <div class="action">
                                        <a class="button btn-small full-width"
                                           href="{{\LaravelLocalization::localizeURL("packages/{$package->id}/".make_slug($package->name))}}">{{trans("packages.btn_show_more")}}</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

            </div>
            {{$packages->links()}}
        </div>
        <div class="sidebar col-md-3">


            @if(isset($country) && $country->package_types()->count())
                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("countries.country_packages_types_box_title",['country'=>$country->name]) !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($country->package_types as $item)
                            <li class="{{($item->id==Request::segment(4)&& Request::segment(3)=="type")?"active":""}}">
                                <a href="{{\LaravelLocalization::localizeURL("packages/type/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            @endif
            @php
                $countries=\Sirb\Country::published();
            @endphp
            @if($countries)
                <div class="travelo-box filters-container faq-topics">
                    <h4>{!! trans("packages.title_cities_have_packages") !!}</h4>
                    <ul class="triangle filters-option">
                        @foreach($countries->get() as $row)
                            <li>
                                <a href="{{\LaravelLocalization::localizeURL("country/{$row->id}/".make_slug($row->name)."/packages")}}">{{trans("packages.link_country_packages",['country'=>$row->name])}}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            @endif


            @if($country->generalCategories()->count())
                <div class="travelo-box filters-container faq-topics">
                    <h4 class="box-title">{!! trans("countries.country_guide_box_title",['country'=>$country->name]) !!}</h4>
                    <ul class="triangle filters-option">

                        <li class="">
                            <a href="{{\LaravelLocalization::localizeURL("country/{$country->id}/".make_slug($country->name)."/guide")}}">{{trans("countries.link_country_main_guide",['country'=>$country->name])}}</a>
                        </li>

                        @foreach($country->generalCategories as $item)
                            <li class="{{($item->id==Request::segment(3)&& Request::segment(2)=="guide")?"active":""}}">
                                <a href="{{\LaravelLocalization::localizeURL("guide/{$item->id}/".make_slug($item->name))}}">{{$item->name}}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>

            @endif
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>
                </div>
            @endif
        </div>
    </div>

@endsection
