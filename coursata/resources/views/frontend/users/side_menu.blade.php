  <ul id="cat_nav">
  	<li><a href="{{url('/account/bookings')}}" @if(Request::segment(3)=="bookings") id="active" @endif>{{trans('users.tab_courses_list')}}</a></li>
  	<li><a href="{{url('/account')}}" @if(Request::segment(2)=="account" && Request::segment(3)=="") id="active" @endif>{{trans('users.tab_profile')}} </a></li>
  	<li><a href="{{url('/account/favorites')}}" @if(Request::segment(3)=="favorites") id="active" @endif>{{trans('users.tab_favorites')}} </a></li>
  	<li><a href="{{route('account.tips')}}" @if(Request::segment(3)=="guide") id="active" @endif>{{trans('users.tab_student_tips')}}</a></li>
  	<li><a href="{{url('/account/settings')}}" @if(Request::segment(3)=="settings") id="active" @endif>{{trans('users.tab_settings')}}</a></li>

  </ul>