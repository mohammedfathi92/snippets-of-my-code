@extends('frontend.layouts.master')

@section('content')

    <section class="header-video" id="search_container"
             style="background: url('/assets/video/Productive-Morning.jpg');">
        <div id="hero_video">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans("auth.reset_password")}}</div>

                            <div class="panel-body">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{ url("password/reset") }}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email"
                                               class="col-md-4 control-label">{{trans("auth.email_address")}}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email"
                                                   value="{{ $email or old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password"
                                               class="col-md-4 control-label">{{trans("auth.password")}}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password"
                                                   required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm"
                                               class="col-md-4 control-label">{{trans("auth.confirm_password")}}</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-video--media" data-video-src=""
             data-teaser-source="/assets/video/Productive-Morning" data-provider="Youtube" data-video-width="854"
             data-video-height="480"></div>
    </section><!-- End Header video -->
@endsection
@section("scripts")
    <script src="/assets/js/modernizr.js"></script>
    <script src="/assets/js/video_header.js"></script>
    <script>

        $(document).ready(function () {

            HeaderVideo.init({
                container: $('.header-video'),
                header: $('.header-video--media'),
                videoTrigger: $("#video-trigger"),
                autoPlayVideo: false
            });

        });
    </script>
@stop