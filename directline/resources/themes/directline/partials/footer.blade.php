
  <!-- footer -->
        <div class="footer">
            <div class="footer_agile_inner_info_dvl container">
                <div class="row">
                      <div class="col-md-9 footer-right">
                        <div class="sign-grds">
                            <div class="row">
                                <div class="col-md-3 sign-gd">

                                    <h4>@lang('directline::custom.home_page.footer_menu_title_about')</h4>
                                    <ul>
                                    @foreach(Menus::getMenu('frontend_footer_about_'.$locale,'active') as $menu)
                                     
                           @include('partials.menu.footer_menu_item', compact('menu'))
                                      @endforeach
                                    </ul>
                                   
                                </div> 

                                   <div class="col-md-3 sign-gd">

                                    <h4>@lang('directline::custom.home_page.footer_menu_title_support')</h4>
                                    <ul>
                                    @foreach(Menus::getMenu('frontend_footer_support_'.$locale,'active') as $menu)

                           @include('partials.menu.footer_menu_item', compact('menu'))
                                      @endforeach
                                    </ul>
                                   
                                </div>

                                <div class="col-md-5 sign-gd-two">
                                    <h4>@lang('directline::custom.home_page.footer_title_store_info')</h4>
                                    <div class="dv-address">
                                        <div class="dv-address-grid">
                                            <div class="dv-address-left">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                            </div>
                                            <div class="dv-address-right">
                                                <h6>@lang('directline::custom.home_page.footer_phone_number')</h6>
                                                <p>{{ \Settings::get('phone_number','+9960599593301') }}</p>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="dv-address-grid">
                                            <div class="dv-address-left">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </div>
                                            <div class="dv-address-right">
                                                <h6>@lang('directline::custom.home_page.footer_email')</h6>
                                                <p>Email :<a href="mailto:{{ \Settings::get('contact_form_email') }}"> {{ \Settings::get('contact_form_email') }}</a></p>
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="dv-address-grid">
                                            <div class="dv-address-left">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </div>
                                            <div class="dv-address-right">
                                                <h6>@lang('directline::custom.home_page.footer_address')</h6>
                                                @php
                                                $address = \Settings::get('address_types',[]);
                                                @endphp
                                                 @if(array_key_exists('office', $address))
                                                <p> {{ $address['office'] }} 
                                                    </p>
                                                @endif
                                                
                                            </div>
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                </div>
                              {{--  <div class="col-md-3 sign-gd flickr-post">
                                                    <h4>@lang('directline::custom.home_page.footer_title_new_products')</h4>
                                                    <ul>
                                                        @foreach(Packages\Modules\Ecommerce\Models\Product::take(9)->select(['name', 'image']) as $row)
                
                                                        <li><a href="single.html"><img src="{{ $row->image }}" alt="{{ $row->name }}" class="img-responsive" /></a></li>
                                                       
                                                    @endforeach
                                                    </ul>
                                         </div> --}}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 footer-left">
                        <a href="/"><img src="{{ \Settings::get('site_logo') }}"></a>
                        <p>{{ \Settings::get('site_description_'.app()->getLocale()) }}</p>
                        <ul class="social-nav model-3d-0 footer-social dv_agile_social two">
                            @foreach(\Settings::get('social_links',[]) as $key=>$link)
                            <li><a href="{{ $link }}" class="{{ $key }}" target="_blank">
                                @if($key == 'maroof')

                                <div class="front" style="background-color: #fff"><img src="/assets/themes/directline/images/icon/ma3rof.png" style="max-width: 30px; max-height: 30px;"></div>
                                <div class="back" style="background-color: #b1acac"><img src="/assets/themes/directline/images/icon/ma3rof.png" style="max-width: 30px; max-height: 30px;"></div>
                                @else
                                  <div class="front"><i class="fa fa-{{ $key }}" aria-hidden="true"></i></div>
                                  <div class="back"><i class="fa fa-{{ $key }}" aria-hidden="true"></i></div>
                                 @endif 
                                 </a></li>

                                  @endforeach
                        </ul>
                    </div>
                  
                </div>
                <div class="clearfix"></div>
               {{--  <div class="agile_newsletter_footer row">
                        <div class="col-md-6 newsleft">
                            <h3>SIGN UP FOR NEWSLETTER !</h3>
                         </div>
                        <div class="col-md-6 newsright">
                            <form action="#" method="post">
                                <input type="email" placeholder="Enter your email..." name="email" required="">
                                <input type="submit" value="Submit">
                            </form>
                        </div>
                        <div class="clearfix"></div>
                </div> --}}
                
            </div>

        </div>
          <div class="main-btm-footer">
              <div class="container">
                    <div class="row">
                       <p class="copy-right">{!! \Settings::get('footer_text','') !!}</p>
                    </div>
                </div>
            </div> 
        <!-- //footer -->