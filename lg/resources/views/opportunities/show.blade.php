<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 7/21/16
 * Time: 8:09 PM
 */ ?>
@extends("layouts.app")
@section("content")
    <div upload-url="{{url("/$locale/opportunities/upload")}}"
         data-ng-controller="closeConfirmationCtrl">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel">
                    <ol class="breadcrumb">
                        <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                        <li><a href="{{url("/opportunities")}}">{{trans("main.link_opportunities")}}</a></li>
                        <li class="active">{{trans("opportunities.link_show")}}</li>
                    </ol>
                </div>
            </div>
            <div class="panel-body container-fluid">
                @if($data->status==2)
                    <div class="alert alert-warning">
                        {{trans("opportunities.opportunity_is_closed")}}
                    </div>
                @endif

                <div class="row row-lg">

                    <form action="{{url("/$locale/opportunities/$data->id/progress")}}" method="post"
                          class="form-horizontal labelbold">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- Example Input Sizing -->
                        <div class="example-wrap">
                            <div class="col-sm-6">


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
                                        <label class="col-sm-4 control-label" for="progress">
                                            {{trans("opportunities.label_progress")}}
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="">
                                                {{--<input type="text" class="form-control" name="progress"
                                                       data-plugin="TouchSpin"
                                                       id="progress"
                                                       data-verticalbuttons="true" value="{{$data->progress}}"
                                                       data-ng-model="progress"
                                                       data-option="5000000"/>--}}
                                                {{--<input type="text" class="form-control" name="progress"
                                                       id="progress"
                                                       data-slider-min="0"
                                                       data-slider-max="100"
                                                       data-slider-step="5"
                                                       data-slider-value="{{$data->progress}}"
                                                       data-ng-model="progress"
                                                       value="{{$data->progress}}"
                                                />--}}
                                                <div class="progress-box">
                                                    <div class="percentage-cur"
                                                         ng-init="progress='{{old("progress",$data->progress)}}'">
                                                        <span class="num"><% progress %>%</span>
                                                    </div>
                                                    <div class="progress-bar progress-bar-slider">
                                                        <input class="progress-slider" name="progress" type="range"
                                                               min="0" max="100"
                                                               ng-model="progress"
                                                               value="{{old("progress",$data->progress)}}">
                                                        <div class="inner"
                                                             ng-style="{ width: progress + '%' || '0%' }"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-ng-show="progress>=100"
                                                 class="  {{$errors->has('photo')?'has-error':''}}">
                                                <h4 class="text-center">{{trans('opportunities.attachments')}}</h4>

                                                <a href="javascript:;"
                                                   class="btn btn-default form-control btn btn-default"
                                                   ngf-select="uploadPhoto($files, $invalidFiles)"
                                                   ng-model="photo"
                                                   ngf-multiple="true"
                                                   ngf-pattern="'image/*'"
                                                   ngf-accept="'image/*'"
                                                   ngf-keep="true"
                                                   ngf-max-size="10MB" ngf-min-height="100">
                                                    <i class="site-menu-icon md-cloud-upload"></i> Select</a>
                                                @if ($errors->has('photo'))
                                                    <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                                                @endif
                                                <div ng-repeat="f in photos" style="font:smaller">
                                                    <div class="col-md-3">
                                                        <img ng-show="form.file.$valid" ngf-thumbnail="f"
                                                             class="thumbnail img-thumbnail">
                                                        <a href="javascript:;" class="btn btn-danger"
                                                           ng-click="removePhoto($index)"
                                                           ng-show="photo">{{trans("main.btn_delete")}}</a>
                                                        <br>
                                                        <i ng-show="f.$error.required">*required</i>
                                                        <i ng-show="f.$error.maxSize">File too large
                                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                                        <input type="hidden" name="photo[]" value="<%f.result.file%>"
                                                               ng-if="f && f.progress==100">
                                                        <div class="progress  active"
                                                             ng-show="f.progress >= 0 && f.progress<100"
                                                             ng-hide="f.progress>=100"
                                                             ng-if="f">
                                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                                 role="progressbar" aria-valuenow="<%f.progress%>"
                                                                 aria-valuemin="0"
                                                                 aria-valuemax="100" style="width: <%f.progress%>%">
                                                                <span class="sr-only"><% f.progress %> % Complete</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
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
                            {{--Opportunity closed--}}
                            @if($data->status==2)

                                @if($data->close_attachments)
                                    <h3>{{trans("opportunities.title_close_attachments")}}</h3>
                                    @foreach(json_decode($data->close_attachments) as $attachment)

                                        <a href="{{url("images/$attachment")}}" data-lightbox="roadtrip">
                                            <img src="{{url("images/sm/$attachment")}}"
                                                 alt="" class="img-thumbnail"></a>

                                    @endforeach
                                @endif
                            @endif
                            <div class="col-sm-9 col-sm-offset-3">
                                {{--Opportunity Is lead but not finished/closed--}}
                                @if($data->status ==1)

                                    <input type="hidden" name="_action" value="<%proggress>=100?'close':'update'%>">
                                    <button ng-cloak ng-show="progress>=100" type="submit"
                                            class="btn btn-primary waves-effect waves-light"
                                            name="submit">
                                        {{trans('opportunities.btn_close')}}
                                    </button>
                                    <button ng-cloak ng-hide="progress>=100" type="submit"
                                            class="btn btn-primary waves-effect waves-light"
                                            name="submit">
                                        {{trans('main.btn_update')}}
                                    </button>
                                    {{--{{url("/$locale/opportunities/{$data->id}/close")}}--}}
                                    {{--<a href="javascript:;"
                                       class="btn btn-danger" data-toggle="modal"
                                       data-target="#closeOpportunityConfirmationDialog">{{trans("opportunities.btn_close")}}</a>
--}}
                                @endif
                                {{--Opportunity is binding status--}}
                                @if($data->status==0)
                                    <a href="{{url("/$locale/opportunities/{$data->id}/cancel")}}"
                                       class="btn btn-danger"
                                       onclick="return confirm('{{trans("opportunities.message_confirm_cancel")}}')">{{trans("opportunities.btn_cancel")}}</a>

                                @endif
                            </div>

                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="closeOpportunityConfirmationDialog" tabindex="-1" role="dialog"
             aria-labelledby="closeConfirmationLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open(['url'=>"/$locale/opportunities/{$data->id}/close",'method'=>'post']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="closeConfirmationLabel">{{trans("opportunities.title_close_confirmation")}}</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger">{{trans("opportunities.message_confirm_close")}}</div>
                        <div class="alert alert-warning">{{trans("opportunities.message_confirm_close_hint")}}</div>

                        <div class="  {{$errors->has('photo')?'has-error':''}}">
                            <h4 class="text-center">{{trans('opportunities.attachments')}}</h4>

                            <a href="javascript:;"
                               class="btn btn-default form-control btn btn-default"
                               ngf-select="uploadPhoto($files, $invalidFiles)"
                               ng-model="photo"
                               ngf-multiple="true"
                               ngf-pattern="'image/*'"
                               ngf-accept="'image/*'"
                               ngf-keep="true"
                               ngf-max-size="10MB" ngf-min-height="100">
                                <i class="site-menu-icon md-cloud-upload"></i> Select</a>
                            @if ($errors->has('photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                            <div ng-repeat="f in photos" style="font:smaller">
                                <div class="col-md-3">
                                    <img ng-show="form.file.$valid" ngf-thumbnail="f" class="thumbnail img-thumbnail">
                                    <a href="javascript:;" class="btn btn-danger" ng-click="removePhoto($index)"
                                       ng-show="photo">{{trans("main.btn_delete")}}</a>
                                    <br>
                                    <i ng-show="f.$error.required">*required</i>
                                    <i ng-show="f.$error.maxSize">File too large
                                        <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                    <input type="hidden" name="photo[]" value="<%f.result.file%>"
                                           ng-if="f && f.progress==100">
                                    <div class="progress  active" ng-show="f.progress >= 0 && f.progress<100"
                                         ng-hide="f.progress>=100"
                                         ng-if="f">
                                        <div class="progress-bar progress-bar-success progress-bar-striped"
                                             role="progressbar" aria-valuenow="<%f.progress%>" aria-valuemin="0"
                                             aria-valuemax="100" style="width: <%f.progress%>%">
                                            <span class="sr-only"><% f.progress %> % Complete</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">{{trans("main.btn_cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{trans("main.btn_confirm")}}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop
@section("footer-scripts")
    <style>
        .slider-selection {
            background: #ca2c68;
        }

        .slider-handle {

        }
    </style>
    <script>
        $('#progress').slider({
            formatter: function (value) {
                $("#progressValue").text(value + '%');
                return 'Current value: ' + value + '%';
            }
        });
    </script>


@stop
