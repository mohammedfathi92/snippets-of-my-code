<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 7/21/16
 * Time: 8:09 PM
 */ ?>
@extends("layouts.app")
@section("content")
    <div class="panel">
        <div class="panel-heading">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li><a href="{{url("/manage/opportunities")}}">{{trans("main.link_opportunities")}}</a></li>
                    <li class="active">{{trans("opportunities.link_show")}}</li>
                </ol>
            </div>
        </div>
        <div class="panel-body container-fluid">


            <div class="row row-lg">

                <form action="{{url("/$locale/manage/opportunities/$data->id/progress")}}" method="post"
                      class="form-horizontal labelbold">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- Example Input Sizing -->
                    <div class="example-wrap">
                        <div class="col-sm-6">
                            <div class="form-group  form-group form-material-lg ">

                                <label class="col-sm-3 control-label" for="distributor">
                                    {{trans("opportunities.label_distributor_name")}}
                                </label>

                                <div class="col-sm-9">
                                    <strong>{{$data->user->name}}</strong>
                                </div>

                            </div>

                            <div class="form-group  form-group form-material-lg ">

                                <label class="col-sm-3 control-label" for="clientName">
                                    {{trans("opportunities.label_client_name")}}
                                </label>

                                <div class="col-sm-9">
                                    <strong>{{$data->client_name}}</strong>
                                </div>

                            </div>
                            <div class="form-group  form-group form-material-lg">
                                <label class="col-sm-3 control-label" for="opportunityInfo">
                                    {{trans("opportunities.label_info")}}
                                </label>
                                <div class="col-sm-9">
                                    <pre>
                                        {{$data->details}}
                                    </pre>
                                </div>
                            </div>
                            <div class="form-group  form-group form-material-lg">
                                <label class="col-sm-3 control-label" for="deliver_at">
                                    {{trans("opportunities.label_deliver_at")}}
                                </label>
                                <div class="col-sm-9">
                                    {{$data->deliver_at}}
                                </div>


                            </div>
                            @if($data->status==1)

                                <div class="form-group  form-group form-material-lg">
                                    <label class="col-sm-3 control-label" for="progress">
                                        {{trans("opportunities.label_progress")}}
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="">
                                            <input type="text" class="form-control" name="progress"
                                                   data-plugin="TouchSpin"
                                                   id="progress"
                                                   data-verticalbuttons="true" value="{{$data->progress}}"
                                                   data-option="5000000"/>
                                        </div>
                                    </div>
                                </div>
                        @endif
                        <!-- End Example Input Sizing -->
                        </div>

                        <div class="col-md-6">
                            <h3>{{trans("opportunities.products_list")}}</h3>
                            @if($data->products)
                                <ul class="list-group">
                                    @foreach($data->products as $product)
                                        <li class="list-group-item">
                                            <div class="col-md-3">
                                                <div class="thumbnail">
                                                    @if($product->photo && Storage::disk('uploads')->has("small/".$product->photo))
                                                        <img src="{{url("images/sm/".$product->photo)}}"
                                                             class="img-thumbnail img-bordered"
                                                             alt="{{$product->name}}">
                                                    @else
                                                        <img src="/assets/images/no-product-image.jpg"
                                                             class="img-thumbnail img-bordered"
                                                             alt="{{$product->name}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="col-md-3">{{trans("products.name")}} : </label>
                                                    <span>{{$product->name}}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">{{trans("opportunities.label_quantity")}}
                                                        : </label>
                                                    <span>{{$product->pivot->quantity}}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">{{trans("opportunities.label_price")}}
                                                        : </label>
                                                    <span><%"{{$product->pivot->price}}
                                                        "|number:2 %> {{trans("products.currency_symbol") }} </span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>

                        <div class="clearfix"></div>
                        <hr>

                            <div class="col-sm-9 col-sm-offset-3">
                                @if($data->status ==1)
                                <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit">
                                    {{trans('main.btn_update')}}
                                </button>
                                    <a href="{{url("/$locale/manage/opportunities/{$data->id}/close")}}"
                                       class="btn btn-danger"
                                       onclick="return confirm('{{trans("opportunities.message_confirm_close")}}')">{{trans("opportunities.btn_close")}}</a>

                                @endif
                                @if($data->status==0)
                                        <a href="{{url("/$locale/manage/opportunities/{$data->id}/lead")}}"
                                           class="btn btn-success"
                                           onclick="return confirm('{{trans("opportunities.message_confirm_lead")}}')">{{trans("opportunities.btn_lead")}}
                                        </a>
                                        <a href="{{url("/$locale/manage/opportunities/{$data->id}/cancel")}}"
                                           class="btn btn-danger"
                                           onclick="return confirm('{{trans("opportunities.message_confirm_cancel")}}')">{{trans("opportunities.btn_cancel")}}
                                        </a>

                                    @endif
                            </div>

                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection