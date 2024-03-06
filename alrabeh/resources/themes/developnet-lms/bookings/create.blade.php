@extends('layouts.master')

@section('css')
{!! Theme::css('css/creditly.css') !!}
{!! Theme::css('css/easy-responsive-tabs.css') !!}
{!! Theme::css('css/select2.min.css') !!}
{!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	

	@include('partials.banner')	

	<!-- Page Content-->
	<section class="take-course">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 take-course-overview ">
					<div class="take-overview-content">
						<div class="tv-title">
							@php
			if($module_data->sale_price > 0){
				$moduleDataPrice = $module_data->sale_price;
			}else{
				$moduleDataPrice = $module_data->price;
			}
							@endphp
							<h2>{{$module_data->title}}</h2>
							<h3>{{$moduleDataPrice}} <span>@lang('LMS::attributes.main.currency_rs')</span></h3>
							<p>{{str_limit(strip_tags($module_data->content), 200)}}</p>
						</div>
						<div class="tv-content">
							{{-- <h3>@lang('developnet-lms::labels.headings.text_get_best_courses_quizzes')</h3> --}}


						<ul>

								<li>
									<p><p><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
										في حالة امتلاك كود دفع :</p> <small>سيتم تأكيد حجزك تلقائي دون الحاجة للإنتظار.</small>
									</p>
										<p><p><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
										في حالة عدم امتلاك كود الدفع :</p> <small>فقم بإستكمال عملية الدفع دون وضع كود الدفع وبعدها سيقوم احد ممثلينا بالتواصل بك وتأكيد حجزك.</small>
									</p>
								</li>
				</ul>				

							{{-- <ul>

								<li>
									<p><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
										<span>مستوي الكورس:</span> <small>صعب</small>
									</p>
								</li>
								<li>
									<p><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
										<span>عدد الساعات:</span> <small>18</small>
									</p>
								</li>
								<li>
									<p><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
										</span><span>عدد الامتحانات :</span> <small>15</small>
									</p>
								</li>
								<li>
									<p><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
										<span>الايام:</span> <small>10</small>
									</p>
								</li>
								<li>
									<p><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
										<span>الاجتياز:</span> <small>70%</small>
									</p>
								</li>
							</ul> --}}
							{{-- <a href="{{url('/info-payment')}}" class="tv_questions">
								إعرف المزيد
							</a> --}}
							<div class="tv_help_desk">
								{{-- <a href="{{url('/contact-us')}}" target="_blanck">
									@lang('developnet-lms::labels.links.link_contact_us')
								</a> --}}
								<a href="{{url('/info-payment')}}" class="tv_questions" target="_blanck">
								إعرف المزيد
							</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8 course-paument">
					<div class="page-side-title normal">
						<h4>@lang('developnet-lms::labels.headings.text_enter_personal_info')</h4>
					</div>
					@if(Auth::check())
					@php
					$user = Auth()->user();

					@endphp
					 {!! Form::model($user, ['url' => route('subscriptions.store', ['module' => $module, 'module_id' => $module_hash_id]),'method'=>'post','files'=>true,'class'=>'form-horizontal']) !!}
					
	                    <div class="form-group">
	                        <label for="inputName" class="col-sm-12 control-label">
	                        	@lang('developnet-lms::labels.headings.text_name')
	                        </label>

	                        <div class="col-sm-10">
	                          <input type="text" class="form-control" id="inputName" name="name" value="{{old('name', $user->name)}}">
	                           @if ($errors->has('name'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="inputEmail" class="col-sm-12 control-label">
	                        	@lang('developnet-lms::labels.headings.text_email')
	                        </label>

	                        <div class="col-sm-10">
	                          <input type="email" class="form-control" id="inputEmail" value="{{old('email', $user->email)}}" required="" name="email">
	                           @if ($errors->has('email'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
	                        </div>
	                    </div>
	                    
	                    <div class="row col-sm-10">
	                    	<div class="col-md-6">
                        @php
                        $countriesList = \Modules\Settings\Models\Country::pluck('name_ar', 'id')->toArray();
                        @endphp

                        {!! ModulesForm::select('country_id','corals-admin::labels.auth.country',$countriesList,false,null,['class' => 'select2']) !!}
		                    </div>


{{-- 	                    	<div class="form-group col-sm-4">
		                        <label for="inputCode" class="col-sm-12 control-label">
		                        	@lang('developnet-lms::labels.headings.text_country_code')
		                        </label>

		                        <div class="col-sm-12">
		                          <input type="text" class="form-control" id="inputCode" value="{{__('developnet-lms::labels.headings.text_saudi')}} +966" disabled="" placeholder="{{__('developnet-lms::labels.headings.text_saudi')}} +966">
		                        </div>
		                    </div> --}}

		                    <div class="form-group col-md-6">
		                        <label for="inputPhone" class="control-label">
		                        	@lang('developnet-lms::labels.headings.text_phone')
		                        </label>

		                      
		                          <input type="number" class="form-control" id="inputPhone" name="phone_number" value="{{old('phone_number', $user->phone_number)}}" required="">
		                          @if ($errors->has('phone_number'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                      @endif
		                       
		                    </div>
		                    
	                    </div>
	                    <div class="form-group">
	                        <label for="inputBillCode" class="col-sm-12 control-label">
	                        	@lang('developnet-lms::labels.headings.text_booking_code')
	                        </label>

	                        <div class="col-sm-10">
	                          <input type="text" class="form-control" id="inputBillCode" name="coupon" value="{{old('coupon')}}">
	                           @if ($errors->has('coupon'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('coupon') }}</strong>
                                            </span>
                                @endif
	                           <small id="bookingCodeHelp" class="form-text text-muted">@lang('developnet-lms::labels.headings.text_booking_code_msg')
	                           	<a href="{{url('/info-payment')}}" target="_blank">@lang('developnet-lms::labels.headings.text_get_booking_code')</a></small>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label for="inputCountry" class="col-sm-12 control-label">
	                        	@lang('developnet-lms::labels.headings.text_country')
	                        </label>

	                        <div class="col-sm-10">
	                          <input type="text" class="form-control" id="inputCountry" 
	                          value="@lang('developnet-lms::labels.headings.text_saudi')" disabled="">
	                        </div>
	                    </div>
	             {{--        <div class="form-group">
	                        <label for="inputJob" class="col-sm-12 control-label">
	                        	@lang('developnet-lms::labels.headings.text_job_title')
	                        </label>

	                        <div class="col-sm-10">
	                          <input type="text" class="form-control" id="inputJob" name="job_title" value='@lang('developnet-lms::labels.headings.text_student')' value="{{$user->job_title}}" required="">
	                          @if ($errors->has('job_title'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('job_title') }}</strong>
                                            </span>
                                @endif
	                        </div>
	                    </div> --}}
	                    <div class="form-group">
	                        <label for="inpuAdress" class="col-sm-12 control-label">
	                        	@lang('developnet-lms::labels.headings.text_adress')
	                        </label>

	                        <div class="col-sm-10">
	                          <input type="text" class="form-control" id="inpuAdress" name="address" value="{{old('address', $user->address)}}">
	                        </div>

	                           @if ($errors->has('address'))
                                            <span class="help-block" style="color: red;">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                @endif
	                    </div>
	                   {{--   <div class="form-group">
						    <label for="ControlFile1" class="col-sm-12">@lang('developnet-lms::labels.headings.text_upload_bill_img')</label>
						    <div class="col-sm-10">
						    	 <input type="file" class="form-control-file" id="ControlFile1">
						    </div>
						   
						  </div> --}}
                      	<button type="submit" class="btn btn-danger">
                      		@lang('developnet-lms::labels.spans.span_send_data')
                      	</button>
                    {!! Form::close() !!}
                    @else

                    يجب عليك تسجيل الدخول اولا او الاشتراك في الموقع لعرض هذه الصفحة

                    @endif
                    <br>
                    {{--
                    <div class="page-side-title normal">
						<h4>اختيار طريقه الدفع</h4>
					</div>
                    <div id="horizontalTab">
						<ul class="resp-tabs-list">
							<li><img src="/assets/themes/developnet-lms/img/1.jpg" alt=" " /></li>
							<li><img src="/assets/themes/developnet-lms/img/2.jpg" alt=" " /></li>
						</ul>
						<div class="resp-tabs-container">
							<div class="myresponsive_tab1 resp-tab-content-active">
								<form action="#" method="post" class="creditly-card-form ">
									<section class="creditly-wrapper">
										<div class="credit-card-wrapper">
											<div class="first-row form-group">
												<div class="controls form-group">
													<label class="control-label">Name on Card</label>
													<input class="form-control" type="text" name="name" placeholder="John Smith">
												</div>
												<div class="controls form-group">
													<label class="control-label">Card Number</label>
													<input class="number credit-card-number form-control" type="text" name="number"
																  inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number"
																  placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
												</div>
												<div class="controls form-group">
													<label class="control-label">CVV</label>
													<input class="security-code form-control"Â·
																  inputmode="numeric"
																  type="text" name="security-code"
																  placeholder="&#149;&#149;&#149;">
												</div>
												<div class="controls form-group">
													<label class="control-label">Expiration Date</label>
													<input class="expiration-month-and-year form-control" type="text" name="expiration-month-and-year" placeholder="MM / YY">
												</div>
											</div>
											<button type="submit" class="btn btn-danger">أرسال</button>
										</div>
									</section>
								</form>
							</div>
							<div class="myresponsive_tab2">
								<p>Important: You will be redirected to PayPal's website to securely complete your payment.</p>
								<br>
								<a class="btn btn-primary">	 via Paypal</a>
								<br>
								
							</div>
						</div>
					</div>
					--}}
				</div>
			</div>
		</div>
	</section>

@endsection
@section('js')
{!! Theme::js('js/select2.min.js') !!}   
<script>
	$(document).ready(function() {
    $('.select2').select2();
});
</script>

<!-- credit-card -->

{!! Theme::js('js/creditly.js') !!}  
<script type="text/javascript">
	$(function() {
	  var creditly = Creditly.initialize(
		  '.creditly-wrapper .expiration-month-and-year',
		  '.creditly-wrapper .credit-card-number',
		  '.creditly-wrapper .security-code',
		  '.creditly-wrapper .card-type');

	  $(".creditly-card-form .submit").click(function(e) {
		e.preventDefault();
		var output = creditly.validate();
		if (output) {
		  // Your validated credit card output
		  console.log(output);
		}
	  });
	});
</script>
<!-- //credit-card -->


<!-- tabs -->
{{--
{!! Theme::js('js/easy-responsive-tabs.js') !!}  
<script>
$(document).ready(function () {
	$('#horizontalTab').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion           
		width: 'auto', //auto or any width like 600px
		fit: true,   // 100% fit in a container
		closed: 'accordion', // Start closed if in accordion view
		activate: function(event) { // Callback function if tab is switched
		var $tab = $(this);
		var $info = $('#tabInfo');
		var $name = $('span', $info);
		$name.text($tab.text());
		$info.show();
		}
	});
});
</script>
--}}
<!-- //tabs -->
@endsection