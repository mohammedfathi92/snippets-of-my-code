<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 6/5/18
 * Time: 4:56 PM
 */ ?>

@extends('backend.layouts.master')
@section('page_header')
 <h1 class="page-title">
<div class="row">
  <div class="col-md-6 col-sm-6">
   
      
        <i class="fa fa-h-square"></i> عناصر المقارنة
        <a href="#newServiceCollapse" data-toggle="collapse" class="btn btn-success"><i
                    class="fa fa-plus-circle"></i> {{trans("services.btn_add_new")}}</a>
         
      </div>
    
    
    </div>
    </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-offset-1 col-lg-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><a href="#newServiceCollapse"
                                                  data-toggle="collapse">{{trans("services.btn_add_new")}}</a>
                    </div>
                    <div class="panel-collapse collapse @if($errors->count()||(isset($method) && $method=='put')) in @endif"
                         id="newServiceCollapse">
                        @if($errors->count())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {!! Form::open(['method'=>$method?:"post",'class'=>'form-horizontal']) !!}
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
                                        <div class="form-group {{!$errors->has("name.$localeCode")?:"has-error"}} ">
                                            <label for="name"
                                                   class="col-sm-4 control-label">{{trans("services.label_name")}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="name[{{$localeCode}}]" class="form-control"
                                                       id="name"
                                                       placeholder=""
                                                       value="{{old("name.$localeCode",isset($data->{"name:$localeCode"})?$data->{"name:$localeCode"}:'')}}">
                                                @if ($errors->has("name.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                   

                                    </div>
                                @endforeach
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="type"
                                           class="control-label col-md-4">{{trans("services.label_type")}}</label>
                                    <div class="col-md-8">
                                        <select name="type"id="type" class="form-control">
                                            {{-- <option value="name" {{old("type",(isset($data)?$data->type:""))=="name"?'selected':''}}>name</option> --}}
                                            {{-- <option value="photo" {{old("type",(isset($data)?$data->type:""))=="photo"?'selected':''}}>photo</option> --}}
                                           {{--  <option value="logo" {{old("type",(isset($data)?$data->type:""))=="logo"?'selected':''}}>logo</option> --}}
                                            {{-- <option value="brochures" {{old("type",(isset($data)?$data->type:""))=="brochures"?'selected':''}}>brochures</option> --}}
                                            <option value="website" {{old("type",(isset($data)?$data->type:""))=="website"?'selected':''}}>website</option>
                                            <option value="address" {{old("type",(isset($data)?$data->type:""))=="address"?'selected':''}}>brochures</option>
                                            <option value="email" {{old("type",(isset($data)?$data->type:""))=="email"?'selected':''}}>email</option>
                                            <option value="phone" {{old("type",(isset($data)?$data->type:""))=="phone"?'selected':''}}>phone</option>
                                            <option value="location_type" {{old("type",(isset($data)?$data->type:""))=="location_type"?'selected':''}}>Location Type</option>
                                            <option value="country" {{old("type",(isset($data)?$data->type:""))=="country"?'selected':''}}>country</option>
                                            <option value="city" {{old("type",(isset($data)?$data->type:""))=="city"?'selected':''}}>city</option>
                                            <option value="services" {{old("type",(isset($data)?$data->type:""))=="services"?'selected':''}}>Show Services</option>
                                            <option value="locale_rate" {{old("type",(isset($data)?$data->type:""))=="locale_rate"?'selected':''}}>Locale Rate</option>
                                            <option value="international_rate" {{old("type",(isset($data)?$data->type:""))=="international_rate"?'selected':''}}>International Rate</option>
                                            <option value="featured" {{old("type",(isset($data)?$data->type:""))=="featured"?'selected':''}}>featured</option>
                                        </select>

                                    </div>
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="sort"
                                           class="control-label col-md-4">{{trans("services.label_sort")}}</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="number" id="sort" min="1" name="order" class="form-control"
                                                   value="{{old("sort",isset($data->order)?$data->order:1)}}">

                                        </div>

                                    </div>
                                </div>
                            
                            </div>
                            <p class="alert alert-info">{!! trans("services.note_prices_currency_is_courses_currency") !!}</p>

                            <div class="clearfix"></div>


                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-primary" type="submit">{{trans("main.btn_save")}}</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            {{--col-lg-8 col-md-offset-1 col-lg-offset-2--}}
            <div class="col-lg-8 col-md-offset-1 col-lg-offset-2 ">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Progress table -->
                        <div class="table-responsive">
                            {!! Form::open(['url'=>"$locale/$backend_uri/compare/delete",'name'=>"tableForm",'id'=>'tableForm']) !!}
                            <table id="dataTable" class="table v-middle dataTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>  
                                    <th>order</th>
                                    <th>Last Update</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="responsive-table-body">
                                @if($attrs->count())
                                    @foreach($attrs as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->order}}</td>
                                             <td>{{$row->status?'Active':'Not Active'}}</td>
                                            <td>{{\Carbon\Carbon::instance($row->updated_at)->diffForHumans()}}</td>
                                            <td class="text-right">
                                                @can('edit settings')
                                                    <a href="{{url("$locale/$backend_uri/compare/{$row->id}/edit")}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_edit")}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('delete institutes')
                                                    <a href="{{url("$locale/$backend_uri/compare/{$row->id}/delete")}}"
                                                       class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="{{trans("main.tooltip_delete")}}"
                                                       onclick="return confirm('{{trans("main.alert_delete_confirmation")}}')"><i
                                                                class="fa fa-times"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>
                        <!-- // Progress table -->

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" href="/backend/lib/js/icon-picker/css/fontawesome-iconpicker.min.css">
@stop
@section('javascript')
    <!-- DataTables -->
    <script src="/backend/lib/js/icon-picker/js/fontawesome-iconpicker.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.dataTable').DataTable();
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form').attr('action', "{{"/".$locale."/".$backend_uri}}" + '/institutes' + '/' + id);

            $('#delete_modal').modal('show');
        });
        $('.icon-picker').iconpicker();
    </script>
@stop