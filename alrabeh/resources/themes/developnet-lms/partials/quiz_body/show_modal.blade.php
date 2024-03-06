 <div id="{{$modal_id}}" class="modal modal-wide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #fff">
      <div class="modal-header">
      	<a href="javascript:;" class="close" data-dismiss="modal" aria-hidden="true" style="font-size: 14px;"><i class="fa fa-close" aria-hidden="true"></i>
	        		<span >إغلاق</span></a>

      </div>
      <div class="modal-body">
        <p>إنتظر قليلًا &hellip;</p>
      </div>
     {{--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	


 @push('child_css')

 <style>
 	.modal.modal-wide .modal-dialog {
  width: 95%;
}

.modal-dialog{max-width: 100vw;}
.modal-wide .modal-body {
  overflow-y: auto;
}



 </style>

 @endpush

@push('child_scripts')

<script type="text/javascript">
	$(function() {
	$(".modal-wide").on("show.bs.modal", function() {
  var height = $(window).height() * 0.87;
  $(this).find(".modal-body").css({"max-height": height, "min-height": height}).load('{{route('quizzes.embeded', $quiz->hashed_id).'?ajax=true'}}');


});
	});
</script>

@endpush