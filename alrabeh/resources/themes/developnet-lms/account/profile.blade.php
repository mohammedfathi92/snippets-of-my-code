@extends('layouts.master')


@section('css')

<!--Datatables-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
 {!! Theme::css('css/pages.css') !!}
  {{-- {!! Theme::css('css/progress-circle.css') !!} --}}


@endsection

@section('content')	



	@include('partials.banner')
	<section class="page-content">
		<div class="container">
			<div class="row">

			@include('partials.profile_sidebar')
				<div class="col-lg-9 col-md-8 ">
		

					<div>
						<ul class="nav nav-tabs custom"  role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="subjects-tab" data-toggle="tab" href="#subjects" role="tab" aria-controls="overview" aria-selected="true">
						    	<i class="fa fa-drivers-license"></i><span>
						    		@lang('developnet-lms::labels.tabs.tab_bookings')
						    	</span></a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="quizzes-tab" data-toggle="tab" href="#quizzes" role="tab" aria-controls="quizzes" aria-selected="false">
						    	<i class="fa fa-bookmark-o" aria-hidden="true"></i><span>
						    		@lang('developnet-lms::labels.tabs.tab_favorites')
						    	</span>
						    </a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="setting-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="setting" aria-selected="false">
						    	<i class="fa fa-cog"></i>
						    	<span>
						    		@lang('developnet-lms::labels.tabs.tab_settings')
						    	</span>
						    </a>
						  </li>
						</ul>
						<div class="tab-content custom" id="myTabContent" style="padding: 20px 0px;">
						  	<div class="tab-pane fade show active withdatatables" id="subjects" role="tabpanel" aria-labelledby="subjects-tab">

						  		
	@if(\LMS::profilePermissions($userBase, 'LMS::subscription.view'))	  		

@include('account.partials.subscriptions')
@else

<p style="text-align: center;">@lang('developnet-lms::labels.tabs.no_data_to_view')</p>

@endif
						  	</div>

						 	 <div class="tab-pane fade" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">

	@if(\LMS::profilePermissions($userBase, 'LMS::subscription.view'))	 	

@include('account.partials.favourites')

@else

<p style="text-align: center;">@lang('developnet-lms::labels.tabs.no_data_to_view')</p>

@endif

						 	 </div>
						  	<div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
	@if(\LMS::profilePermissions($userBase, 'User::user.update'))						  		
	@include('account.partials.settings', ['active_tab'=> $active_tab , 'user' => $userBase])
	@else

<p style="text-align: center;">@lang('developnet-lms::labels.tabs.no_data_to_view')</p>

@endif
			    
						  	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection

@section('after_content')
<!-- Certification Modal -->
	<div class="modal fade certificaton-modal print-modal" id="certificatonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" divo="12231">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <div class="get-certificate">
	        	<div >
	        		<a href="javascript:;" class="download_certificate"><i class="fa fa-download" aria-hidden="true"></i>
	        		<span>تحميل</span></a>
	        	</div>
	        	{{-- <div>
	        		<a href="#">
	        			<i class="fa fa-print" aria-hidden="true"></i>
	        		<span>Print</span>
	        		</a>
	        	</div> --}}
	        </div>
	      </div> 
	      <div class="modal-body">
	        	Load .... 
	      </div>
	    </div>
	  </div>
	</div>
		
@endsection

@section('js')
  {{-- {!! Theme::css('css/progress-circle.js') !!} --}}

<!-- Data tabless-->
{!! Theme::js('roots/js/html2canvas.js') !!}

<script type="text/javascript">
    
    // var ctx = canvas.getContext("2d");

    // var ctx = canvas.getContext('2d');

    // ctx.beginPath();
    // ctx.arc(75,75,50,0,Math.PI*2,true); // Outer circle
    // ctx.moveTo(110,75);
    // ctx.arc(75,75,35,0,Math.PI,false);   // Mouth (clockwise)
    // ctx.moveTo(65,65);
    // ctx.arc(60,65,5,0,Math.PI*2,true);  // Left eye
    // ctx.moveTo(95,65);
    // ctx.arc(90,65,5,0,Math.PI*2,true);  // Right eye
    // ctx.stroke();

     // $('body').on('click','#openCanvas', function() {
     	 // console.log('Drew on the existing canvas');

        // html2canvas($("#content"), {canvas: canvas}).then(function(canvas) {
        //     
        // });
    // });

</script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.datatableLMS').DataTable();
		} );
	</script>
{!! Theme::js('js/circles.min.js"') !!} 

<script type="text/javascript">
	 $('body').on('click','.remove_fav_btn',function(){
      var url = $(this).data('url');

       var parent_div = $(this).parents('tr').closest('tr');

      $.get(url, function(response){
      	if(response.actionType == 'remove'){
      		parent_div.remove();
      	}else{
      		console.log('no action')
      	}
      	

      });

});
</script>

<script type="text/javascript">
		 $('body').on('click','.btn-certification',function(){
      var url = $(this).data('url');
      var id = $(this).data('id');

       $('#certificatonModal').modal('show').find(".modal-body").load(url);

      $.get(url, function(response){
      	var modal = $('#certificatonModal');
         modal.modal('show');
         modal.find(".modal-body").html(response.view);
            var canvas = $('canvas');
    	html2canvas($("#canvas_"+id).get(0)).then(function(canvas) {
$("#canvas_"+id).html(canvas);
});



      	

      });

});

$('body').on('click','.download_certificate',function(){
	var parent_div = $(this).parents('.modal-content').closest('.modal-content');
	var canvasDivId = parent_div.find('.canvasDivId').val();

	// console.log(firstChildDiv);
	var canvas = document.getElementById(canvasDivId).firstChild;
	// console.log(canvas);

   var link = document.createElement('a');
  link.download = 'certificate.png';
  link.href = canvas.toDataURL()
  link.click();
      });

	
</script>

<script type="text/javascript">
	$(document).ready(function() {
	$("#accordionSubs .collapse").each(function(index, element){
		if(index == 0){
	$(element).addClass("show");
	$(element).attr("aria-expanded") == true;

		}

		});

});
</script>

@stack('scripts_profile') 

@endsection 