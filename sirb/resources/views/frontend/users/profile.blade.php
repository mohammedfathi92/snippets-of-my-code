@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("users.title_user_profile")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("bookings.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-sms-6 col-sm-8 col-md-9">
            <div class="booking-section travelo-box">
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
                {!! Form::open(['url'=>route('update_profile'),'method'=>'PUT','files'=>true]) !!}
                <div class="person-information">
                    <h2>{{trans("bookings.personal_information_heading")}}</h2>
                    <div class="form-group row ">
                        <div class="col-sm-6 col-md-10 {{$errors->has("name")?"has-error":''}}">
                            <label>{{trans("users.label_name")}}</label>
                            <input type="text" required name="name" class="input-text full-width text-rtl" value="{{old("name", $user->name)}}"
                                   placeholder=""/>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                            @endif
                        </div>
                     

                    </div>
                    <div class="form-group row">
                          <div class="col-sm-6 col-md-5 {{$errors->has("email")?"has-error":''}}">
                            <label>{{trans("users.label_email")}}</label>
                            <input type="email" required name="email" class="input-text full-width" value="{{old("email", $user->email)}}"
                                   placeholder=""/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-5 {{$errors->has("mobile")?"has-error":''}}">
                            <label>{{trans("bookings.label_mobile")}}</label>
                            <input type="tel"  name="mobile" class="input-text full-width"
                                   value="{{old("mobile", $user->mobile)}}"
                                   placeholder="+55 5555555" dir="ltr"/>

                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                

  <div class="form-group row ">
                        <div class="col-sm-6 col-md-5 {{$errors->has('password')?"has-error":''}}">
                            <label>{{trans("users.label_password")}}</label>
                            <input type="password" name="password" class="input-text full-width" value="{{old('password')}}"
                                   placeholder=""/>
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                        </div>
                        <div class="col-sm-6 col-md-5 {{$errors->has("password_confirmation")?"has-error":''}}">
                            <label>{{trans("users.label_password_confirmation")}}</label>
                            <input type="password_confirmation" name="password_confirmation" class="input-text full-width" value="{{old('password_confirmation')}}"
                                   placeholder=""/>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                            @endif
                        </div>

                    </div>


                    <div class="form-group row {{$errors->has("about")?"has-error":''}}">
                        <div class="col-md-12">
                            <label>{{trans("users.label_about")}}</label>
                            <div>
                                <textarea name="about" id="about" class="form-control text-rtl">{{old("about")}}</textarea>
                                @if ($errors->has('about'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('about') }}</strong>
                                        </span>
                                @endif
                            </div>

                        </div>


                    </div>
                </div>
                <hr/>
                <input type="hidden" name="booking_type" value="free">
{{--                {!! ReCaptcha::render(['lang' => $locale]) !!}--}}
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <button type="submit"
                                class="full-width btn-large">{{trans("main.btn_save_changes")}}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="sidebar col-sms-6 col-sm-4 col-md-3">
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>

                </div>
            @endif
        </div>
    </div>

@stop