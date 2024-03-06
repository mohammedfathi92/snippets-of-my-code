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
        <i class="icon icon-dollar"></i> {{trans("currencies.backend_page_create_header")}} </h1>
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
        {!! Form::open(['class'=>'form-horizontal','name'=>'form','method'=>'put','novalidate']) !!}
        <div class="row">
            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="form-group {{!$errors->has("name")?:"has-error"}} ">
                            <label for="name"
                                   class="col-sm-3 control-label">{{trans("currencies.label_name")}}
                                <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control"
                                       id="name"
                                       placeholder="" value="{{old("name",$data->name)}}">
                                @if ($errors->has("name"))
                                    <span class="help-block">
                                                    <strong>{{ $errors->first("name") }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("code")?"has-error":''}}">
                            <label for="code"
                                   class="control-label col-sm-3">{{trans("currencies.label_code")}}
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-3">
                                <input type="text" name="code" class="form-control" id="code"
                                       placeholder="" value="{{old("code",$data->code)}}">
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("symbol_left")?"has-error":''}}">
                            <label for="symbol_left"
                                   class="control-label col-sm-3">{{trans("currencies.label_symbol_left")}}

                            </label>

                            <div class="col-sm-3">
                                <input type="text" name="symbol_left" class="form-control" id="symbol_left"
                                       placeholder="" value="{{old("symbol_left",$data->symbol_left)}}">
                                @if ($errors->has('symbol_left'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('symbol_left') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("symbol_right")?"has-error":''}}">
                            <label for="symbol_right"
                                   class="control-label col-sm-3">{{trans("currencies.label_symbol_right")}}

                            </label>

                            <div class="col-sm-3">
                                <input type="text" name="symbol_right" class="form-control" id="symbol_right"
                                       placeholder="" value="{{old("symbol_right",$data->symbol_right)}}">
                                @if ($errors->has('symbol_right'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('symbol_right') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("decimal_place")?"has-error":''}}">
                            <label for="decimal_place"
                                   class="control-label col-sm-3">{{trans("currencies.label_decimal_place")}}

                            </label>

                            <div class="col-sm-3">
                                <input type="text" name="decimal_place" class="form-control" id="decimal_place"
                                       placeholder="" value="{{old("decimal_place",$data->decimal_place)}}">
                                @if ($errors->has('decimal_place'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('decimal_place') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has("status")?"has-error":''}}">
                            <label for="status"
                                   class="control-label col-sm-3">{{trans("currencies.label_status")}}

                            </label>

                            <div class="col-sm-3">
                                <input type="checkbox" name="status" class="toggle-checkbox" id="status"
                                       placeholder="" value="1" @if(old('status',$data->status)) checked @endif>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="form-group margin-none">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button href="currencies.html" type="submit"
                                        class="btn btn-primary">{{trans("main.btn_update")}}</button>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    {!! Form::close() !!}
    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection

