 @if(countData($courses)) 
 <section class="subjects" style="background: #fafafa">
            <div class="container">
                <div class=" row ">
                    <div class="title-center "> <h3 class="custom-title">
                      @lang('developnet-lms::labels.headings.text_new_courses')
                    </h3></div>
                </div>
            </div>
            <div class="container fadeInUp wow animated" data-wow-delay="0.5s">
                <div class="row">
                    <div  class="owl-carousel owl-theme customCarousel">

                    

                    @foreach($courses->get() as $course)  
                        @include('courses.partials.grid_courses_1', ['course' => $course])
                     @endforeach  

                    
                       
                    </div>
                </div>
                <div class="row">
                    <div class="tour-links ">
                            <a href="{{ route('courses.index') }}" class="colored-btn">
                              @lang('developnet-lms::labels.links.link_check_all_courses')
                            </a>
                            <a href="{{route('login')}}" class="dark-btn">
                              @lang('developnet-lms::labels.links.link_join_to_students')
                            </a>
                    </div>
                </div>
            </div>  
        </section> 

                     @endif