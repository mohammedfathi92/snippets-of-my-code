<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | {{ \Settings::get('site_name', 'Packages') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.scripts.header')

    <style type="text/css">
        body {
            color: #f8e8e7;
        }

        a {
            color: #3fc3ee;
        }

        .login-box-body, .register-box-body {
            background: #1D2939;
            padding: 20px;
            color: #f8e8e7;
            border: #000 solid 1px;
            border-bottom-right-radius: 50px;
        }

        .login-page, .register-page {
        @if($background = \Settings::get('login_background'))
          {{ $background }}
        @endif






        }

        .login-box, .register-box {
            margin: 6% auto;
        }

        html, body {
            height: auto;
        }
    </style>

    @yield('css')
    <style type="text/css">
        {!! \Settings::get('custom_admin_css', '') !!}
    </style>
</head>
<body class="hold-transition login-page no-block-ui">

<!-- Main content -->
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo text-center">
            <a href="{{ url('/') }}">
                <img class="site_logo img-responsive m-t-20"
                     style="max-width: 290px; margin: 0 auto;"
                     src="{{ \Settings::get('site_logo') }}">
            </a>
        </div>
        @yield('content')
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.content -->

@include('partials.scripts.footer')

@php \Actions::do_action('admin_footer_js') @endphp


@yield('js')

</body>
</html>