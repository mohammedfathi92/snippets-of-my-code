@extends('frontend.layouts.master')

@section('content')
    <section class="header-video" id="search_container"
             style="background: url('/assets/video/Productive-Morning.jpg');">
        <div id="hero_video">
            <div class="container">
                <div class="row">
                    <div id="login">
                        <p style="text-align: center; font-weight: bold; font-size: 19px;">{{trans("auth.reset_password")}}</p>
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form-horizontal" role="form" method="post"
                                  action="{{ url(LaravelLocalization::getCurrentLocale()."/password/email") }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">{{trans("auth.email_address")}}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn_full">
                                            {{trans("auth.send_pass_link")}}
                                        </button>
                                    </div>
                                </div>
                            </form>
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
