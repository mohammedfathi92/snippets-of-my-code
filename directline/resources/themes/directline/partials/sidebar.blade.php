{{-- <h3>@lang('Packages-basic::labels.partial.sidebar')</h3> --}}


		            <div class="card">
		              <div class="card-body box-profile">
		          

		                <p class="profile-username text-center"><img src="{{ \Settings::get('site_logo_black') }}"></p>

		                <p class="text-muted text-center">{{ \Settings::get('site_description_'.app()->getLocale()) }}
		                </p>

		                <ul class="list-group list-group-unbordered mb-3">

		                 <li class="list-group-item">
		                    <span> <i class="fa fa-phone" aria-hidden="true"></i> @lang('directline::custom.home_page.footer_phone_number') :</span> <p><a href="javascript:;"> {{ \Settings::get('phone_number','+9960599593301') }} </a></p>
		                  </li> 	
		                
		                  <li class="list-group-item">
		                    <span><i class="fa fa-envelope" aria-hidden="true"></i> @lang('directline::custom.home_page.footer_email') :</span> <p><a href="mailto:{{ \Settings::get('contact_form_email') }}"> {{ \Settings::get('contact_form_email') }}</a></p>
		                  </li>

		                 <li class="list-group-item">
		                    <span><i class="fa fa-map-marker" aria-hidden="true"></i> @lang('directline::custom.home_page.footer_address') :</span> <p>  @php
                                                $address = \Settings::get('address_types',[]);
                                                @endphp
                                                 @if(array_key_exists('office', $address))
                                                <a href="javascript:;"> {{ $address['office'] }} 
                                                    </a>
                                                @endif</p>
		                  </li>


		                </ul>
               

		              </div>
		            </div>

		       
		        