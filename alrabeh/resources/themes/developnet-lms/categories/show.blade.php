<?php
/**
 * Created by Ahmed Zidan.
 * email: php.ahmedzidan@gmail.com
 * Project: Alrabeh LMS
 * Date: 3/7/19
 * Time: 4:57 PM
 */
?>
@extends('layouts.master')
@section('css')
    {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')

    @include('partials.banner')

    <section class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 category-wrap">
                    <div class="page-side-title">
                        <h3>{{ $category->name }}</h3>
                    </div>
                    <div class="other-courses">
                        @if($category->categories->count())
                            <div class="row">
                                @foreach($category->categories as $subCat)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="item subject-block">
                                            <a href="{{ route('category.show', $subCat->slug) }}"
                                               class="subject-img">
                                                <img src="{{ $subCat->thumbnail }}" alt="{{ $subCat->name }}">
                                                <span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
                                            </a>
                                            <div class="subject-content">
                                                <a href="{{route('category.show', $subCat->slug)}}"
                                                   class="sub-content-title">{{$subCat->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @if($category->plans->count())
                        <div class="page-side-title">
                            <h3>@lang('developnet-lms::labels.headings.text_all_plans')</h3>
                        </div>
                        <div class="pricing-grids row">


                            @foreach($category->plans as $plan)

                                @php
                                    $is_subscribed = \Subscriptions::is_subscribed([
                                        'user' => userLMS(),
                                        'module' => 'plan',
                                        'module_id' => $plan->id
                                    ]);
                                        $plan_price =$plan->sale_price??$plan->price;

                                @endphp
                                <div class="col-sm-6 col-lg-3">
                                    <div class="pricing-grid {{$plan->is_featured? 'colored':'' }} {{$is_subscribed?'subscribed':''}}">

                                        <div class="pricing_grid">
                                            <div class="pricing-top ">
                                                <h3>{{$plan->title}}</h3>
                                            </div>
                                            <div class="pricing-info ">
                                                @if($plan_price > 0)
                                                    <p>{{$plan_price}}</p>
                                                @else
                                                    <p>@lang('developnet-lms::labels.spans.span_free')</p>
                                                @endif

                                            </div>
                                            <div class="pricing-bottom">
                                                <div class="pricing-bottom-bottom">
                                                    @if($plan->courses->count())

                                                        <p>
                                                            <span class="fa fa-check"></span><span> عدد الكورسات : </span>
                                                            <small> {{$plan->courses->count()}} </small>
                                                        </p>

                                                    @else

                                                        <p>
                                                            <span class="fa fa-times"></span><span> عدد الكورسات : </span>
                                                            <small> 0</small>
                                                        </p>

                                                    @endif

                                                    @if($plan->quizzes->count())

                                                        <p>
                                                            <span class="fa fa-check"></span><span> عدد  الاختبارات : </span>
                                                            <small> {{$plan->quizzes->count()}} </small>
                                                        </p>
                                                    @else
                                                        <p>
                                                            <span class="fa fa-times"></span><span> عدد الاختبارات : </span>
                                                            <small> 0</small>
                                                        </p>
                                                    @endif
                                                    @if($plan->books->count())

                                                        <p>
                                                            <span class="fa fa-check"></span><span> عدد  الكتب : </span>
                                                            <small> {{$plan->books->count()}} </small>
                                                        </p>
                                                    @else
                                                        <p>
                                                            <span class="fa fa-times"></span><span> عدد الكتب : </span>
                                                            <small> 0</small>
                                                        </p>
                                                    @endif

                                                </div>
                                                <div class="buy-btn">

                                                    @if($is_subscribed)

                                                        <a href="javascript:;">
                                                            {{__('developnet-lms::labels.links.you_subscribed')}}
                                                        </a>
                                                    @else
                                                        {!! Form::model($plan, ['url' => route('subscriptions.subscribe',['module' => 'plan', 'module_id'=> $plan->hashed_id]),'method'=>'POST','files'=>true]) !!}
                                                        <button type="submit">
                                                            {{__('developnet-lms::labels.links.link_subscribe_now')}}
                                                        </button>
                                                        {!! Form::close() !!}

                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($category->books->count())
                        <div class="page-side-title">
                            <h3>الكتب</h3>
                        </div>
                        <div class="other-courses">

                            <div class="row">
                                @foreach($category->books as $book)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="item subject-block">
                                            <a href="{{ route('books.show', $book->hashed_id) }}"
                                               class="subject-img">
                                                @if($book->thumbnail)
                                                    <img src="{{ $book->thumbnail }}" alt="{{ $book->title }}">
                                                @endif
                                                <span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
                                            </a>
                                            <div class="subject-content">
                                                <a href="{{route('books.show', $book->hashed_id)}}"
                                                   class="sub-content-title">{{$book->title}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif

                </div>

                @include('partials.sidebar')
            </div>
        </div>
    </section>


@endsection

