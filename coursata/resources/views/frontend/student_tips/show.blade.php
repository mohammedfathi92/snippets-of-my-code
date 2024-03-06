@extends('frontend.layouts.master')
@section("content")
<main>
<div id="position">
            <div class="container">
                <ul>
                    <li><a href="/">{{trans("main.link_frontend_home")}}</a></li>  
                    <li><a href="{{route('student.tips')}}">{{trans("student_tips.link_student_tips")}}</a></li>
                    <li>{{$data->name}}</li>
                </ul>
            </div>
        </div><!-- Position -->
        <div class="container margin_60">
            <div class="row">

                 <aside class="col-md-3 add_bottom_30">


                {{-- <div class="widget">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button" style="margin-left:0;"><i class="icon-search"></i></button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- End Search --> 
                
                <hr> --}}
                
                 {{-- <div class="widget" id="cat_blog">
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="#">Places to visit</a></li>
                        <li><a href="#">Top tours</a></li>
                        <li><a href="#">Tips for travellers</a></li>
                        <li><a href="#">Events</a></li>
                    </ul>
                </div><!-- End widget --> 
 
               <hr> --}}
            
                <div class="widget">
                    <h3><a href="{{route('student.tips')}}" style="color: #000000">{{trans('student_tips.aside_title')}}</a></h3>
                    
                          <hr> 
                          @if($tips->count()) 
                          @foreach($tips as $row)
                        <div class="row"> <div class="col-md-3 col-sm-3 col-xs-4"><a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}"><img src="{{url("files/{$row->photo}?size=70,70")}}" alt="Image"  height="70" width="70" ></a></div> <div class="col-md-9 col-sm-9 col-xs-8"><a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}"><strong>{{$row->name}}</strong></a></div></div>
                        <hr>
                        @endforeach
                        @endif
                        
                        
                    
                </div><!-- End widget -->
                 {{-- <hr>
                <div class="widget tags">
                    <h4>Tags</h4>
                    <a href="#">Lorem ipsum</a>
                    <a href="#">Dolor</a>
                    <a href="#">Long established</a>
                    <a href="#">Sit amet</a>
                    <a href="#">Latin words</a>
                    <a href="#">Excepteur sint</a>
                </div><!-- End widget --> --}}

     </aside><!-- End aside -->

     <div class="col-md-9">
           <div class="box_style_1">
<div class="post nopadding">
              <a href="{{route('student.tips.show',['id' => $data->id, 'slug'=>str_slug($data->{"name:en"}) ])}}" title="blog_post.html"><img src="{{url("files/{$data->photo}?size=950,375")}}" alt="Image" class="img-responsive"></a>
                    
                        
                            <h2><a href="{{route('student.tips.show',['id' => $data->id, 'slug'=>str_slug($data->{"name:en"}) ])}}">{{$data->name}}</a></h2>
                        
                        <hr>
                    
                    
                    <div>{!! $data->description !!}</div>
                   
                </div><!-- end post -->
                </div><!-- end box_style_1 -->
                
              
                
                
                
                    
           </div>
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