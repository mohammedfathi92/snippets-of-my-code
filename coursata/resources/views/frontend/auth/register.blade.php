@extends('frontend.layouts.master')

@section("page_title")

@endsection

@section('content')
    <section class="header-video" id="search_container" style="background: url('/assets/video/Productive-Morning.jpg'); height: 480px">
        <div id="hero_video">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        <div id="login">
                            <div class="text-center"><img src="{{Storage::url(Settings::get("logo"))}}"
                                                          alt="{{Settings::get("title")}}" data-retina="true"
                                                          style="height: 50px"></div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 login_social">
                                    <a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
                                </div>
                                <div class="col-md-6 col-sm-6 login_social">
                                    <a href="#" class="btn btn-info btn-block "><i class="icon-twitter"></i>Twitter</a>
                                </div>
                            </div> <!-- end row -->
                            <div class="login-or">
                                <hr class="hr-or">
                                <span class="span-or">{{trans("auth.or_wo")}}</span></div>

                            <!-- login form -->
                            <form role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="row nomargin-bottom">
                              <div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('first_name') ? ' has-error' : '' }}">


                                    <label for="first_name">{{trans("auth.first_name" )}}</label>
                                    <input type="text" class=" form-control" placeholder="{{trans("auth.first_name" )}}"
                                           name="first_name" value="{{ old('first_name') }}" autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            

                                
                              <div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('last_name') ? ' has-error' : '' }}">


                                    <label for="last_name">{{trans("auth.last_name" )}}</label>
                                    <input type="text" class=" form-control" placeholder="{{trans("auth.last_name" )}}"
                                           name="last_name" value="{{ old('last_name') }}" autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                               
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                    <label for="email">{{trans("auth.email" )}}</label>
                                    <input type="email" class=" form-control" placeholder="{{trans("auth.email" )}}"
                                           name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Password</label>
                                    <input type="password" class=" form-control" id="password1" name="password"
                                           placeholder="{{trans("auth.password" )}}">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm">{{trans("auth.confirm_password" )}}</label>
                                    <input type="password" class=" form-control" id="password2"
                                           name="password_confirmation"
                                           placeholder="{{trans("auth.confirm_password" )}}">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div id="pass-info" class="clearfix"></div>
                                <button class="btn_full" type="submit">{{trans("auth.create_account" )}}</button>


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