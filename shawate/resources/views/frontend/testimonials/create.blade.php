@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("testimonials.frontend_create_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>

                <li><a href="{{url("/testimonials")}}">{{trans("testimonials.link_testimonials")}}</a></li>

                <li class="active">{{trans("testimonials.frontend_create_page_header")}}</li>

            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">
        <div class="col-sms-6 col-sm-8 col-md-9">
            <div class="testimonial-section travelo-box">
                @if($errors->count())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if($alert_type=Session::get("alert-type"))
                    <div class="alert alert-{{$alert_type=="success"?"success":"danger"}}">
                        <p>{{Session::get("message")}}</p>
                    </div>
                @endif
                {!! Form::open() !!}

                <div class="person-information">
                    <h2>{{trans("testimonials.personal_information_heading")}}</h2>
                    <div class="form-group row ">
                        <div class="col-sm-6 col-md-6 {{$errors->has("name")?"has-error":''}}">
                            <label>{{trans("testimonials.label_name")}}</label>
                            <input type="text" name="name" class="input-text full-width" value="{{old("name")}}"
                                   placeholder=""/>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-6 {{$errors->has("email")?"has-error":''}}">
                            <label>{{trans("testimonials.label_email")}}</label>
                            <input type="email" name="email" class="input-text full-width" value="{{old("email")}}"
                                   placeholder=""/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-md-6 ">
                            <label>{{trans("testimonials.label_nationality")}}</label>

                            <input type="text" name="nationality" class="input-text full-width"
                                   value="{{old("nationality")}}"
                                   required
                                   placeholder=""/>

                            @if ($errors->has('nationality'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-6 {{$errors->has("country")?"has-error":''}}">
                            <label for="country">{{trans("testimonials.label_country")}}</label>
                            <div class="selector">
                                <select name="country" id="country">
                                    @foreach(\App\Country::published()->get() as $country)
                                        <option value="{{$country->id}}" {{old("country")==$country->id?"selected":""}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('country'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="trip_type"
                                   class="control-label">{{trans("testimonials.label_trip_type")}}</label>
                            <div class="selector">
                                <select name="trip_type" id="trip_type">
                                    <options value=""></options>
                                    <option value="1">{{trans_choice("testimonials.trip_type_options",1)}}</option>
                                    <option value="2">{{trans_choice("testimonials.trip_type_options",2)}}</option>
                                    <option value="3">{{trans_choice("testimonials.trip_type_options",3)}}</option>
                                    <option value="4">{{trans_choice("testimonials.trip_type_options",4)}}</option>
                                    <option value="5">{{trans_choice("testimonials.trip_type_options",5)}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 ">
                            <label for="avatar"
                                   class="control-label">{{trans("testimonials.label_your_avatar")}}</label>
                            <div class=""
                                 data-ng-controller="uploaderCtrl"
                                 data-upload-url="{{url("$locale/upload")}}"
                                 data-resize="200,150"
                                 data-prefix="testimonial_avatar_"
                            >

                                <div class="">
                                    <div ng-repeat="f in photos">
                                        <div class="thumbnail">
                                            <img ng-show="form.avatar.$valid" ngf-thumbnail="f"
                                                 class=" img-thumbnail">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removePhoto($index)"
                                               ng-show="avatar">{{trans("main.btn_delete")}}</a>
                                            <br>
                                            <i ng-show="f.$error.required">*required</i>
                                            <i ng-show="f.$error.maxSize">File too large
                                                <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                            <input type="hidden" name="avatar" value="<%f.result.file%>"
                                                   ng-if="f && f.progress==100">
                                            <div class="progress  active" ng-show="f.progress >= 0"
                                                 ng-hide="f.progress==100"
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
                                    <div class="clearfix"></div>
                                    <a id="photo"
                                       class="btn btn btn-default"
                                       ngf-select="uploadPhoto($files, $invalidFiles)"
                                       ng-model="avatar"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'image/*'"
                                       ngf-max-size="10MB">
                                        <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                                    </a>

                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group">
                        <label>{{trans("testimonials.label_title")}}</label>
                        <input type="text" name="title" class="form-control" value="{{old("title")}}">
                    </div>
                    <div class="form-group row {{$errors->has("description")?"has-error":''}}">
                        <div class="col-md-12">
                            <label>{{trans("testimonials.label_description")}}</label>
                            <div>
                                <textarea name="description" id="description" rows="10"
                                          class="form-control ckeditor">{{old("description")}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>

                        </div>


                    </div>

                    <div class="form-group  {{$errors->has("gallery")?"has-error":''}}">
                        <label for="gallery" class="control-label">{{trans("testimonials.label_gallery")}}</label>
                        <div class=""
                             data-ng-controller="uploaderCtrl"
                             data-upload-url="{{url("$locale/upload")}}"
                             data-resize="200,150"
                             data-prefix="testimonial_gallery_"
                        >

                            <div class="">
                                <div ng-repeat="f in photos">
                                    <div class="thumbnail col-md-4 col-sm-6">
                                        <img ng-show="form.gallery.$valid" ngf-thumbnail="f"
                                             class=" img-thumbnail">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removePhoto($index)"
                                           ng-show="gallery">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="gallery[]" value="<%f.result.file%>"
                                               ng-if="f && f.progress==100">
                                        <div class="progress  active" ng-show="f.progress >= 0"
                                             ng-hide="f.progress==100"
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
                                <div class="clearfix"></div>
                                <a id="gallery"
                                   class="btn btn-default"
                                   ngf-select="uploadPhoto($files, $invalidFiles)"
                                   ng-model="gallery"
                                   ngf-pattern="'image/*'"
                                   ngf-accept="'image/*'"
                                   ngf-max-size="10MB"
                                   ngf-keep="true"
                                   ngf-multiple="true"
                                >
                                    <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                                </a>

                                @if ($errors->has('gallery'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('gallery') }}</strong>
                            </span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                {!! ReCaptcha::render(['lang' => $locale]) !!}
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <button type="submit"
                                class="full-width btn-large">{{trans("testimonials.btn_confirm_testimonial")}}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="sidebar col-sm-4 col-md-3">
            <div class="travelo-box filters-container faq-topics">

                <h4 class="box-title">{{trans("testimonials.title_all_destinations")}}</h4>
                <ul class="triangle filters-option">
                    <li class="{{(!Request::segment(3))?"active":""}}"><a
                                href="{{url("testimonials")}}">{{trans("testimonials.title_all_destinations")}}</a></li>
                    @foreach(\App\Country::published()->get() as $c)
                        <li class="{{($c->id==Request::segment(4))?"active":""}}"><a
                                    href="{{url("testimonials/destination/$c->id/".str_slug($c->{"name:en"}))}}">{{trans("testimonials.travelers_to_country",["country"=>$c->name])}}</a>
                        </li>
                    @endforeach

                </ul>
                <a href="{{url("testimonials/create")}}"
                   class="btn btn-success full-width">{{trans("testimonials.frontend_btn_create")}}</a>
            </div>
            @if(Settings::get('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                    <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>
                </div>
            @endif
        </div>
    </div>

@endsection
@section("scripts")
    <script type="text/javascript" src="/assets/components/tinymce/tinymce.min.js"></script>
@stop