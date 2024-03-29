<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | {{ \Settings::get('site_name', 'Packages') }}</title>

    <link rel="shortcut icon" href="{{ \Settings::get('site_favicon') }}" type="image/png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.scripts.header')

    @yield('css')

    {!! \Assets::css() !!}

</head>
<body class="skin-purple-light {{ isset($hide_sidebar) && $hide_sidebar?'sidebar-hidden':'sidebar-mini'}}">


@yield('content')



@include('partials.scripts.footer')



{!! Assets::js() !!}


@php  \Actions::do_action('admin_footer_js') @endphp


@yield('js')


</body>
</html>