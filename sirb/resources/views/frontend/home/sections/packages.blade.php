<?php
/**
 * Created by mohammed Zidan.
 * email: php.mohammedzidan@gmail.com
 * Date: 6/22/18
 * Time: 12:51 PM
 */
?>
{{--
@if($packages->count())
    <div class="honeymoon section global-map-area promo-box parallax" data-stellar-background-ratio="0.5"
         @if(settings('home_packages_section_background')) style="background: url('{{Storage::url(settings('home_packages_section_background'))}}') !important;" @endif >
        <div class="container">
            <div class="col-sm-6 content-section description pull-right">
                <h1 class="title">{{trans("packages.frontend_home_section_title")}}</h1>
                <p>Nunc cursus libero purusac congue arcu cursus utsed vitae pulvinar massa idporta neque
                    purusac
                    Etiam elerisque mi id faucibus iaculis vitae pulvinar.</p>

                <div class="row places image-box style9">
                    @foreach($packages as $package)
                        <div class="col-md-4 col-sm-6">
                            <article class="box">
                                <figure>
                                    <a href="{{\LaravelLocalization::localizeURL("packages/$package->id/".make_slug($package->name))}}"
                                       title="{{$package->name}}"
                                       class="hover-effect yellow middle-block animated"
                                       data-animation-type="fadeInUp"
                                       data-animation-duration="1">
                                        <img class="lazy img-responsive"
                                             src="{{url("/files/{$package->photo}?size=175,175&encode=jpg")}}"
                                             alt="{{$package->name}}"/></a>
                                </figure>
                                <div class="details">
                                    <h4 class="box-title">{!! Html::link(\LaravelLocalization::localizeURL("packages/$package->id/".make_slug($package->name)),$package->name) !!}
                                        <small>${{$package->price}}</small>
                                    </h4>
                                    <a href="{{\LaravelLocalization::localizeURL("packages/$package->id/".make_slug($package->name))}}"
                                       title=""
                                       class="button">{{trans("packages.btn_show_more")}}</a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6 image-container no-margin">
                @if(settings('home_packages_section_photo'))
                    <img class="lazy animated img-responsive"
                         src="{{Storage::url(settings('home_packages_section_photo'))}}" alt=""
                         data-animation-type="fadeInUp"
                         data-animation-duration="2">
                @endif
            </div>
        </div>
    </div>



@endif
--}}
<div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="description text-center">
            <h1>{{trans("packages.frontend_home_section_title")}}</h1>
            {!! settings('home_packages_section_description') !!}
        </div>
        <div class="image-carousel style3 flex-slider" data-item-width="170" data-item-margin="30">
            <ul class="slides image-box style9">
                @foreach($packages as $package)
                    <li>
                        <article class="box">
                            <figure>
                                <a href="{{\LaravelLocalization::localizeURL("packages/$package->id/".make_slug($package->name))}}"
                                   title="{{$package->name}}"
                                   class="hover-effect yellow middle-block animated"
                                   data-animation-type="fadeInUp"
                                   data-animation-duration="1">
                                    <img class="lazy img-responsive"
                                         src="{{url("/files/{$package->photo}?size=170,160&encode=jpg")}}"
                                         alt="{{$package->name}}"/></a>
                            </figure>
                            <div class="details">
                                <h4 class="box-title">{{$package->name}}</h4>
                                <a href="{{\LaravelLocalization::localizeURL("packages/$package->id/".make_slug($package->name))}}"
                                   title="" class="button">{{trans("packages.btn_show_more")}}</a>
                            </div>
                        </article>
                    </li>

                @endforeach
            </ul>
        </div>
    </div>
</div>
