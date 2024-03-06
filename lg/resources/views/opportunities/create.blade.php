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
                    <li><a href="{{url("/opportunities")}}">{{trans("main.link_opportunities")}}</a></li>
                    <li class="active">{{trans("opportunities.link_create")}}</li>
                </ol>
            </div>
        </div>
        <div class="panel-body container-fluid">


            <div class="row row-lg">

                <form action="" method="post" class="form-horizontal labelbold" id="ajaxForm"
                      data-ng-controller="createOpportunityFormData" ng-submit="processFormData($event)">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- Example Input Sizing -->
                    <div class="example-wrap">
                        <div class="col-sm-6">


                            <div ng-cloak class="form-group required form-group form-material-lg "
                                 data-ng-class="{ 'has-error' : errors.client }">

                                <label class="col-sm-3 control-label" for="clientName">
                                    {{trans("opportunities.label_client_name")}}
                                </label>

                                <div class="col-sm-9">
                                    {!! Form::text("client",old("client"),['class'=>'form-control','id'=>'clientName','data-ng-model'=>'formData.client']) !!}
                                    <span ng-cloak class="help-block" ng-show="errors.client"><% errors.client %></span>
                                </div>

                            </div>
                            <div class="form-group required form-group form-material-lg"
                                 data-ng-class="{ 'has-error' : errors.info }">
                                <label class="col-sm-3 control-label" for="opportunityInfo">
                                    {{trans("opportunities.label_info")}}
                                </label>
                                <div class="col-sm-9">
                                    {!! Form::textarea("info",old("info"),['class'=>'form-control','id'=>'opportunityInfo','data-ng-model'=>'formData.info']) !!}
                                    <span class="help-block" ng-show="errors.info"><% errors.info %></span>
                                </div>
                            </div>
                            <div class="form-group required form-group form-material-lg"
                                 data-ng-class="{ 'has-error' : errors.deliver_at }">
                                <label class="col-sm-3 control-label" for="deliver_at">
                                    {{trans("opportunities.label_deliver_at")}}
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="site-menu-icon md-calendar"></i></span>
                                        {!! Form::text("deliver_at",old("deliver_at"),['class'=>'form-control datepicker','id'=>'deliver_at','data-ng-model'=>'formData.deliver_at']) !!}

                                    </div>
                                    <span class="help-block" ng-show="errors.deliver_at"><% errors.deliver_at %></span>
                                </div>
                            </div>


                            <!-- End Example Input Sizing -->
                        </div>

                        <div ng-cloak class="col-md-6" data-ng-controller="opportunitiesProductsCtrl">
                            <h3>{{trans("opportunities.products_list")}}</h3>
                            <ul class="list-group">

                                <li class="list-group-item" data-ng-repeat="product in productsList">
                                    <div class="form-group required form-group form-material-lg">
                                        <label class="col-sm-3 control-label" for="category<%$index%>">
                                            {{trans("opportunities.label_category")}}
                                        </label>
                                        <div class="col-sm-9" ng-cloak>
                                            @if($categories)

                                                <select class="form-control select2" name="categories[]"
                                                        id="category<%$index%>"
                                                        data-ng-change="getCategoryProducts($index)"
                                                        data-ng-model="product.category">
                                                    @foreach($categories as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group required form-group form-material-lg">
                                        <label class="col-sm-3 control-label" for="categoryProducts<%$index%>">
                                            {{trans("opportunities.label_product")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <div class="" ng-cloak>
                                                <select name="products[]" id="categoryProducts<%$index%>"
                                                        class="form-control select2"
                                                        data-ng-model="product.product"
                                                        data-ng-disabled="!product.categoryProducts.length"
                                                        data-ng-change="updatePrices($index)">
                                                    <option value=""></option>
                                                    <option data-ng-repeat="item in product.categoryProducts"
                                                            value="<%item.id%>"><%item.name%>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group required form-group form-material-lg">
                                        <label class="col-sm-3 control-label" for="quantity<%$index%>">
                                            {{trans("opportunities.label_quantity")}}
                                        </label>
                                        <div class="col-sm-9" ng-cloak>
                                            <div class="">
                                                <input type="number" class="form-control" name="quantity[]"
                                                       data-ng-model="product.quantity"
                                                       step="1"
                                                       id="quantity<%$index%>"
                                                       data-ng-change="updatePrices($index)"
                                                       min="1" value="<%product.quantity%>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group required form-group form-material-lg">
                                        <label class="col-sm-3 control-label" for="inputSizingLarge">
                                            {{trans("opportunities.label_price")}}
                                        </label>
                                        <div class="col-sm-9">
                                            <div class="">
                                                {{--<strong><%product.price|number:2%> {{trans("products.currency_symbol")}}</strong>--}}

                                                <input type="number" class="form-control" name="price[]"
                                                       data-ng-model="product.price"
                                                       data-ng-change="updatePrices($index)"
                                                       value="" min="0" step="0.5"/>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;" data-ng-click="removeProduct($index)" class="btn btn-danger"><i
                                                class="site-menu-icon md-delete"></i> {{trans("opportunities.btn_remove_product")}}
                                    </a>
                                    <span ng-cloak class="label label-info">subtotal: <%product.total |number:2%></span>
                                    <hr>
                                </li>

                            </ul>
                            <div class="col-md-6" ng-cloak>
                                <label for=""
                                       class="control-label col-md-5">{{trans('opportunities.label_total_price')}}</label>
                                <strong><%totalPrice |number:2%> {{trans("products.currency_symbol")}}</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="javascript:;" data-ng-click="appendList()"
                                   class="btn btn-primary">
                                    {{trans('opportunities.btn_append_products')}}</a>
                            </div>

                        </div>

                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-sm-9 col-sm-offset-3" ng-cloak>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit"
                                    data-ng-click="processFormData($event);">
                                {{trans('main.submit')}}
                            </button>
                            {{--<button type="submit" name="submit">test</button>--}}
                            <button type="reset" class="btn waves-effect waves-light">
                                {{trans('main.reset')}}
                            </button>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection