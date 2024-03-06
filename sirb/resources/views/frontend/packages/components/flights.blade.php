<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 7/7/18
 * Time: 1:49 AM
 */
?>
@foreach($flights as $flight)
    <div class="panel panel-default">
        <article class="travelo-box book-with-us-box">
            <figure class="col-sm-4 col-md-3">
                <img class="img-responsive lazy img-thumbnail"
                     src="{{url("files/{$flight->flight->photo}?size=170,78")}}"
                     alt="{{$flight->flight->name}}">
            </figure>
            <div class="details col-xs-12 col-sm-8 col-md-9">
                <div>
                    <div>
                        <div class="box-title">
                            <h4 class="title">{{$flight->flight->name}}</h4>

                            {{--{{dd($flight)}}--}}
                            <div class="description">
                                <div class="row">
                                    <span class="col-md-2 label label-info">{!! trans("packages.flight_from") !!}</span>
                                    <span class="col-md-10">

                                                                {!! Html::link(route("city.details",['id'=>$flight->from_city_id,'slug'=>make_slug($flight->fromCity->name)]),$flight->fromCity->name) !!}</span>
                                </div>
                                <div class="row">
                                    <span class="col-md-2 label label-info">{!! trans("packages.flight_to") !!}</span>
                                    <span class="col-md-10">
                                                                {!! Html::link(route("city.details",['id'=>$flight->to_city_id,'slug'=>make_slug($flight->toCity->name)]),$flight->toCity->name) !!}</span>
                                </div>
                                {!! $flight->flight->description !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </article>
    </div>
@endforeach
