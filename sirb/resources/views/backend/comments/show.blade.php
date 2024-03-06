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
        <i class="icon icon-calendar"></i> {{trans("main.backend_comment_page_show_header")}}</h1>

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
       
      {!! Form::open(['class'=>'form-horizontal','method'=>'put','name'=>'form','novalidate', 'url'=>route('update_comment',['id'=>$data->id])]) !!}
        <div class="panel panel-default">
            <div class="panel-heading">{{trans("main.comment_user")}} : {{$data->member->name}} <span style="margin: 0px 30px 0px 30px"><a href="{{url($comment_url)}}" target="_blank">{{trans('main.show_comment_page')}}</a></span></div>
           <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("main.comment_content")}}</label>
                <div class="col-md-5">
                    <b> {{ $data->content }}</b>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("main.comment_created_at")}}</label>
                <div class="col-md-5">
                    <b> {{ $data->created_at }}</b>
                </div>
            </div>
              <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("main.comment_status")}}</label>
                <div class="col-md-5">
                    <div class="col-md-3"><span
                                class="label label-{{trans_choice("main.status_options_color_comment",$data->status)}}">{!! trans_choice("main.status_options_comment",$data->status) !!}</span>
                    </div>
                    <div class="col-md-5">
                        <select name="status" id="status" class="form-control ">
                            <option value="0" {{old("status",$data->status)==0?"selected":""}}>{{trans_choice("main.status_options_comment",0)}}</option>
                            <option value="1" {{old("status",$data->status)==1?"selected":""}}>{{trans_choice("main.status_options_comment",1)}}</option>
                            

                        </select>
                    </div>


                </div>
            </div>
            
              
            <div class="form-group margin-none">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" 
                       class="btn btn-primary"><i class="fa fa-pencil"></i> {{trans("main.btn_edit")}}</button> 
                </div>
            </div>
        </div>

{!! Form::close() !!}

 <div class="form-group margin-none">
                <div class="col-sm-offset-3 col-sm-9">
                    <a href="{{url("$backend_uri/bookings/{$data->id}/delete")}}"
                       class="btn btn-danger"><i class="fa fa-trash"></i> {{trans("main.btn_delete")}}</a>
                </div>
            </div>
 

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
@section('css')
    <link rel="stylesheet" href="/backend/lib/js/icon-picker/css/fontawesome-iconpicker.min.css">
@endsection
@section("javascript")
    <script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.icon-picker').iconpicker();
        })
    </script>


@endsection
