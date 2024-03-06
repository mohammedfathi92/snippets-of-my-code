<!DOCTYPE html>
<html lang="en">
<head>
	<title>قريباً| اكاديمية الرابح</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/comingsoon/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/comingsoon/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/comingsoon/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/comingsoon/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/comingsoon/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/comingsoon/css/util.css">
	<link rel="stylesheet" type="text/css" href="/comingsoon/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	@php

	$date = \Carbon\Carbon::parse('2019-08-20 11:00:00');
    $now = \Carbon\Carbon::now();
    $diff = $date->diffInDays($now);

	@endphp
	
	<!--  -->
	<div class="simpleslide100">
		<div class="simpleslide100-item bg-img1" style="background-image: url('/comingsoon/images/bg01.jpg');"></div>
		<div class="simpleslide100-item bg-img1" style="background-image: url('/comingsoon/images/bg02.jpg');"></div>
		<div class="simpleslide100-item bg-img1" style="background-image: url('/comingsoon/images/bg03.jpg');"></div>
	</div>

	<div class="size1 overlay1">
		<!--  -->
		<div class="size1 flex-col-c-m p-l-15 p-r-15 p-t-50 p-b-50">
			<h3 class="l1-txt1 txt-center p-b-25">
				قريبًا
			</h3>

			<p class="m2-txt1 txt-center p-b-48">
				 انطلاق منصة اكاديمية الرابح في ثوبها الجديد
			</p>

			<div class="flex-w flex-c-m cd100 p-b-33">
				<div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
					<span class="l2-txt1 p-b-9 days">{{$diff}}</span>
					<span class="s2-txt1">يوم</span>
				</div>

				<div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
					<span class="l2-txt1 p-b-9 hours">{{$now->format('H') - 1}}</span>
					<span class="s2-txt1">ساعة</span>
				</div>

				<div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
					<span class="l2-txt1 p-b-9 minutes">{{$now->format('i')}}</span>
					<span class="s2-txt1">دقيقة</span>
				</div>

				<div class="flex-col-c-m size2 bor1 m-l-15 m-r-15 m-b-20">
					<span class="l2-txt1 p-b-9 seconds">{{$now->format('s')}}</span>
					<span class="s2-txt1">ثانية</span>
				</div>
			</div>

{{-- 			<form class="w-full flex-w flex-c-m validate-form">

				<div class="wrap-input100 validate-input where1" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input100 placeholder0 s2-txt2" type="text" name="email" placeholder="Enter Email Address">
					<span class="focus-input100"></span>
				</div>
				
				
				<button class="flex-c-m size3 s2-txt3 how-btn1 trans-04 where1">
					Subscribe
				</button>
			</form> --}}

			<a class="flex-c-m size3 s2-txt3 how-btn1 trans-04 where1" href="{{url('/login')}}">
					تسجيل الدخول
				</a>
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="/comingsoon/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/comingsoon/vendor/bootstrap/js/popper.js"></script>
	<script src="/comingsoon/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/comingsoon/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/comingsoon/vendor/countdowntime/moment.min.js"></script>
	<script src="/comingsoon/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="/comingsoon/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="/comingsoon/vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: {{$diff}},
			endtimeHours: {{24 - $now->format('H')}},
			endtimeMinutes: {{$now->format('i')}},
			endtimeSeconds: {{$now->format('s')}},
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="/comingsoon/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="/comingsoon/js/main.js"></script>

</body>
</html>