<footer class="wrap-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div>
                    <img class="footer-logo mb-20" alt=""
                         src="{{\Settings::get('site_logo', url('/assets/themes/developnet-lms/img/Alrabeh-white.png'))}}">
                    <ul class="btm-contact-list">
                        <li><i class="fa fa-phone"></i> <a
                                    href="tel:{{ \Settings::get('site_contact_phone') }}">{{ \Settings::get('site_contact_phone') }}</a>
                        </li>
                        <li><i class="fa fa-envelope-o"></i> <a
                                    href="mailto:{{ \Settings::get('contact_form_email') }}">{{ \Settings::get('contact_form_email') }}</a>
                        </li>
                        <li><i class="fa fa-globe"></i> <a href="/">{{ env('APP_URL') }}</a></li>
                    </ul>

                    <ul class="btm-social-list">
                        @foreach(\Settings::get('social_links',[]) as $key=>$link)
                            <li><a href="{{ $link }}" target="_blank"><i class="fa fa-{{ $key }}"></i></a></li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div>
                    <h4 class="widget-title">
                        @lang('developnet-lms::labels.headings.text_important_url')
                    </h4>
                    <ul class="footer-custom-list">
                        @foreach(Menus::getMenu('lms_frontend_footer','active') as $menu )
                            <li><a href="{{$menu->url}}">{{$menu->name}}</a></li>
                        @endforeach

                    </ul>
                </div>
            </div>
            @php
                $latest_posts_footer = \Modules\Components\CMS\Models\Post::where('published', true)
                ->orderBy('published_at', 'desc')->take(3)->get()
            @endphp
            <div class="col-sm-6 col-md-3">
                <div>
                    <h4 class="widget-title">
                        @lang('developnet-lms::labels.headings.text_latest_news')
                    </h4>
                    <div class="latest-posts">
                        @foreach($latest_posts_footer as $post)
                            <article class="post media ">
                                <a class="post-thumb" href="{{url($post->slug)}}"><img src="{{$post->featured_image}}"
                                                                                       alt="{{$post->title}}"></a>
                                <div class="media-body">
                                    <h5 class="post-title"><a href="{{url($post->slug)}}">{{$post->title}}</a></h5>
                                    <p class="post-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->published_at)->format('Y-m-d')
                        }}</p>
                                </div>
                            </article>
                        @endforeach

                    </div>
                </div>
            </div>
            {{--<div class="col-sm-6 col-md-3">
              <div >
                <h4 class="widget-title ">
                @lang('developnet-lms::labels.headings.text_opening_hours')</h4>
                <div class="opening-hours">
                  <ul class="footer-custom-list" style="direction: ltr;">
                  @foreach(\Settings::get('utility_schedule_time', []) as $key => $value)
                    <li> <span style="text-align: right;"> {{$key}} </span>

                      <div class="value"><span style="text-align: right;">{{$value}}</span>  </div>
                      --}}{{-- <div class="value text-white closed"> Closed </div> --}}{{--
                    </li>
                    @endforeach

                  </ul>
                </div>
              </div>
            </div>--}}
        </div>

    </div>
    <div class="btm-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>
                    @lang('developnet-lms::labels.headings.text_copyright', ['site_name' => \Settings::get('site_name'),'year' => '2018'])

                </div>
                <div class="col-md-6 btm-widgate text-right">
                    <a href="http://developnet.net" class="dvnet" target="_blank">
                        @lang('developnet-lms::labels.headings.text_developed_by')
                    </a> <strong>DevelopNet</strong></p>
                </div>
            </div>
        </div>

    </div>
</footer>
