

<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>



<div class='embed-container embededWrapper'{{--  style="max-height: 100vw;" --}}>
	<iframe src='{{$ifram_url}}' frameborder='0' allowfullscreen></iframe>
</div>

@if($ajax)

<script type="text/javascript">
	 $( function() {
	 var height = $(window).height() * 0.8;
	 $('.embededWrapper').find('iframe').attr('src','{{$ifram_url}}');
	 // var height = $('#showQuizModal').find('.modal-body').css('min-height');
	
	 $('.embededWrapper').css({"max-height": height, "min-height": height, "min-width": '100%'});
	 });
</script>
@else

@push('child_scripts')

<script type="text/javascript">
	 $( function() {
	 var height = $(window).height();
	 $('.embededWrapper').find('iframe').attr('src','{{$ifram_url}}').css({"max-height": height, "min-height": height, "min-width": '100%'});
	 // var height = $('#showQuizModal').find('.modal-body').css('min-height');
	
	 $('.embededWrapper').css({"max-height": height, "min-height": height, "min-width": '100%'});
	 });
</script>
@endpush

@endif

