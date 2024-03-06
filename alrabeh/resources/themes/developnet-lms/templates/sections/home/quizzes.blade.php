 @if($quizzes->count()) 
         <section class="subjects" style="background: #2f4f4f">
            <div class="container">
                <div class=" row ">
                    <div class="title-center mtb-15"> <h3 class="custom-title white">
                      @lang('developnet-lms::labels.headings.text_new_quizzes')
                    </h3></div>
                </div>
            </div>
            <div class="container fadeInUp wow animated" data-wow-delay="0.5s">
                <div class="row">
                   

                      @foreach($quizzes->get() as $quiz)  
                         <div  class="col-md-6"> 
                          @include('quizzes.partials.list_quiz')
                        </div>
                       @endforeach  

                     
                </div>
                <div class="row">
                    <div class="tour-links mtb-15 ">
                            <a href="{{ route('quizzes.index') }}" class="colored-btn">
                              @lang('developnet-lms::labels.links.link_check_all_quizzes')
                            </a>
                            <a href="{{route('login')}}" class="dark-btn">
                              @lang('developnet-lms::labels.links.link_join_to_students')
                            </a>
                    </div>
                </div>
            </div>  
        </section> 
         @endif