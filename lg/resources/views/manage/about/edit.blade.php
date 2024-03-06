@extends('layouts.app')
@section('content')
    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li class="active">{{trans('main.link_about')}}</li>
                </ol>
            </div>
            <div class="panel-body container-fluid">
                <div class="row row-lg">
                    <div class="col-sm-12">
                        <!-- Example Input Sizing -->
                        <div class="example-wrap">

                            {!! Form::open(['class'=>'form-horizontal labelbold']) !!}

                            <div class="panel-body nav-tabs-animate nav-tabs-horizontal">
                                <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                                    <li class="active" role="presentation">
                                        <a class="lisp" data-toggle="tab"
                                           href="#arabic"
                                           aria-controls="activities"
                                           role="tab">{{trans("main.arabic")}}
                                        </a></li>

                                    <li class="" role="presentation">
                                        <a class="lisp" data-toggle="tab" href="#english"
                                           aria-controls="leads"
                                           role="tab">{{trans("main.english")}}</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active animation-slide-left" id="arabic" role="tabpanel">
                                        <br/>
                                        <div class="">
                                            <div class="form-group  form-material-lg">
                                                <label class="col-sm-3 control-label" for="nameInput">
                                                    {!! trans("about.label_title") !!}
                                                </label>
                                                <div class="col-sm-9">
                                                   {!! Form::text("title[ar]",old("title.ar",$data->translateOrNew('ar')->title),['class'=>'form-control']) !!}
                                                </div>
                                                <div class="cleafix"></div>

                                            </div>
                                            <div class="form-group  form-material-lg">
                                                <label class="col-sm-3 control-label" for="nameInput">
                                                    {!! trans("about.label_body") !!}
                                                </label>
                                                <div class="col-sm-9">
                                                    {!! Form::textarea("body[ar]",old("body.ar",$data->translateOrNew('ar')->body),['class'=>'form-control ckeditor']) !!}
                                                </div>
                                                <div class="cleafix"></div>

                                            </div>
                                        </div>


                                    </div>

                                    <div class="tab-pane animation-slide-left" id="english" role="tabpanel">
                                        <br/>
                                        <div class="">
                                            <div class="form-group  form-material-lg">
                                                <label class="col-sm-3 control-label" for="nameInput">
                                                    {!! trans("about.label_title") !!}
                                                </label>
                                                <div class="col-sm-9">
                                                    {!! Form::text("title[en]",old("title.en",$data->translateOrNew('en')->title),['class'=>'form-control']) !!}
                                                </div>
                                                <div class="cleafix"></div>

                                            </div>
                                            <div class="form-group  form-material-lg">
                                                <label class="col-sm-3 control-label" for="nameInput">
                                                    {!! trans("about.label_body") !!}
                                                </label>
                                                <div class="col-sm-9">
                                                    {!! Form::textarea("body[en]",old("body.ar",$data->translateOrNew('en')->body),['class'=>'form-control ckeditor']) !!}
                                                </div>
                                                <div class="cleafix"></div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit"
                                        class="btn btn-primary waves-effect waves-light waves-effect waves-light">
                                    {{trans('main.submit')}}
                                </button>
                                <button type="reset" class="btn waves-effect waves-light waves-effect waves-light">
                                    {{trans('main.reset')}}
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- End Example Input Sizing -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection