@extends('frontend.layouts.master')
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("messages.frontend_page_header")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{url("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("messages.link_contact_us")}}</li>
            </ul>
        </div>
    </div>
@stop
@section("content")
    @if($settings->geo_location)
        <div class="travelo-google-map block"></div>
    @else
        <div class="block">
            @if($settings->map_background)
                <img class="img-responsive lazy" src="{{url("files/{$settings->map_background}?size=1200,255")}}"
                     alt="">
            @endif
        </div>
    @endif

    @if(Session::get('alert-type')=="success")
        <div class="alert alert-success">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    <div class="contact-address row block">
        <div class="col-md-4">
            <div class="icon-box style5">
                <i class="soap-icon-phone"></i>
                <div class="description">
                    <small>{{trans("messages.info_phone_number")}}</small>
                    <h5>+601133000554</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="icon-box style5">
                <i class="soap-icon-message"></i>
                <div class="description">
                    <small>{{trans("messages.info_email")}}</small>
                    <h5>info@shawatetravel.com</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="icon-box style5">
                <i class="soap-icon-address"></i>
                <div class="description">
                    <small>{{trans("messages.info_address")}}</small>
                    <h5>malaysia - penang</h5>
                </div>
            </div>
        </div>
    </div>
    @if($settings->info)
        <div class="travelo-box box-full">{!! $settings->info !!}</div>
    @endif
    <div class="travelo-box box-full">
        <div class="contact-form">
            <h2>{{trans("messages.title_send_message")}}</h2>
            {!! Form::open() !!}
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group {{$errors->has("name")?"has-error":''}}">
                        <label>{{trans("messages.label_your_name")}} *</label>
                        <input type="text" name="name" class="input-text full-width">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has("email")?"has-error":''}}">
                        <label>{{trans("messages.label_your_email")}} *</label>
                        <input type="text" name="email" class="input-text full-width">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                        @endif
                    </div>
                    @if($settings->show_mobile)
                        <div class="form-group {{$errors->has("mobile")?"has-error":''}}">
                            <label>{{trans("messages.label_mobile")}} {{$settings->mobile_required?"*":""}}</label>
                            <input type="text" name="mobile" class="input-text full-width">
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                            @endif
                        </div>
                    @endif
                    @if($settings->show_country)
                        <div class="form-group {{$errors->has("country")?"has-error":''}}">
                            <label>{{trans("messages.label_country")}} {{$settings->country_required?"*":""}}</label>
                            <input type="text" name="country" class="input-text full-width">
                            @if ($errors->has('country'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                            @endif
                        </div>
                    @endif

                </div>
                <div class="col-sm-8">
                    <div class="form-group {{$errors->has("subject")?"has-error":''}}">
                        <label>{{trans("messages.label_subject")}} *</label>
                        <input type="text" name="subject" class="input-text full-width">
                        @if ($errors->has('subject'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has("message")?"has-error":''}}">
                        <label>{{trans("messages.label_message")}} *</label>
                        <textarea name="message" rows="8" class="input-text full-width"
                                  placeholder="{{trans("messages.message_box_placeholder")}}"></textarea>
                        @if ($errors->has('message'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-sms-offset-6 col-sm-offset-6 col-md-offset-8 col-lg-offset-9">
                <button class="btn-medium full-width">{{trans("messages.btn_send_message")}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@stop
@section("scripts")
    @if($settings->geo_location)
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyA-pZGejiZpnxwuELxEB52gSv_t96kPgio"></script>
        <script type="text/javascript" src="{{url("/js/gmap3.min.js")}}"></script>
        <script type="text/javascript">
            tjq(".travelo-google-map").gmap3({
                map: {
                    options: {
                        center: "{{$settings->geo_location}}".split(","),
                        zoom: 12
                    }
                },
                marker: {
                    values: [
                        {latLng: "{{$settings->geo_location}}".split(",")}

                    ],
                    options: {
                        draggable: false
                    },
                }
            });
        </script>
    @endif
@stop