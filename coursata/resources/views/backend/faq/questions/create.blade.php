<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-question-circle-o"></i> {{trans("faqQuestions.backend_page_create_header")}} </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        @if($errors->count())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {!! Form::open(['class'=>'form-horizontal','name'=>'form','novalidate']) !!}
        <div class="content">

            <div class="panel panel-primary">
                <div class="panel-heading">{{trans("main.tab_general")}}</div>
                <div class="panel-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-solid" role="tablist">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                            <li role="presentation" class="{{$loop->index==0?"active":""}}"><a
                                        href="#lang-{{$localeCode}}"
                                        aria-controls="lang-{{$localeCode}}" role="tab"
                                        data-toggle="tab">{{ $properties['native']}}</a>
                            </li>

                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div role="tabpanel" class="tab-pane {{$loop->index==0?"active":""}}"
                                 id="lang-{{$localeCode}}">
                                <div class="form-group {{!$errors->has("question.$localeCode")?:"has-error"}} ">
                                    <label for="question"
                                           class="col-sm-3 control-label">{{trans("faqQuestions.label_question")}}
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="question[{{$localeCode}}]" class="form-control"
                                               id="question"
                                               placeholder="" value="{{old("question.$localeCode")}}">
                                        @if ($errors->has("question.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("question.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{!$errors->has("answer.$localeCode")?:"has-error"}}">
                                    <label for="answer"
                                           class="col-sm-3 control-label">{{trans("faqQuestions.label_answer")}} <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                            <textarea type="text" name="answer[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control ckeditor"
                                                      id="answer" placeholder=""
                                            >{{old("answer.$localeCode")}}</textarea>
                                        @if ($errors->has("answer.$localeCode"))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first("answer.$localeCode") }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="icon_class"
                               class="control-label col-md-3">{{trans("faqQuestions.label_sort")}}</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                <input type="number" min="1" name="sort" class="form-control"
                                       value="{{old("sort",1)}}">

                            </div>

                        </div>
                    </div>
                    <div class="form-group {{$errors->has("status")?"has-error":''}}">
                        <label for="status" class="label-control col-md-3">
                            {{trans("faqQuestions.label_status")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="status" id="status" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{!old("status",1)?:"checked"}}>
                        </div>
                        @if ($errors->has('status'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                        @endif

                    </div>

                </div>
            </div>

        </div>
        <div class="form-group margin-none">
            <div class="col-sm-offset-3 col-sm-9">
                <button href="faqQuestions.html" type="submit"
                        class="btn btn-primary">{{trans("main.btn_create")}}</button>
            </div>
        </div>

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
@section('css')
    <link rel="stylesheet" href="/backend/lib/js/icon-picker/css/fontawesome-iconpicker.min.css">
@stop
@section('javascript')
    <!-- DataTables -->
    <script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>
        $('.icon-picker').iconpicker()
    </script>
@stop