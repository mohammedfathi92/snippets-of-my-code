@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li><a href="{{url("/manage/categories")}}">{{trans("main.link_categories")}}</a></li>
                    <li class="active">{{trans("categories.link_create")}}</li>
                </ol>
            </div>
            <div class="panel-body container-fluid">

                <div class="row row-lg">
                    <div class="col-sm-8">
                        <!-- Example Input Sizing -->
                        <div class="example-wrap">

                            {!! Form::open(['class'=>'form-horizontal labelbold']) !!}

                            <div class="form-group  form-material-lg">
                                <label class="col-sm-3 control-label" for="nameInput">
                                    {!! trans("categories.label_name") !!}
                                </label>
                                <div class="col-sm-9">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $locale=> $properties)
                                        <div class="form-group  {{App::isLocale($locale)?"required":""}} {{$errors->has("name.$locale")?'has-error':''}}">
                                            <label class="control-label col-md-2"
                                                   for="name_{{$locale}}">{{$properties['native']}}</label>
                                            <div class="col-md-10">
                                                {!! Form::text("name[$locale]",old("name.$locale"),['class'=>'form-control','id'=>"name_$locale"]) !!}
                                                @if ($errors->has("name.$locale"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("name.$locale") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="cleafix"></div>

                            </div>
                            <hr>
                            <div class="form-group  form-material-lg">
                                <label class="col-sm-3 control-label" for="nameInput">
                                    {!! trans("categories.label_description") !!}
                                </label>
                                <div class="col-sm-9">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $locale=> $properties)
                                    <div class="form-group">
                                        <label class="control-label col-md-2"
                                               for="description_{{$locale}}">{{$properties['native']}}</label>
                                        <div class="col-md-10">
                                            {!! Form::textarea("description[$locale]",old("description.$locale"),['class'=>'form-control','id'=>"description_$locale"]) !!}
                                            @if ($errors->has("description.$locale"))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("description.$locale") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="cleafix"></div>

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