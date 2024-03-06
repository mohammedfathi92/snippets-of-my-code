  
@if(Session::has('message'))
{!! Theme::js('plugins/flash-message/bootstrap-flash-alert.js') !!}
   
<script type="text/javascript">
   var type = "{{ Session::get('alert_type', 'info') }}";
   var closeTime = 5000;
   @if(Session::get('alert_type') == 'danger')
   var title = "{{__('LMS::messages.labels.title_error')}}";
   var closeTime = 20000;
   @elseif(Session::get('alert_type') == 'success')
   var title = "{{__('LMS::messages.labels.title_success')}}";
   @else
   var title = "{{__('LMS::messages.labels.title_info')}}";
   @endif
  $ .alert("{!! __(Session::get('message')) !!}", {title: title, type: type,closeTime: closeTime, position: ['top-right', [-0.42, 0]],speed: 'normal'});

</script>
@endif


