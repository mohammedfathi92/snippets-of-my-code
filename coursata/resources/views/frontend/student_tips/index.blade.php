@extends('frontend.layouts.master')
@section("content")
<main>
<div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_frontend_home")}}</a></li>  
                    <li>{{trans("student_tips.link_student_tips")}}</li>
                </ul>
            </div>
        </div><!-- Position -->
        <div class="container margin_60">
            <div class="row">

            	 <aside class="col-lg-3 col-md-3">
                    <div class="box_style_2">
                        <i class="icon_set_1_icon-57"></i>
                        <h4>Need <span>Help?</span></h4>
                        <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                        <small>Monday to Friday 9.00am - 7.30pm</small>
                    </div>
                </aside><!--End aside -->

     <div class="col-md-9">
     	   <div class="box_style_1">
@if($data->count())
@foreach($data as $row)
     	   	<div class="post">
					<a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}" title="blog_post.html"><img src="{{url("files/{$row->photo}?size=950,375")}}" alt="Image" class="img-responsive"></a>
					
						
							<h2><a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}">{{$row->name}}</a></h2>
						
						<hr>
					
					
					<div>{!! str_limit($row->description, 1000, ' ..... .' ) !!}</div>
					<a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}" class="btn_1" title="blog_post.html">{{trans('main.btn_read_more')}}</a>
				</div><!-- end post -->
				@endforeach
				@endif
     	   </div>
     	</div>
     		<hr>
                
                <div class="text-center">
                    
                        {{ $data->links() }}
                   
                </div>

            </div>
        </div>


</main>

@endsection

@section('styles')
<!-- CSS -->
    <link href="/assets/css/blog.css" rel="stylesheet">
@stop

@section("scripts")
   
    <script src="/assets/js/icheck.js"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey',
        });
    </script>
@stop