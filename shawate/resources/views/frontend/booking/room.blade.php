@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("bookings.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("bookings.frontend_page_header")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="row">
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
                {!! Form::open(["action"=>"BookingController@store"]) !!}
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
                        <div class="col-sm-6 col-md-5 {{$errors->has("hotel_id")?"has-error":''}}">
                            <label for="country">{{trans("bookings.label_hotel")}}</label>
                            @if($hotel)
                                <div class="col-md-2">
                                    <a href="{{url("/hotels/$hotel->id/".str_slug($hotel->{"name:en"}))}}"
                                       target="_blank">
                                        <img src="{{url("files/{$hotel->photo}?size=50,50")}}" alt="{{$hotel->name}}">
                                        <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <a href="{{url("/hotels/$hotel->id/".str_slug($hotel->{"name:en"}))}}"
                                       target="_blank">{{$hotel->name}}</a>
                                </div>
                            @endif
                            @if ($errors->has('hotel_id'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('hotel_id') }}</strong>
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
                        <div class="col-sm-6 col-md-5 {{$errors->has("room_id")?"has-error":''}}">
                            <label for="country">{{trans("bookings.label_room")}}</label>
                            @if($room)
                                <div class="col-md-2">
                                    <a href="{{url("/hotels/$hotel->id/".str_slug($hotel->{"name:en"}))}}"
                                       target="_blank">
                                        <img src="{{url("files/{$room->photo}?size=50,50")}}" alt="{{$room->name}}">
                                        <input type="hidden" name="room_id" value="{{$room->id}}">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <a href="{{url("/hotels/$hotel->id/".str_slug($room->name))}}"
                                       target="_blank">{{$room->name}}</a>
                                </div>
                            @endif
                            @if ($errors->has('room_id'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('room_id') }}</strong>
                                        </span>
                            @endif
                        </div>
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
                <input type="hidden" name="booking_type" value="room">
                {!! ReCaptcha::render(['lang' => $locale]) !!}
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
            @if(Settings::get('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! Settings::get("{$locale}_help_box_title") !!}</h4>
                    <p> {!! Settings::get("{$locale}_help_box_details") !!}</p>

                </div>
            @endif
        </div>
    </div>

@stop
@section("scripts")
    <script>

        (function($){
            $(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
        })(jQuery);
    </script>
@stop