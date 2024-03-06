@extends('frontend.layouts.master')
@section("content")

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{url('/')}}">{{trans('users.home_page')}}</a></li>
                <li>{{trans('users.my_account')}}</li>
            </ul>
        </div>
    </div><!-- End Position -->
    @if(Session::has("message"))
        @if(Session::get("alert-type")=="error")
            <div class="alert alert-danger">{!! Session::get("message") !!}</div>
        @endif

        @if(Session::get("alert-type")=="success")
            <div class="alert alert-success">{!! Session::get("message") !!}</div>
        @endif
    @endif
    <main>
        <div class="margin_60 container">
            <aside class="col-md-2" id="sidebar">
        <div class="theiaStickySidebar">
        <div class="box_style_cat">
            @include('frontend.users.side_menu')
         
            </div>
        </div><!--End sticky -->
        </aside>
        <div class="col-md-10 add_bottom_15">
            <div id="tabs" class="tabs">
               
             
                <div class="content" style="background-color: #fff; padding: 10px;">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 add_bottom_30">
                                <h4>{{trans('users.edit_settings_title')}}</h4>
                                <hr>
                                <form role="form" method="POST"
                                      action="{{ route('user_settings_update', ['id' => $data->id]) }}">
                                    <input name="_method" type="hidden" value="PUT">
                                    {{ csrf_field() }}
                                    <div class="row">
                                    <div class="col-md-6 form-group {{$errors->has('email')?'has-error':''}}">
                                        <label>{{trans('users.label_email')}}</label>
                                        <input class="form-control" name="email" id="email" type="email"
                                               placeholder="{{trans('users.label_email')}}"
                                               value="{{old('email',$data->email)}}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-md-6 form-group {{$errors->has('password')?'has-error':''}}">
                                        <label>{{trans('users.label_new_password')}}</label>
                                        <input class="form-control" name="password" id="new_password" type="password"
                                               placeholder="{{trans('users.label_new_password')}}">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group {{$errors->has('password_confirmation')?'has-error':''}}">
                                        <label>{{trans('users.label_password_confirmation')}}</label>
                                        <input class="form-control" name="password_confirmation" id="password_confirmation"
                                               type="password" placeholder="{{trans('users.label_password_confirmation')}}">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                    </div>
                                    <button type="submit"
                                            class="btn_1 green">{{trans('users.btn_update_settings')}}</button>

                                </form>
                            </div>
                        </div><!-- End row -->

                    

                 

                </div><!-- End content -->
            </div><!-- End tabs -->
        </div>

        </div><!-- end container -->
    </main>



@stop

@section("styles")

    <!-- CSS -->
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
    <style type="text/css">
        a .btn_3 {background-color: #e04f67; color: #fff;}
    </style>
    <style>
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    
    .table > tbody > tr > .no-line {
        border-top: none;
    }
    
    .table > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    </style>
    
@stop

@section("scripts")

   
    
    <!-- Date and time pickers -->
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', '');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>

    <script>

   

</script>
 <!-- Fixed sidebar -->
<script src="/assets/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<!-- Cat nav mobile -->
<script  src="/assets/js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>


@stop