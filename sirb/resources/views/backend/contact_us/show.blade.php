<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <h1 class="page-title">
        <i class="fa fa-dedent"></i> {{trans("messages.backend_page_header")}} </h1>
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


        <div class="content">
            <div class="form-horizontal">
                <div class="panel panel-default">
                    <div class="form-group">
                        <label class="control-label col-md-3">{{trans("messages.label_from")}} :</label>
                        <div class="col-md-5"><span class="form-control">{{$data->name." <$data->email>"}}</span></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{trans("messages.label_subject")}} :</label>
                        <div class="col-md-5"><span class="form-control">{{$data->subject}}</span></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">{{trans("messages.label_time")}} :</label>
                        <div class="col-md-5"><span
                                    class="form-control">{{\Carbon\Carbon::instance($data->created_at)->toDateString() ." ".trans("messages.text_at")." ".\Carbon\Carbon::instance($data->created_at)->toTimeString()}}</span>
                        </div>
                    </div>
                    @if($data->mobile)
                        <div class="form-group">
                            <label class="control-label col-md-3">{{trans("messages.label_mobile")}} :</label>
                            <div class="col-md-5"><span
                                        class="form-control">{{$data->mobile}}</span>
                            </div>
                        </div>
                    @endif
                    @if($data->country)
                        <div class="form-group">
                            <label class="control-label col-md-3">{{trans("messages.label_country")}} :</label>
                            <div class="col-md-5"><span
                                        class="form-control">{{$data->country}}</span>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-3">{{trans("messages.label_message")}} :</label>
                        <div class="col-md-8">{!! $data->message !!}</div>
                    </div>
                </div>
            </div>
            @if($data->replies()->count())
                <div class="panel panel-primary">
                    <h3 class="panel-heading" data-toggle="collapse"
                        data-target="#replies-accordion">{{trans("messages.message_replies")}}</h3>
                    <div class="panel-body">

                        <div class="panel-group collapse in" id="replies-accordion">
                            @foreach($data->replies as $reply)
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-toggle="collapse" data-parent="#replies-accordion"
                                         data-target="#reply-{{$loop->index}}">
                                        <a data-toggle="collapse" data-parent="#replies-accordion"
                                           data-target="#reply-{{$loop->index}}">
                                            {!! "<strong>{$reply->user->name}</strong>"." ".trans("messages.text_at")." ".$reply->created_at !!}</a>
                                    </div>
                                    <div id="reply-{{$loop->index}}" class="panel-collapse collapse">
                                        <div class="panel-body">{!! $reply->message_text !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endif

            @can("reply messages")
                {!! Form::open(['class'=>'form-horizontal','method'=>'post','name'=>'form','novalidate']) !!}
                <div class="panel panel-success">

                    <div class="panel-heading" data-toggle="collapse"
                         data-target="#add-reply-collapse">{{trans("messages.title_add_replay")}}</div>
                    <div class="collapse in" id="add-reply-collapse">
                        <div class="panel-body">
                            <textarea name="message" class="ckeditor" id="replay-message" cols="30"
                                      rows="10"></textarea>
                        </div>
                        <div class="panel-footer">
                            <div class="pull-right">
                                <button href="categories.html" type="submit"
                                        class="btn btn-primary"><i
                                            class="fa fa-send"></i> {{trans("messages.btn_send")}}
                                </button>

                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                {!! Form::close() !!}
            @endcan

        </div>


        <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
