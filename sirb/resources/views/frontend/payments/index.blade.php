@extends('frontend.layouts.master')
@section("meta")

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {{--Generate alternate link for other locales--}}
        @if($localeCode !=LaravelLocalization::getCurrentLocale())
            <link rel="alternate" hreflang="{{$localeCode}}"
                  href="{{\LaravelLocalization::localizeURL("booking",$localeCode)}}"/>
        @endif
    @endforeach

@endsection
@section("page_title")
    <div class="page-title-container">
        <div class="container">
            <div class="page-title pull-left">
                <h2 class="entry-title">{{trans("bookings.title_paymeny_request")}}</h2>
            </div>
            <ul class="breadcrumbs pull-right">
                <li><a href="{{\LaravelLocalization::localizeURL("/")}}">{{trans("main.nav_home")}}</a></li>
                <li class="active">{{trans("bookings.title_paymeny_request")}}</li>
            </ul>
        </div>
    </div>
@endsection
@section("content")
    <div class="container">
        <div class="col-sms-6 col-sm-8 col-md-9">
            <div class="booking-section travelo-box">
                @if($errors->count())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if($alert_type=Session::get("alert-type"))
                    <div class="alert alert-{{$alert_type=="success"?"success":"danger"}}">
                        <p>{{Session::get("message")}}</p>
                    </div>
                @endif
                {!! Form::open(['route'=> ['payment.store',$data->payment_url], 'method'=>'post']) !!}
                <div class="person-information">
                    <h2>{{trans("bookings.personal_information_heading")}}</h2>
                    <div class="form-group row ">
                        <div class="col-sm-12 col-md-6">
                            <label>{{trans("bookings.label_client_name")}}</label>
                            <input type="text" name="name" class="input-text full-width" value="{{$data->first_name}} {{$data->last_name}}"
                                   placeholder="" disabled/>
                        
                        </div>
                       <div class="col-sm-12 col-md-6">
                            <label>{{trans("bookings.label_mobile")}}</label>
                            <input type="tel" required name="mobile" class="input-text full-width"
                                   value="{{$data->whatsapp}}"
                                   placeholder="" dir="ltr" disabled/>

                           
                        </div>

                    </div>
                    <div class="form-group row ">
                        <div class="col-sm-6 col-md-4">
                            <label>{{trans("bookings.label_payment_code")}}</label>
                            <input type="text" name="name" class="input-text full-width" value="{{$data->payment_code}}"
                                   placeholder="" disabled/>
                      
                        </div>
                       <div class="col-sm-6 col-md-4">
                            <label>{{trans("bookings.label_payment_price")}}</label>
                             <input type="text" name="name" class="input-text full-width" value="{{$data->price}}"
                                   placeholder="" disabled/>
                        </div>
                          <div class="col-sm-6 col-md-4">
                            <label>{{trans("bookings.label_package_num")}}</label>
                             <input type="text" name="name" class="input-text full-width" value="{{$data->package_num}}"
                                   placeholder="" disabled/>
                        </div>

                    </div>

                       <div class="form-group row ">
                        <div class="col-sm-12 col-md-12">
                            <label><strong>{{trans("bookings.label_payment_pay_for")}}</strong></label>
                           {{$data->title}} <br> {{$data->details}}
                           
                        </div>
                     

                    </div>

                       <div class="step">
                        <div class="form-group row ">

       <div id="bt_payment_form" style="text-align: right;"></div>
      

                    
                    </div>


                {{--  <div class="form-group" data-ng-init="paymentMethod='creditCard'">
                                                      <label for="card_type"><strong>{{trans("bookings.label_payment_method")}}</strong></label>
                                                      <div>
                                                         
                                                              <input type="radio" id="paymentMethodCredit"
                                                                     name="paymentMethod"
                                                                     value="creditCard"
                                                                     checked
                                                                     data-ng-model="paymentMethod">
                                
                                                             <span> <img src="/images/cards.png" alt="credit cards" style="display: inline;"></span> بطاقة إئتمان
                                
                                                         
                                                      </div>
                                
                                                      <div>
                                                         
                                                              <input type="radio" id="paymentMethodPayPal" name="paymentMethod"
                                                                     value="paypal"
                                                                     data-ng-model="paymentMethod">
                                
                                                             <span> <img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif"
                                                                   style="margin-right:7px; display: inline;"> </span>حساب باي بال
                                                         
                                                      </div>
                                
                                
                                
                                                  </div>
                                                  <div id="creditCards"
                                                       data-ng-show="paymentMethod=='creditCard'">
                                                      <div class="row">
                                                           <div id="dropin-container"></div>
                                
                                                      </div>
                                                     
                                                  </div>
                                                  <div id="paypal-button-container" data-ng-show="paymentMethod=='paypal'">
                                                    <p>{{trans('bookings.paypal_method_selected_text')}}</p>
                                                  </div> --}}

                  

              </div><!--End step -->

                   
                    
                   
                   
                </div>
                <hr/>
                <input type="hidden" name="booking_type" value="free">
{{--                {!! ReCaptcha::render(['lang' => $locale]) !!}--}}
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6 col-md-5">
                        <button type="submit"
                                class="full-width btn-large">{{trans("bookings.btn_confirm_payment")}}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="sidebar col-sms-6 col-sm-4 col-md-3">
            @if(settings('show_help_box'))
                <div class="travelo-box contact-box">
                    <h4>{!! settings("{$locale}_help_box_title") !!}</h4>
                    <p> {!! settings("{$locale}_help_box_details") !!}</p>

                </div>
            @endif
        </div>
    </div>

@stop

@section('scripts')

 
   <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
    <script type="text/javascript">
       
            braintree.setup('{{ Braintree_ClientToken::generate() }}', 'dropin', {
                container: 'bt_payment_form'
            });
       
    </script>

@stop