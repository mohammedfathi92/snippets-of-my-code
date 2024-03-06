<html>
<head>
    {!! \Assets::css() !!}
    @yield('css')
</head>

<body>

@include($view, $view_variables)

{!! Assets::js() !!}

@yield('js')

</body>
</html>