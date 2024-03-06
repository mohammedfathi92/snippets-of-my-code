@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("booking",$localeCode)}}"/>
        @endif
    @endforeach

@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("bookings.frontend_page_header")}}</h2>
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
                {!! Form::open() !!}
                <div class="person-information">
                    <h2>{{trans("bookings.personal_information_heading")}}</h2>
                    <div class="form-group row ">
                        <div class="col-sm-6 col-md-5 {{$errors->has("name")?"has-error":''}}">
                            <label>{{trans("bookings.label_name")}}</label>
                            <input type="text" name="name" class="input-text full-width" value="{{old("name")}}"
                                   placeholder=""/>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-5 {{$errors->has("email")?"has-error":''}}">
                            <label>{{trans("bookings.label_email")}}</label>
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
                        <div class="col-sm-6 col-md-5 {{$errors->has("nationality")?"has-error":''}}">
                            <label>{{trans("bookings.label_nationality")}}</label>
                            <div class="selector">
                                <input type="text" name="nationality" class="input-text full-width"
                                       value="{{old("nationality")}}"
                                       required min="3" max="50"
                                       placeholder=""/>
                                @if ($errors->has('nationality'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5 {{$errors->has("mobile")?"has-error":''}}">
                            <label>{{trans("bookings.label_mobile")}}</label>
                            <input type="tel" required name="mobile" class="input-text full-width"
                                   value="{{old("mobile")}}"
                                   placeholder="+55 5555555" dir="ltr"/>

                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-md-5 {{$errors->has("country")?"has-error":''}}">
                            <label for="country">{{trans("bookings.label_country")}}</label>
                            <div class="selector">
                                <select name="country" id="country">
                                    @foreach(\Sirb\Country::published()->get() as $country)
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
                        <div class="col-sm-6 col-md-6 ">
                            <div class="col-sm-6 col-md-5 {{$errors->has("date_from")?"has-error":''}}">
                                <label>{{trans("bookings.label_arrival_date")}}</label>
                                <div class="datepicker-wrap">
                                    <input type="text" name="date_from" class="input-text full-width datepicker"
                                           value="{{old("date_from")}}"
                                           required
                                           placeholder=""/>
                                </div>
                                @if ($errors->has('date_from'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('date_from') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="col-sm-6 col-md-5  {{$errors->has("date_to")?"has-error":''}} ">
                                <label>{{trans("bookings.label_departure_date")}}</label>
                                <div class="datepicker-wrap">
                                    <input type="text" required name="date_to"
                                           class="input-text full-width datepicker" value="{{old("date_to")}}"
                                           placeholder=""/>
                                </div>
                                @if ($errors->has('date_to'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('date_to') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-md-5">
                            <label>{{trans("bookings.label_num_persons")}}</label>
                            <div class="col-md-6  {{$errors->has("num_adults")?"has-error":''}}">
                                <input type="number" name="num_adults" class="input-text full-width "
                                       value="{{old("num_adults",1)}}" min="1"
                                       required
                                       placeholder="{{trans("bookings.label_num_adult")}}"/>
                                @if ($errors->has('num_adults'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('num_adults') }}</strong>
                                        </span>
                                @endif

                            </div>
                            <div class="col-md-6  {{$errors->has("num_children")?"has-error":''}}">
                                <input type="number" name="num_children"
                                       class="input-text full-width" value="{{old("num_children")}}"
                                       min="0"
                                       placeholder="{{trans("bookings.label_num_childes")}}"/>
                                @if ($errors->has('num_children'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('num_children') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-5  {{$errors->has("num_bags")?"has-error":''}}">
                            <label>{{trans("bookings.label_num_bags")}}</label>
                            <div class="">
                                <input type="number" name="num_bags" class="input-text full-width"
                                       value="{{old("num_bags",1)}}"
                                       min="1"
                                       max="100"
                                       placeholder=""/>
                                @if ($errors->has('num_bags'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('num_bags') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-md-5">
                            <label>{{trans("bookings.label_num_rooms")}}</label>
                            <div class="">
                                <input type="number" name="num_rooms" class="input-text full-width"
                                       value="{{old("num_rooms",1)}}"
                                       min="1"
                                       max="100"
                                       placeholder=""/>
                                @if ($errors->has('num_rooms'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('num_rooms') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-md-5  {{$errors->has("package_type")?"has-error":''}}">
                            <label>{{trans("bookings.label_package_type")}}</label>
                            <div class="selector">
                                <select name="package_type" id="package_type">

                                        {{--<option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option> --}}
                                          <option value="program" {{old("package_type")=="program"?"selected":""}}>{{trans("packages.package_type_option.program")}}</option>
                                          <option value="hotels" {{old("package_type")=="hotels"?"selected":""}}>{{trans("packages.package_type_option.hotels")}}</option>
                                          <option value="local_fly" {{old("package_type")=="local_fly"?"selected":""}}>{{trans("packages.package_type_option.local_fly")}}</option>
                                          <option value="transport" {{old("package_type")=="transport"?"selected":""}}>{{trans("packages.package_type_option.transport")}}</option>
                                          <option value="tours" {{old("package_type")=="tours"?"selected":""}}>{{trans("packages.package_type_option.tours")}}</option>
                                          <option value="hotels_local_fly" {{old("package_type")=="hotels_local_fly"?"selected":""}}>{{trans("packages.package_type_option.hotels_local_fly")}}</option>
                                          <option value="hotels_fly_main_transport" {{old("package_type")=="hotels_fly_main_transport"?"selected":""}}>{{trans("packages.package_type_option.hotels_fly_main_transport")}}</option>
                                          <option value="hotels_main_transport" {{old("package_type")=="hotels_main_transport"?"selected":""}}>{{trans("packages.package_type_option.hotels_main_transport")}}</option>
                                           <option value="fly_main_transport" {{old("package_type")=="fly_main_transport"?"selected":""}}>{{trans("packages.package_type_option.fly_main_transport")}}</option>
                                            <option value="tours_transport" {{old("package_type")=="tours_transport"?"selected":""}}>{{trans("packages.package_type_option.tours_transport")}}</option>

                                </select>
                            </div>
                            @if ($errors->has('package_type'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('package_type') }}</strong>
                                        </span>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-5  {{$errors->has("hotel_level")?"has-error":''}}">
                            <label>{{trans("bookings.label_hotels_level")}}</label>
                            <div class="selector">
                                <select name="hotel_level" id="hotels_level">
                                    <option value="1" {{old("hotel_level")==1?"selected":""}} >{{trans_choice("hotels.hotel_stars_option",1)}}</option>
                                    <option value="2" {{old("hotel_level")==2?"selected":""}} >{{trans_choice("hotels.hotel_stars_option",2)}}</option>
                                    <option value="3" {{old("hotel_level")==3?"selected":""}} >{{trans_choice("hotels.hotel_stars_option",3)}}</option>
                                    <option value="4" {{old("hotel_level")==4?"selected":""}} >{{trans_choice("hotels.hotel_stars_option",4)}}</option>
                                    <option value="5" {{old("hotel_level")==5?"selected":""}} >{{trans_choice("hotels.hotel_stars_option",5)}}</option>
                                </select>
                            </div>
                            @if ($errors->has('hotel_level'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('hotel_level') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{$errors->has("notes")?"has-error":''}}">
                        <div class="col-md-12">
                            <label>{{trans("bookings.label_notes")}}</label>
                            <div>
                                <textarea name="notes" id="notes" class="form-control">{{old("notes")}}</textarea>
                                @if ($errors->has('notes'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('notes') }}</strong>
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
                                class="full-width btn-large">{{trans("bookings.btn_confirm_booking")}}</button>
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
