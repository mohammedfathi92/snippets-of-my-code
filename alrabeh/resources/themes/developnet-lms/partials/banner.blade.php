<section class="page-banner">
	<div class="container">
		<div class="row">
			<div class="banner-content">
				<h2>
					{{isset($page_title)?$page_title:'no title found'}}
				</h2>
			</div>
		</div>
	</div>
</section>
<section class="wrap-breadcrumb">
	<div class="container">
		<div class="row">
			@if(isset($breadcrumb))
			<ol class="breadcrumb">
			@foreach($breadcrumb as $row)
			@if($row['link'] != false)
	          <li class="breadcrumb-item"><a href="{{$row['link']}}">{{$row['name']}}</a></li>
	          @else
	          <li class="breadcrumb-item active">{{$row['name']}}</li>
	          @endif
	         @endforeach
	         

	         </ol>
	         @endif
		</div>
	</div>
</section>