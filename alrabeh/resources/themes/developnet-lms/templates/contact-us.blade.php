@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	

	@include('partials.banner')	

	<section class="contact-us">
	  	<div class="container">
	      <div class="row section-content">   
	        <div class="col-lg-6 text-justify">
	           {!! $item->rendered !!}
	        </div>
	        <div class="col-lg-5 offset-lg-1">
	          <h3>@lang('developnet-lms::labels.headings.contact_info')</h3>
	          <ul class="contact-info">
	          	@if(\Settings::get('office_address'))
	            <li><i class="fa fa-map-marker"></i>@lang('developnet-lms::labels.headings.address') : {{\Settings::get('office_address')}},</li>
	            @endif
	            <li><i class="fa fa-phone"></i> <a href="tel:{{ \Settings::get('site_contact_phone') }}">{{ \Settings::get('site_contact_phone') }}</a></li>
	            <li><i class="fa fa-envelope-o"></i> <a href="mailto:{{ \Settings::get('contact_form_email') }}">{{ \Settings::get('contact_form_email') }}</a></li>
	          </ul>
	          <p>{!! __('developnet-lms::labels.headings.contact_text_message') !!} 
	          <div class="social-contact">
	          	@foreach(\Settings::get('social_links',[]) as $key=>$link)
                   <a href="{{ $link }}" class="{{ $key }}"><i class="fa fa-{{ $key }} " title="{{ $key }}"></i></a> 
                   @endforeach
	          </div>
	        </div>
	      </div>
	      <hr>
	     {{--  <div class="row">
	        <div class="col-lg-12 contact-form">
	          <h3>CONTACT FORM</h3>
	          <p>How can We Help</p>
	          <form class="row">
	            <div class="form-group form-inline">
	              <div class="col-md-4">
	                <input type="text" class="form-control" name="Name" placeholder="NAME:">
	              </div>
	              <div class="col-md-4">
	                <input type="mail" class="form-control" name="Mail" placeholder="MAIL:">
	              </div>
	              <div class="col-md-4">
	                <input type="text" class="form-control" name="Subject" placeholder="SUBJECT:">
	              </div>
	              <div class="col-lg-12">
	                <textarea class="form-control" name="Message" placeholder="MESSAGE:" style="height: 280px;"></textarea>
	              </div>
	              <div class="col-lg-12">
	                <input type="submit" name="Submit" value="Send Message" title="submit">
	              </div>
	            </div>
	          </form>
	         	<br>
	        </div>
	      </div> --}}
	    </div>

	   {{--  <div class="container-fluid">
	    	<div class="row">
				<div id="map"></div>
	    	</div>
	    </div> --}}
	    
	</section>
@endsection

@section('js')


{!! Html::script('assets/modules/plugins/formbuilder/js/sizzle.min.js') !!}
    {!! Html::script('assets/modules/plugins/formbuilder/js/jquery-ui.min.js') !!}
    {!! Html::script('assets/modules/plugins/formbuilder/js/form-builder.min.js') !!}
    {!! Html::script('assets/modules/plugins/formbuilder/js/form-render.min.js') !!}
    {!! Html::script('assets/modules/plugins/formbuilder/js/jquery.rateyo.min.js') !!}

 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
 <script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 11,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(29.077531399999998, 31.089612400000004), // New York

            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"all","elementType":"geometry.fill","stylers":[{"weight":"2.00"}]},{"featureType":"all","elementType":"geometry.stroke","stylers":[{"color":"#9c9c9c"}]},{"featureType":"all","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#eeeeee"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#7b7b7b"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c8d7d4"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#070707"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]}]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(40.6700, -73.9400),
            map: map,
        });
    }
</script>
@endsection 