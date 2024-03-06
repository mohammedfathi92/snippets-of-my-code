<!-- jQuery 3 -->
{!! Theme::js('plugins/jquery/dist/jquery.min.js') !!}
<!-- jQuery UI 1.1 -->
{!! Theme::js('plugins/jQueryUI/jquery-ui.min.js') !!}
<!-- Bootstrap 3.3.7 -->
{!! Theme::js('plugins/bootstrap/dist/js/bootstrap.min.js') !!}

{!! Assets::js() !!}

<!-- iCheck -->
{!! Theme::js('plugins/iCheck/icheck.min.js') !!}
<!-- Pace -->
{!! Theme::js('plugins/pace/pace.min.js') !!}

<!-- Jquery BlockUI -->
{!! Theme::js('plugins/jquery-block-ui/jquery.blockUI.min.js') !!}

<!-- Ladda -->
{!! Theme::js('plugins/Ladda/spin.min.js') !!}
{!! Theme::js('plugins/Ladda/ladda.min.js') !!}

<!-- toastr -->
{!! Theme::js('plugins/toastr/toastr.min.js') !!}
<!-- SlimScroll -->
{!! Theme::js('plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
<!-- FastClick -->
{!! Theme::js('plugins/fastclick/lib/fastclick.js') !!}

{!! Theme::js('plugins/sweetalert2/dist/sweetalert2.all.min.js') !!}
{!! Theme::js('plugins/select2/dist/js/select2.full.min.js') !!}


<!-- AdminLTE App -->
{!! Theme::js('js/adminlte.min.js') !!}

{!! Theme::js('js/functions.js') !!}
{!! Theme::js('js/main.js') !!}
<!-- corals js -->
{!! Theme::js('plugins/lodash/lodash.js') !!}
{!! \Html::script('assets/modules/plugins/lightbox2/js/lightbox.min.js') !!}
{!! \Html::script('assets/modules/plugins/clipboard/clipboard.min.js') !!}
{!! \Html::script('assets/modules/js/modules_functions.js') !!}
{!! \Html::script('assets/modules/js/modules_main.js') !!}
{!! Theme::js('js/intlTelInput.min') !!}
{!! Theme::js('js/scripts.js') !!}


@include('Modules::modules_main')

@yield('js')
@stack('js')

@php  \Actions::do_action('admin_footer_js') @endphp

@include('partials.notifications')
