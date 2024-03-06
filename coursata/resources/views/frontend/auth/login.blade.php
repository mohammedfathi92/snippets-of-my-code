@extends('frontend.layouts.master')

@section("page_title")

@endsection

@section('content')
    <section class="header-video" id="search_container">
        <div id="hero_video">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        <div id="login">
                            <div class="text-center"><img src="{{Storage::url(Settings::get("logo"))}}" alt="{{Settings::get("title")}}" data-retina="true" style="height: 50px" ></div>
                            <hr>

                          {{--   <div class="row">
                                <div class="col-md-6 col-sm-6 login_social">
                                    <a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
                                </div>
                                <div class="col-md-6 col-sm-6 login_social">
                                    <a href="#" class="btn btn-info btn-block "><i class="icon-twitter"></i>Twitter</a>
                                </div>
                            </div>  --}}
                            <!-- end row -->
                           {{--  <div class="login-or"><hr class="hr-or"><span class="span-or">{{trans("auth.or_wo")}}</span></div>
 --}}
                            <!-- login form -->
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}


                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>{{trans("auth.email")}} </label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"  class=" form-control " placeholder="{{trans("auth.email")}} " required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>{{trans("auth.password")}} </label>
                                    <input id="password" type="password"  name="password"  class=" form-control" placeholder="{{trans("auth.password")}} " required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 col-sm-6 ">
                                        <p class="small">
                                            <a href="password/reset"> {{trans("auth.forgot_pass")}}</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} > {{trans("auth.remember_me" )}}
                                        </label>
                                    </div>



                                </div>
                                <button class="btn_full" type="submit">{{trans("auth.login" )}}</button>
                            </form>
                            <a href="{{url("register")}}" class="btn_full_outline"> {{trans("auth.register" )}}</a>


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