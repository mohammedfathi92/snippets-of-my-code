  <section class="clients-main"  id="testimonials" style="background:url('{{\Settings::get('home_page_background', url('/assets/themes/developnet-lms/img/bg4.jpg'))}}') fixed no-repeat center; background-size: cover;height: 500px">
            <div class="different-dot1">
                <div class="container">
                    <div class=" text-center  ">
                        <h3 class="custom-title pt-50">
                            آراء المستخدمين
                           {{-- @lang('developnet-lms::labels.headings.text_what_they_says') --}}
                        </h3>
                    </div>
                    <div class="cli-ent fadeInUp wow animated" data-wow-delay="0.5s">
                        <section class="slider">
                            <div class="flexslider">
                                <ul class="slides">
                                    @php
  $testimonials = Modules\Components\LMS\Models\Testimonial::where('status', true)
  ->where('in_home', true)
  ->get();
                                    @endphp
                                    @foreach($testimonials as $row)
                                    <li>
                                        <div class="item g1">
                                            <div class="dish-caption">
                                            <img class="lazyOwl" src="{{$row->thumbnail}}" alt="{{$row->user_name}}"/>
                                           
                                                <h4>{{$row->user_name}}</h4>
                                              
                                            </div>
                                            
                                            <div class=""></div>
                                            <p class="para-agile"><span class="fa fa-quote-left" aria-hidden="true"></span> {!!  str_limit(strip_tags($row->content) ,200) !!}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                   
                                </ul>
                            </div>
                        </section>
                    </div>
                    <!--// Owl-Carousel -->
                </div>
            </div>
        </section>  