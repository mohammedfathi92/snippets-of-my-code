        <section class="intro-sec" style="background:url('{{\Settings::get('home_page_background', url('/assets/themes/developnet-lms/img/bg4.jpg'))}}') fixed no-repeat center; background-size: cover;height: 100vh">
     {{--       
      <video autoplay muted loop id="myVideo" style="display: none;">
                <source src="Home_work.mp4" type="video/mp4">
                <source src="Home_work.mp4" type="video/webm">  
            </video> --}}
            @if(\Settings::get('slider_show_text'))
            <div class="intro-content " >
                <p class="intro animated fadeInUp wow" data-wow-delay="0.25s"> 
                 {!!\Settings::get('slider_line_1', 'انضم <span>الآن</span> إلى العديد من الطلاب لتحصل على مجموعة من أفضل الدورات والباقات .')!!}
                 
                </p>
                <h1 class="intro-title animated fadeInUp wow" data-wow-delay="0.5s">

                   {!! \Settings::get('slider_line_2', 'أكاديمية <span>الرابح</span> لاختبارات قياس المباشرة')!!}

                  </h1>
                <div>
                    <a href="{{ route('login') }}" class="go-link">
                      @lang('developnet-lms::labels.links.link_join_us')
                    </a>
                    <a href="{{url('/contact-us')}}" class="go-link inverse">
                      @lang('developnet-lms::labels.links.link_contact_us')
                    </a>
                </div>
            </div>
            @endif
        </section>