@extends('layouts.app')
@section('content')

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    @if( Request::input('category'))
                        <li><a href="{{url("/manage/categories")}}">{{trans("main.link_categories")}}</a></li>
                        <li>
                            <a href="{{url("/manage/products?category=".$category->id)}}">{{$category->name}}</a>
                        </li>
                    @else
                        <li><a href="{{url("/manage/products")}}">{{trans("main.link_products")}}</a></li>
                    @endif

                    <li class="active">{{trans("products.link_create")}}</li>
                </ol>
            </div>
            <div class="panel-body container-fluid">

                <div class="row row-lg">
                    {!! Form::open(['class'=>'form-horizontal labelbold','files'=>true]) !!}
                    <div class="col-sm-8">
                        <!-- Example Input Sizing -->
                        <div class="example-wrap">


                            <div class="form-group  form-material-lg">
                                <label class="col-sm-3 control-label" for="nameInput">
                                    {!! trans("products.label_name") !!}
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
                                    {!! trans("products.label_description") !!}
                                </label>
                                <div class="col-sm-9">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $locale=> $properties)
                                        <div class="form-group">
                                            <label class="control-label col-md-2"
                                                   for="description_{{$locale}}">{{$properties['native']}}</label>
                                            <div class="col-md-10">
                                                {!! Form::textarea("details[$locale]",old("details.$locale"),['class'=>'form-control','id'=>"description_$locale"]) !!}
                                                @if ($errors->has("details.$locale"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("details.$locale") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                                <div class="cleafix"></div>

                            </div>
                            <hr>
                            <div class="form-group required {{$errors->has('category')?'has-error':''}} form-material-lg">
                                <label class="col-sm-3 control-label" for="inputSizingLarge">
                                    {{trans('products.category')}}
                                </label>
                                <div class="col-sm-9">
                                    @if(count($categories))


                                        <select class="form-control select2" name="category">

                                            <option value=""></option>
                                            @foreach($categories as $cat)

                                                <option value="{{$cat->id}}" {{($cat->id==old('category'))?"selected":""}} >
                                                    {{$cat->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    @endif
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required {{$errors->has('type')?'has-error':''}} form-material-lg">
                                <label class="col-sm-3 control-label" for="inputSizingLarge">
                                    {{trans('products.label_type')}}
                                </label>
                                <div class="col-sm-9">
                                    @if(count($categories))


                                        <select class="form-control select2" name="type">

                                            <option value="" disabled>{{trans("products.select_product_type")}}</option>
                                            <option value="b2b">{{trans("products.option_type_b2b")}}</option>
                                            <option value="b2c">{{trans("products.option_type_b2c")}}</option>

                                        </select>
                                    @endif
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--<div class="form-group {{$errors->has('price')?'has-error':''}}">
                                <label class="col-sm-3 control-label" for="inputSizingLarge">
                                    {{trans('products.price')}}
                                </label>
                                <div class="col-sm-3">
                                    <input type="number" name="price" value="{{old("price")}}" class="form-control"
                                           min="0">
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('promotion')?'has-error':''}}">
                                <label class="col-sm-3 control-label" for="promotion">
                                    {{trans('products.promotion')}}
                                </label>
                                <div class="col-sm-3">
                                    <input type="number" id="promotion" name="promotion" value="{{old("promotion")}}"
                                           class="form-control"
                                           min="0">
                                    @if ($errors->has('promotion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('promotion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
--}}
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit"
                                        class="btn btn-primary waves-effect waves-light waves-effect waves-light">
                                    {{trans('main.submit')}}
                                </button>
                                <button type="reset" class="btn waves-effect waves-light waves-effect waves-light">
                                    {{trans('main.reset')}}
                                </button>
                            </div>

                        </div>
                        <!-- End Example Input Sizing -->
                    </div>
                    <div class="col-md-4 col-sm-4  {{$errors->has('photo')?'has-error':''}}"
                         data-ng-controller="manageUploaderCtrl"
                         upload-url="{{url($locale."/manage/products/upload")}}">
                        <h4 class="text-center">{{trans('products.photo')}}</h4>

                        <a href="javascript:;"
                           class="btn btn-default form-control btn btn-default"
                           ngf-select="uploadPhoto($files, $invalidFiles)"
                           ng-model="photo"
                           ngf-pattern="'image/*'"
                           ngf-accept="'image/*'"
                           ngf-max-size="10MB" ngf-min-height="100">
                            <i class="site-menu-icon md-cloud-upload"></i> Select</a>
                        @if ($errors->has('photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif
                        <div ng-repeat="f in photos" style="font:smaller">
                            <div class="">
                                <img ng-show="form.file.$valid" ngf-thumbnail="f" class="thumbnail img-thumbnail">
                                <a href="javascript:;" class="btn btn-danger" ng-click="removePhoto($index)"
                                   ng-show="photo">{{trans("main.btn_delete")}}</a>
                                <br>
                                <i ng-show="f.$error.required">*required</i>
                                <i ng-show="f.$error.maxSize">File too large
                                    <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                <input type="hidden" name="photo" value="<%f.result.file%>"
                                       ng-if="f && f.progress==100">
                                <div class="progress  active" ng-show="f.progress >= 0 &&f.progress < 100"
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
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section("footer-scripts")

@endsection