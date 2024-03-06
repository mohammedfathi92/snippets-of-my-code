
    @php
    $content = json_decode($block->content);
    $type = $block->block_type;
   @endphp

   @if($type == 'header')
   @if(!empty($content->layout) && $content->layout=='header_1')

    <!--Start slide-banner -->
        <section class="slide-banner slider3" id="home" @if(!empty($content->bg_img)) style="background: url({{$content->bg_img}}) no-repeat scroll center 100%; background-size: cover; margin-top: 0px;"@endif>
             {{-- <div class="slider3-img">
                <img src="/builder/image/slider/app-landing-mobile.png" alt="">
            </div> --}}
            <div class="container">
<ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
                <div class="row slider3-subcribe">
                    <div class="slider3-content">
                        <div class="col-sm-12 slide3-text">
                            <div class="slider-text">
                                @if(!empty($content->title))
                                <h2> {{$content->title}} </h2>
                                @endif

                                @if(!empty($content->description))
                                <p>{{$content->description}}</p>

                                 @endif
                                 @if(!empty($content->btn_text_1) && !empty($content->btn_url_1))
                                <a href="{{$content->btn_url_1}}" class="btn sub_btn sub_btn-two active">{{$content->btn_text_1}}</a>
                                @endif

                                @if(!empty($content->btn_text_2) && !empty($content->btn_url_2))
                                <a href="{{$content->btn_url_2}}" class="btn sub_btn sub_btn-two">{{$content->btn_text_2}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End slide-banner -->
        @endif
        @if(!empty($content->layout) && $content->layout=='header_2')

        <!-- start hero-section Area-->
        <section class="slide-banner slider3 myHeaderImage" id="home" @if(!empty($content->bg_img)) style="background: url({{$content->bg_img}}) no-repeat scroll center 100%; background-size: cover;"@endif>
            <div class="container">
              <ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
                <div class="hero-content">
                    @if(!empty($content->title))
                                <h2 style="color: #fff;"> {!!$content->title!!} </h2>
                                @endif

                                @if(!empty($content->description))
                                <p style="color: #fff;">{!!$content->description!!}</p>

                                 @endif
                      @if(!empty($content->btn_text_1) && !empty($content->btn_url_1))
                    <a class="btn slider-btn active" href="{{$content->btn_url_1}}">{{$content->btn_text_1}}</a>
                    @endif

                   @if(!empty($content->btn_text_2) && !empty($content->btn_url_2))
                    <a class="btn slider-btn" href="{{$content->btn_url_2}}">{{$content->btn_text_2}}</a>
                     @endif
                </div>
            </div>
        </section>
        <!-- End hero-section Area-->


        @endif
   @endif

      @if($type == 'features')
   @if(!empty($content->layout) && $content->layout=='features_1')

         <!--Start usability2 area-->
        <section class="usability-area usability2 usability3" id="block_{{$block->id}}">
            <div class="container">
                         <ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
                <div class="section-title">
                     @if(!empty($content->title))
                                <h2> {!!$content->title!!} </h2>
                                @endif

                                @if(!empty($content->description))
                                <p>{!!$content->description!!}</p>

                                 @endif
                </div>
                <div class="row">
                    <div class="col-sm-4 user">
                        <div class="user-item wow fadeIn" data-wow-delay="0ms" data-wow-duration="1500ms">
                          @if(!empty($content->icon_1))
                             <i class="fa {{$content->icon_1}}"></i></h2>
                            @endif

                            @if(!empty($content->title_1))
                            <h2 class="th-h2">{{$content->title_1}}</h2>
                            @endif
                            @if(!empty($content->content_1))
                            <p>{{$content->content_1}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4 user">
                        <div class="user-item wow fadeIn" data-wow-delay="0.1s" data-wow-duration="1000ms">
                            @if(!empty($content->icon_2))
                             <i class="fa {{$content->icon_2}}"></i></h2>
                            @endif

                            @if(!empty($content->title_2))
                            <h2 class="th-h2">{{$content->title_2}}</h2>
                            @endif
                            @if(!empty($content->content_2))
                            <p>{{$content->content_2}}</p>
                            @endif
                            </div>
                    </div>
                    <div class="col-sm-4 user">
                        <div class="user-item wow fadeIn" data-wow-delay="0.3s" data-wow-duration="800ms">
                              @if(!empty($content->icon_3))
                             <i class="fa {{$content->icon_3}}"></i></h2>
                            @endif

                            @if(!empty($content->title_3))
                            <h2 class="th-h2">{{$content->title_3}}</h2>
                            @endif
                            @if(!empty($content->content_3))
                            <p>{{$content->content_2}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End usability2 area-->


        @endif
        @if(!empty($content->layout) && $content->layout=='features_2')




        @endif
   @endif


    @if($type == 'divider')
   @if(!empty($content->layout) && $content->layout=='divider_1')

         <!--Start usability2 area-->
        <section class="usability-area usability2 usability3" id="block_{{$block->id}}">
            <div class="container">
                         <ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
                <div class="section-title">
                     @if(!empty($content->divider_title))
                                <h2> {{$content->divider_title}} </h2>
                                @endif

                                @if(!empty($content->divider_content))
                                <p>{!!$content->divider_content!!}</p>

                                 @endif
                </div>
@if(!empty($content->div_btn_url))
          <center><a href="{{$content->div_btn_url}}" class="btn thm-btn seo-btn">{{$content->div_btn_text}}</a></center>

           @endif
            </div>
        </section>
        <!--End usability2 area-->


        @endif
        @if(!empty($content->layout) && $content->layout=='divider_2')




        @endif
   @endif


      @if($type == 'parallex')
   @if(!empty($content->layout) && $content->layout=='parallex_1')

    <!--start subcribe area-->
        <section class="support-area subcribes-area" @if(!empty($content->bg_img)) style="background: url({{$content->bg_img}}) no-repeat scroll center 100%; background-size: cover;"@endif id="block_{{$block->id}}">
            <div class="container">
              <ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
                <div class="section-title">
                      @if(!empty($content->title))
                                <h2> {!! $content->title !!} </h2>
                                @endif

                                @if(!empty($content->description))
                                <p>{!! $content->description !!}</p>

                                 @endif
                </div>
                @if(!empty($content->btn_text) && !empty($content->btn_url))
               <center><a href="{{$content->btn_url}}" class="btn product-btn pr-2-btn active">{{$content->btn_text}}</a></center>
                @endif
            </div>
        </section>
        <!--End subcribe area-->


        @endif
        @if(!empty($content->layout) && $content->layout=='parallex_2')

         <!--start subcribe area-->
        <section class="support-area subcribes-area my_fixed" @if(!empty($content->bg_img)) style="background: url({{$content->bg_img}}) no-repeat scroll center 100%; background-size: cover;"@endif id="block_{{$block->id}}">
            <div class="container">
              <ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
                <div class="section-title">
                      @if(!empty($content->title))
                                <h2> {!! $content->title !!} </h2>
                                @endif

                                @if(!empty($content->description))
                                <p>{!! $content->description !!}</p>

                                 @endif
                </div>
                @if(!empty($content->btn_text) && !empty($content->btn_url))
                <a href="{{$content->btn_url}}" class="btn product-btn pr-2-btn active">{{$content->btn_text}}</a>
                @endif
            </div>
        </section>
        <!--End subcribe area-->


        @endif
   @endif
 @if($type == 'banner')
         @if(!empty($content->layout) && $content->layout=='banner_1')

         <!--start subcribe area-->
        <section class="usability-area usability2 usability3"  id="block_{{$block->id}}">
            <div class="container">
              <ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
@if(!empty($content->banner_img) && $content->banner_img)
<a href="{{ !empty($content->banner_url)?$content->banner_url:'#' }}" target="_blank">
<img src="{{$content->banner_img}}" style="height: 100px; width: 100%">
</a>
 @endif

            </div>
        </section>
        <!--End subcribe area-->

@endif
        @endif






      @if($type == 'logos')
        @if(!empty($content->layout) && $content->layout=='logo_1')

           No Data To show


        @endif

     @endif


      @if($type == 'contact')
        @if(!empty($content->layout) && $content->layout=='contact_1')




        @endif
        @if(!empty($content->layout) && $content->layout=='contact_2')


 No Data To show

        @endif
     @endif

     @if($type == 'reviews')
        @if(!empty($content->layout) && $content->layout=='reviews_1')
                  <ul class="my_list_tools">
  <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editStBlockFormModal{{$block->id}}"><i class="fa fa-wrench"></i></button></li>
  <li><a type="button" class="btn btn-danger" href="{{route('block.delete',['id'=>$block->page_id, 'block'=>$block->id])}}" ><i class="fa fa-trash"></i></a></li>
  <li><a href="#block_{{$block->id}}">block_{{$block->order}}</a></li>
</ul>
          <!--Start review area2-->
        <section class="review-area review-area2" id="block_{{$block->id}}">

            <div class="container">

               {{--  <div class="section-title">
        @if(!empty($content->title))
                    <h2>{{$content->title}}</h2>
        @endif
                </div> --}}
                <img src="image/quote.jpg" alt="">
                <div class="review-slider owl-carousel">
                     @if(\Sirb\Testimonial::published())
                @foreach(\Sirb\Testimonial::published()->orderBy('created_at', 'desc')->take(4)->get() as $test)
                    <div class="item">
                        <p>{!! str_limit(strip_tags($test->description),500) !!} ... .</p>
                        <div class="media">
                            <div class="media-left">
                                <img class="img-circle" src="@if($test->avatar) {{url("files/$test->avatar?size=50,50&encode=jpg")}} @else /images/default-avatar.jpg @endif" alt="{{$test->visitor_name}}" width="100" height="100">
                            </div>
                            <div class="media-body">
                                <h2>{{$test->visitor_name}}</h2>

                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endif


                </div>
            </div>
        </section>
        <!--End review area2-->



        @endif
        @if(!empty($content->layout) && $content->layout=='review_2')


 No Data To show

        @endif
     @endif


              <!-- Static Block Modal -->
  <div class="modal fade" id="editStBlockFormModal{{$block->id}}" role="dialog" data-ng-controller="builderCtrl">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header </h4>
        </div>
        <div class="modal-body">


          @include('backend.landing_pages.parts.edit_st_forms', ['content' => $content, 'block' => $block])

        </div>

      </div>

    </div>
  </div>

