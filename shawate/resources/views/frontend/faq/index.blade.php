@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("faq.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                @if(isset($category))
                    <li><a href="{{url("/faq")}}">{{trans("faq.link_faq")}}</a></li>
                    <li class="active">{{$category->name}}</li>
                @else
                    <li class="active">{{trans("faq.frontend_page_header")}}</li>
                @endif
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-sm-4 col-md-3">
            <div class="travelo-box search-questions">
                <h5 class="box-title">{{trans("faq.search_box_title")}}</h5>
                {!! Form::open(["url"=>"/faq/search","method"=>"get"]) !!}
                <div class="with-icon full-width">
                    <input type="text" name="q" class="input-text full-width" value="{{Request::input('q')}}"
                           placeholder="{{trans("faq.search_box_placeholder")}}">
                    <button class="icon green-bg white-color"><i class="soap-icon-search"></i></button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="travelo-box filters-container faq-topics">
                <h4 class="box-title">{{trans("faq.title_topics")}}</h4>
                <ul class="triangle filters-option">
                    <li class="{{(!Request::segment(3))?"active":""}}"><a
                                href="{{url("faq")}}">{{trans("faq.text_all_questions")}}</a></li>
                    @foreach($categories->get() as $category)
                        <li class="{{($category->slug==Request::segment(3))?"active":""}}"><a
                                    href="{{url("faq/{$category->slug}")}}">{{$category->name}}</a></li>
                    @endforeach

                </ul>
            </div>
            @if(Settings::get('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                    <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>

                </div>
            @endif
        </div>

        <div class="col-sm-8 col-md-9">
            <h2>{{Request::segment(3)?$category->name:trans("faq.text_all_questions")}}</h2>
            <div class="travelo-box question-list">
                @if((bool)Settings::get("show_share_buttons") && !empty(Settings::get("addthis_code")))
                    <div class="addthis_inline_share_toolbox"></div> @endif
                <div class="toggle-container">
                    @foreach($questions as $q)
                        <div class="panel style1">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#question{{$loop->index}}"
                                   aria-expanded="{{ $loop->index==0?"true":"false" }}"
                                   class="collapsed">{{$q->question}}</a>
                            </h4>
                            <div id="question{{$loop->index}}"
                                 class="panel-collapse collapse {{ $loop->index==0?"in":"" }}">
                                <div class="panel-content">
                                    {!! $q->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            {!! $questions->links() !!}
        </div>
    </div>

@endsection