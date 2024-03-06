@extends('frontend.layouts.master')
@section("content")
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_frontend_home")}}</a>
                    </li>
                    <li>{{trans("institutes.link_institutes")}}</li>
                </ul>
            </div>
        </div>
        <div class="container margin_60">
            <div class="actions btn-group">
                <a href="#" id="compareReset" class=" btn btn-default">{{trans("courses.text_reset")}}</a>
                <a href="#" id="compareFilter" class=" btn btn-primary">{{trans("courses.compare_filter")}}</a>
            </div>
            <section id="main_comparison">
                <section class="cd-products-comparison-table">

                    <div class="cd-products-table">
                        <div class="features">
                            <div class="top-info">{{trans("courses.text_model")}}</div>
                            <ul class="cd-features-list">
                                <li>{{trans("courses.institute")}}</li>
                                <li>{{trans("courses.text_price")}}</li>
                                <li>{{trans("courses.text_locale_rating")}}</li>
                                <li>{{trans("courses.text_international_rating")}}</li>
                                <li>{{trans("courses.label_insurance")}}</li>
                                <li>{{trans("courses.label_hours")}}</li>
                                <li>{{trans("courses.label_lessons")}}</li>
                                <li>{{trans("courses.details_avg_students")}}</li>
                                <li>{{trans("courses.details_max_students")}}</li>
                                <li>{{trans("courses.label_featured")}}</li>
                            </ul>
                        </div> <!-- .features -->


                        <div class="cd-products-wrapper">
                            <ul class="cd-products-columns">
                                @foreach ($courses as $course)
                                    <li class="product">
                                        <div class="top-info">
                                            <div class="check"></div>
                                            <img src="{{url("files/{$course->photo}?size=200,150")}}"
                                                 alt="{{$course->name}}">
                                            <h3>{{$course->name}}</h3>
                                        </div> <!-- .top-info -->

                                        <ul class="cd-features-list">
                                            <li>{{$course->institute->name}}</li>

                                            <li>

                                                @if($course->offer_price)
                                                    <strike> {{$course->price}}  </strike>
                                                    <span style="font-size: 20px; color: red"> - {{$course->offer_price}}</span>

                                                @else
                                                    {{($course->price?$course->price:'---')}}

                                                @endif
                                            </li>
                                            <li class="rate">
                                                <span>{{($course->local_rate?$course->local_rate:'---')}}</span></li>
                                            <li class="rate">
                                                <span>{{($course->international_rate?$course->international_rate:'---')}}</span>
                                            </li>
                                            <li>{{($course->health_insurance?$course->health_insurance:'---')}}</li>
                                            <li>{{($course->hours?$course->hours:'---')}}</li>
                                            <li>{{($course->num_lessons?$course->num_lessons:'---')}}</li>
                                            <li>{{($course->avg_students?$course->avg_students:'---')}}</li>
                                            <li>{{($course->max_students?$course->max_students:'---')}}</li>

                                            <li>{{($course->featured?"&#9989;":'---')}}</li>
                                        </ul>
                                    </li> <!-- .product -->
                                @endforeach
                            </ul> <!-- .cd-products-columns -->
                        </div> <!-- .cd-products-wrapper -->

                        <ul class="cd-table-navigation">
                            <li><a href="#0" class="prev inactive">Prev</a></li>
                            <li><a href="#0" class="next">Next</a></li>
                        </ul>
                    </div> <!-- .cd-products-table -->
                </section> <!-- .cd-products-comparison-table -->
            </section>
        </div>
    </main>
@stop
@section("styles")
    <link rel="stylesheet" href="/compare/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="/compare/css/style.css"> <!-- Resource style -->
@stop
@section("scripts")
    {{--<script src="/compare/js/modernizr.js"></script> <!-- Modernizr -->--}}
    <script src="/compare/js/main.js"></script> <!-- Resource jQuery -->
@stop