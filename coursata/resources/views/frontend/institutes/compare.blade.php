<!doctype html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="/compare/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="/compare/css/style.css"> <!-- Resource style -->
	<script src="/compare/js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>{{trans("courses.text_compration_page_title")}} | Coursata</title>
</head>
<body>
 

    <section id="main_compration">
	<section class="cd-intro">
		<h1>
      
      
      <nav class="menu">
        <a href="{{url('/')}}">{{trans('courses.home_page')}}</a> |
        <a href="{{url('/courses')}}">{{trans('courses.previous_page')}}</a>
        
    
      </nav>
      
   </h1>
	</section> <!-- .cd-intro -->

	<section class="cd-products-comparison-table">
		<header>
			<h2>{{trans("courses.compare_model")}}</h2>

			<div class="actions">
				<a href="#0" class="reset">{{trans("courses.text_reset")}}</a>
				<a href="#0" class="filter">{{trans("courses.compare_filter")}}</a>
			</div>
		</header>

		<div class="cd-products-table">
			<div class="features">
				<div class="top-info">{{trans("courses.text_model")}}</div>
				<ul class="cd-features-list">
					<li>{{trans("courses.institute_name")}}</li>
					<li>{{trans("courses.text_locale_rating")}}</li>
					<li>{{trans("courses.text_international_rating")}}</li>
					 <!-- <li>{{trans("courses.label_insurance")}}</li> -->
					
					<li>{{trans("courses.label_country")}}</li>
					<li>{{trans("courses.label_city")}}</li>
					<li>{{trans("courses.label_location")}}</li>
					<li>{{trans("courses.label_featured")}}</li>
				</ul>
			</div> <!-- .features -->
			    
 
			<div class="cd-products-wrapper">
				<ul class="cd-products-columns">
				@foreach ($institutes as $institute)
					<li class="product">
						<div class="top-info">
							<div class="check"></div>
							<img src="{{url("files/{$institute->photo}?size=200,150")}}" alt="{{$institute->name}}">
							<h3>{{$institute->name}}</h3>
						</div> <!-- .top-info -->

						<ul class="cd-features-list">
							<li>{{$institute->institute->name}}</li>

							<li class="rate"><span>{{($institute->local_rate?$institute->local_rate:'---')}}</span></li>

							<li class="rate"><span>{{($institute->international_rate?$institute->international_rate:'---')}}</span></li>
               
							<li>{{($institute->has('insuranceServices')?"&#9989;":'---')}}</li> 

							

							<li>{{($institute->country?$institute->country:'---')}}</li>
							<li>{{($institute->city?$institute->city:'---')}}</li>

							<li>{{($institute->location_type?$institute->location_type:'---')}}</li>
							

							<li>{{($institute->featured?"&#9989;":'---')}}</li>
						</ul>
					</li> <!-- .product -->
					@endforeach
				</ul> <!-- .cd-products-columns -->
			</div> <!-- .cd-products-wrapper -->
		
			<ul class="cd-table-navigation">
				<li><a href="#0" class="prev inactive">{{trans('compare.prev_page')}}</a></li>
				<li><a href="#0" class="next">{{trans('compare.next_page')}}</a></li>
			</ul>
		</div> <!-- .cd-products-table -->
	</section> <!-- .cd-products-comparison-table -->
	</section>
	
	
<script src="/compare/js/jquery-2.1.4.js"></script>
<script src="/compare/js/main.js"></script> <!-- Resource jQuery -->

<!-- menu -->

</body>
</html>