<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | {{ \Settings::get('site_name', 'Modules') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.scripts.header')

    {!! Theme::css('css/auth-custom.css') !!}

    <style type="text/css">
        @if($background = \Settings::get('login_background'))
            {!! '.login-page, .register-page {'.$background.'}' !!}
        @endif
    </style>

    <style type="text/css">

        .has-feedback .form-control {
    padding-left: 42.5px !important;
    padding-right: 32px !important;

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
@include('components.modal',['id'=>'global-modal'])

@php \Actions::do_action('admin_footer_js') @endphp

@yield('js')



</body>
</html>
