@extends('frontend.layouts.master')
@section("content")

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{url('/')}}">{{trans('users.home_page')}}</a></li>
                <li>{{trans('users.my_account')}}</li>
            </ul>
        </div>
    </div><!-- End Position -->
    @if(Session::has("message"))
        @if(Session::get("alert-type")=="error")
            <div class="alert alert-danger">{!! Session::get("message") !!}</div>
        @endif

        @if(Session::get("alert-type")=="success")
            <div class="alert alert-success">{!! Session::get("message") !!}</div>
        @endif
    @endif
    <main>
        <div class="margin_60 container">

            <aside class="col-md-2" id="sidebar">
        <div class="theiaStickySidebar">
        <div class="box_style_cat">
          @include('frontend.users.side_menu')
            </div>
        </div><!--End sticky -->
        </aside>
        <div class="col-md-10 add_bottom_15">
           
                
               

                       
                        <div class="row">
                           

                              
         <div class="box_style_1">
@if($data->count())
@foreach($data as $row)
          <div class="post">
          <a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}" title="blog_post.html" target="_blank"><img src="{{url("files/{$row->photo}?size=950,375")}}" alt="Image" class="img-responsive"></a>
          
            
              <h2><a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}" target="_blank">{{$row->name}}</a></h2>
            
            <hr>
          
          
          <div>{!! str_limit($row->description, 1000, ' ..... .' ) !!}</div>
          <a href="{{route('student.tips.show',['id' => $row->id, 'slug'=>str_slug($row->{"name:en"}) ])}}" class="btn_1" title="blog_post.html" target="_blank">{{trans('main.btn_read_more')}}</a>
        </div><!-- end post -->
        @endforeach
        @endif
         </div>
     
        <hr>
                
                <div class="text-center">
                    
                        {{ $data->links() }}
                   
                </div>
                        </div><!-- End row -->

                     
                        

  
                    
   </div>         
     

        </div><!-- end container -->
    </main>



@stop

@section("styles")

    <!-- CSS -->
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
    <style type="text/css">
        a .btn_3 {background-color: #e04f67; color: #fff;}
    </style>
    <style>
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    
    .table > tbody > tr > .no-line {
        border-top: none;
    }
    
    .table > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    </style>
    
@stop

@section("scripts")

   
  
    <!-- Date and time pickers -->
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', '');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>

 <!-- Fixed sidebar -->
<script src="/assets/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<!-- Cat nav mobile -->
<script  src="/assets/js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>


@stop