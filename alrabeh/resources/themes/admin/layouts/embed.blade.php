<html>
<head>
    {!! \Assets::css() !!}

    {!!

\Assets::add(asset(\Theme::url('plugins/bootstrap/dist/css/bootstrap.min.css')));
\Assets::add(asset(\Theme::url('plugins/font-awesome/css/font-awesome.min.css')));


 !!}

    @yield('css')
</head>

<body>

@include($view, $view_variables)

{!!


\Assets::add(asset(\Theme::url('plugins/jquery/dist/jquery.min.js')));
\Assets::add(asset(\Theme::url('plugins/bootstrap/dist/js/bootstrap.min.js')));

 !!}

{!! Assets::js() !!}

@yield('js')

</body>
</html>