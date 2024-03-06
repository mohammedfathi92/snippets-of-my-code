<!DOCTYPE html>
<html lang="{{ \Language::getCode() }}" dir="{{ \Language::getDirection() }}">
<head>
     {!! \SEO::generate() !!}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>educational</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 4 -->
     {!! Theme::css('roots/css/bootstrap.rtl.min.css') !!}
    <!-- Font Awesome -->
    {!! Theme::css('roots/css/font-awesome.min.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Theme style-->
    {!! Theme::css('css/style.css') !!}


    {!! Theme::css('css/style.rtl.css') !!}
    {!! Theme::css('css/responsive.css') !!}

</head>
<body>

<div class="login-wrap">
    <div >
        <h4 class="login-title">انشاء حساب جديد</h4>
    </div>
    <div class="login-content ">
        <div class="content-bottom">
            <form action="#" method="post">
                <div class="field-group">
                    <span class="fa fa-user" aria-hidden="true"></span>
                    <div class="login-field">
                        <input name="text1" id="text1" type="text" value="" placeholder="{{__('developnet-lms::attributes.inputs.input_name')}}" required>
                    </div>
                </div>
                <div class="field-group">
                    <span class="fa fa-lock" aria-hidden="true"></span>
                    <div class="login-field">
                        <input name="password" id="myInput" type="Password" placeholder="{{__('developnet-lms::attributes.inputs.input_password')}}">
                    </div>
                </div>
                <div class="field-group">
                    <span class="fa fa-lock" aria-hidden="true"></span>
                    <div class="login-field">
                        <input name="repassword" id="myInput2" type="Password" placeholder="{{__('developnet-lms::attributes.inputs.input_repeate_password')}}">
                    </div>
                </div>
                <div class="field-group">
                    <div class="check">
                        <label class="checkbox ">
                            <input type="checkbox" onclick="myFunction()">
                            <i> </i>اظهار كلمة السر</label>
                    </div>
                    <!-- script for show password -->
                    <script>
                        function myFunction() {
                            var x = document.getElementById("myInput");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                        }
                    </script>
                    <!-- //script for show password -->
                </div>
                <div class="login-field">
                    <input id="saveForm" name="saveForm" type="submit" value="{{__('developnet-lms::attributes.inputs.input_sign_up')}}" />
                </div>
                <ul class="list-login">
                    <li class="switch-login">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                            ا@lang('developnet-lms::labels.spans.span_keep_login')
                        </label>
                    </li>
                    <li>
                        <a href="#" class="text-right">@lang('developnet-lms::labels.links.link_forget_password')</a>
                    </li>
                    <li class="clearfix"></li>
                </ul>
            </form>
            <div class="goto-toggle">
                <center>
                    <a href="login.html">@lang('developnet-lms::labels.links.link_has_account')</a>
                </center>
            </div>
        </div>
    </div>

</div>
<div class="btm-footer">
	<div class="container">
		<div class="row">
          <div class="col-md-6">
            <p>Copyright ©2018. All Rights Reserved | designed by <a href="developnet.net" class="dvnet">DevelopNet</a></p>
          </div>
          <div class="col-md-6 btm-widgate text-right">
              <ul class="">
              	<li>
                  <a href="#">Home</a>
                </li>
                <li>
                  <a href="#">FAQ</a>
                </li>
                <li>
                  <a href="#">Help Desk</a>
                </li>
                <li>
                  <a href="#">Support</a>
                </li>
              </ul>
          </div>
        </div>
	</div>

</div>
<!-- jQuery JS-->
{!! Theme::js('roots/js/jquery.min.js') !!}
<!-- Bootstrap JS -->
{!! Theme::js('roots/js/bootstrap.min.js') !!}

</body>
</html>
