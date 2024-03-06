<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 7/6/18
 * Time: 9:58 PM
 */
?>

<div class="room-list hotel">
    @foreach($package->rooms as $room)
        <article class="box">
            <figure class="col-sm-4 col-md-3">
                <a class="hover-effect popup-gallery"
                   href="{{\LaravelLocalization::localizeURL("hotels/ajax/{$room->hotel->id}/gallery")}}"><img
                            class="img-responsive lazy"
                            src="{{url("files/{$room->hotel->photo}?size=181,90&encode=jpg")}}"
                            alt="{{$room->hotel->name}}"></a>
            </figure>
            <div class="details col-xs-12 col-sm-8 col-md-9">

                <div class="">
                    <h4 class="title">
                        <a href="{{route("hotels.show",['id'=>$room->hotel->id,'slug'=> make_slug($room->hotel->name)])}}"
                           target="_blank">{{$room->hotel->name}}</a>
                    </h4>
                    <div class="feedback">
                        <div data-placement="bottom" data-toggle="tooltip"
                             class="five-stars-container"
                             title="{{$room->hotel->stars}} stars">

                                                            <span style="width: {{$room->hotel->stars*20}}%;"
                                                                  class="five-stars"></span>
                        </div>

                    </div>
                    <div class="box-title">

                        <div class="description">
                            <div class="col-md-6">
                                <dt>{{trans("packages.text_city")}} :
                                    <a href="{{route("city.details",['id'=>$room->city->id,'slug'=>make_slug($room->city->name)])}}"
                                       target="_blank">{{$room->city->name}}
                                    </a>
                                </dt>
                                <dd>{{trans("packages.text_room")}} :
                                    <a href="#" class="popup-gallery"
                                       data-url="{{\LaravelLocalization::localizeURL("rooms/ajax/{$room->id}/gallery")}}"
                                       target="_blank">{{$room->name}}</a>
                                </dd>
                            </div>
                            <div class="col-md-6">
                                <dt>{{trans("packages.text_days")}}: {{trans("packages.nights_count",['count' => $room->pivot->days])}}
                                </dt>
                                <dd>
                                    {{trans("packages.text_rooms_count")}}
                                    : {{trans('packages.rooms_count',['count'=> $room->pivot->rooms_count])}}
                                </dd>
                            </div>
                        </div>
                    </div>

                </div>

                {{--@if($room->hotel->services()->count())
                    <div class="amenities">
                        @foreach($room->hotel->services as $service)
                            <i class="{{$service->icon_class}} circle"
                               title="{{$service->name}}" data-toggle="tooltip"></i>
                        @endforeach
                    </div>
                @endif--}}

            </div>

            <hr class="clearfix" />
        </article>
    @endforeach

</div>
