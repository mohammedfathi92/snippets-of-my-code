@extends('frontend.layouts.master')
@section("content")
<main>
  <div id="position">
      <div class="container">
          <ul>
              <li><a href="/">{{trans("main.link_frontend_home")}}</a></li>
              <li><a href="{{route("courses.index")}}">{{trans("courses.link_courses")}}</a></li>
              <li>
                  <a href="{{route("course.details",['id'=>$course->id,'slug'=>str_slug($course->{"name:en"})])}}">{{$course->name}}</a>
              </li>
              <li>{{trans("bookings.link_booking")}}</li>
          </ul>
      </div>
  </div><!-- End position -->


  @php
$user = Auth::user();


$currency = Cookie::get('currencyCode')?:"USD";
$getCurrency = \Corsata\Currency::where('code',$currency)->first();
$currencyRate = $getCurrency->value;
$currencyName = $getCurrency->name;
$currencyCode = $getCurrency->code;
@endphp

 <div class="container margin_60">
    {!!Form::open(['url'=>route('booking.store',['id'=>$course->id,'slug'=>$course->{"name:en"}])."?".http_build_query(Request::input()),'method'=>'post','name'=>'bookingForm','id'=>'bookingForm'])!!}
      <div class="row">
          <div class="col-md-8 add_bottom_15">
            @include('frontend.common.flash_message')
              <div class="form_title">
                  <h3><strong>1</strong>{{trans("bookings.step_details")}}</h3>
                  <p>
                      {{trans("bookings.personal_information_heading")}}
                  </p>
              </div>
              <div class="step">
                  <div class="container-fluid school-bordered-box-rounded">
                      <div class="row">
                          <div class="col-md-12">




                              <div class="details-page-red-note">{{trans("bookings.booking_order_note")}}</div>
                              <div class="row nomargin-bottom">
                              <div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('firstName') ? ' has-error' : '' }}">
                                      <label for="first-name">{{trans("bookings.label_first_name")}}<span
                                                  style="color:#F00;">*</span></label>

                                      <input class="form-control" data-val="true"
                                             maxlength="100"
                                             name="firstName" type="text"
                                             id="first-name"
                                             value="{{old("firstName", Auth::check()?$user->name:"")}}" required>
                                      @if ($errors->has('firstName'))
  <span class="help-block">
  <strong>{{ $errors->first('firstName') }}</strong>
  </span>
 @endif  
                                  </div><!--/col-->
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('lastName') ? ' has-error' : '' }}">
                                      <label for="last-name">{{trans("bookings.label_last_name")}} <span
                                                  style="color:#F00;">*</span></label>
                                      <input class="form-control"
                                             id="last-name" maxlength="100"
                                             name="lastName" type="text"
                                             value="{{old("lastName")}}" required>

                                             @if ($errors->has('lastName'))
  <span class="help-block">
  <strong>{{ $errors->first('lastName') }}</strong>
  </span>
 @endif 

                                  </div><!--/col-->
                              </div><!--/row-->
                              <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('email') ? ' has-error' : '' }}">
                                      <label for="email">{{trans("bookings.label_email")}}<span
                                                  style="color:#F00;">*</span>
                                      </label>
                                      <input class="form-control"
                                             maxlength="100"
                                             id="email"
                                             name="email" type="email"
                                             value="{{old("email", Auth::check()?$user->email:"")}}" required>
                                              @if ($errors->has('email'))
  <span class="help-block">
  <strong>{{ $errors->first('email') }}</strong>
  </span>
 @endif 

                                  </div><!--/col-->
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('email_confirmation') ? ' has-error' : '' }}">
                                      <label for="ConfirmEmail">{{trans("bookings.label_email_confirmation")}}<span
                                                  style="color:#F00;">*</span></label>
                                      <input class="form-control"
                                             id="ConfirmEmail" maxlenght="100" name="email_confirmation"
                                             type="email" value="{{old("email_confirmation", Auth::check()?$user->email:"" )}}" required>
                                              @if ($errors->has('email_confirmation'))
  <span class="help-block">
  <strong>{{ $errors->first('email_confirmation') }}</strong>
  </span>
 @endif 
                                  </div><!--/col-->
                              </div><!--/row-->
                              <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('birthDate') ? ' has-error' : '' }}">
                                    <div class="form-group {{ $errors->has('birthDate') ? 'has-error' :'' }}">
                                        <label><i class="icon-calendar-7"></i> {{trans('users.birth_date')}} </label>
                                        <input class="date-pick form-control" name="birthDate" id="birthDate"
                                               value="{{old("birthDate", Auth::check()?$user->birth_date:"" )}}" type="text"
                                               required >
                                                @if ($errors->has('birthDate'))
  <span class="help-block">
  <strong>{{ $errors->first('birthDate') }}</strong>
  </span>
 @endif


                                        @if ($errors->has('birthDate'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('nationality') ? ' has-error' : '' }}">
                                      <label for="nationality">{{trans("bookings.label_nationality")}} <span
                                                  style="color:#F00;">*</span></label>

                                      <select class="form-control" id="nationality" name="nationality" required>
                                          <option value="">{{trans("main.select_option")}}</option>
                                          @foreach(\Corsata\Country::published()->get() as $country)
                                              <option value="{{$country->id}}">{{$country->name}}</option>
                                          @endforeach
                                      </select>
                                       @if ($errors->has('nationality'))
  <span class="help-block">
  <strong>{{ $errors->first('nationality') }}</strong>
  </span>
 @endif 
                                      <span class="field-validation-valid" data-valmsg-for="NationalityId"
                                            data-valmsg-replace="true"
                                            style="color:red;font-size:12px;font-weight:bold;"></span>
                                  </div><!--/col-->

                              </div>

                              <div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('residencePlace') ? ' has-error' : '' }}">
                                      <label for="PlaceOfResidencesId">{{trans("bookings.label_residences_place")}}
                                          <span
                                                  style="color:#F00;">*</span></label>

                                      <select class="form-control" id="PlaceOfResidences"
                                              name="residencePlace" required>
                                          <option value="">{{trans("main.select_option")}}</option>
                                          @foreach(\Corsata\Country::published()->get() as $country)
                                              <option value="{{$country->code}}" {{old('residencePlace')==$country->code?"selected":""}}>{{$country->name}}</option>
                                          @endforeach
                                      </select>
                                       @if ($errors->has('residencePlace'))
  <span class="help-block">
  <strong>{{ $errors->first('residencePlace') }}</strong>
  </span>
 @endif 

                                  </div><!--/col-->

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('city') ? ' has-error' : '' }}">
                                      <label for="city">{{trans("bookings.label_city")}} <span
                                                  style="color:#F00;">*</span></label>

                                      <input class="form-control" data-val="true"
                                             maxlength="100"
                                             name="city" type="text"
                                             id="city-name"
                                             value="{{old("city")}}" required>
                                                @if ($errors->has('city'))
  <span class="help-block">
  <strong>{{ $errors->first('city') }}</strong>
  </span>
 @endif
                                  </div><!--/col-->
                              </div>
                              <div class="form-group {{ $errors->has('address_line1') ? ' has-error' : '' }}">

                                  <label for="address_line1"
                                         class="control-label">{{trans("bookings.label_address_line1")}}</label>

                                  <input type="text" id="address_line1" required name="address_line1"
                                  value="{{old('address_line1', Auth::check()?$user->address:'')}}"
                                         class="form-control">
                                          @if ($errors->has('address_line1'))
  <span class="help-block">
  <strong>{{ $errors->first('address_line1') }}</strong>
  </span>
 @endif    


                              </div>
                              <div class="form-group {{ $errors->has('address_line2') ? ' has-error' : '' }}">
                                  <label for="address_line2"
                                         class="control-label">{{trans("bookings.label_address_line2")}}</label>

                                  <input type="text" id="address_line2" name="address_line2"
                                  value="{{old('address_line2')}}"
                                   class="form-control">
                                    @if ($errors->has('address_line2'))
  <span class="help-block">
  <strong>{{ $errors->first('address_line2') }}</strong>
  </span>
 @endif    

                              </div>

                              <div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6  {{ $errors->has('phone') ? ' has-error' : '' }}">
                                      <label for="PhoneNumber">{{trans("bookings.label_mobile")}}<span
                                                  style="color:#F00;">*</span></label>

                                      <input class="form-control" data-val="true"
                                             id="PhoneNumber" maxlength="15" name="phone"
                                             type="text" value="{{old("phone", Auth::check()?$user->phone:"")}}" required>
                                             @if ($errors->has('phone'))
  <span class="help-block">
  <strong>{{ $errors->first('phone') }}</strong>
  </span>
 @endif 
                                  </div><!--/col-->
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('whatsappNumber') ? ' has-error' : '' }}">
                                      <label for="WhatsAppNumber">{{trans("bookings.label_whatsapp_number")}}<span
                                                  style="color:#F00;">*</span></label>

                                      <input class="form-control" data-val="true"
                                             id="WhatsAppNumber" maxlength="15" name="whatsappNumber"
                                             type="text" value="{{old("whatsappNumber", Auth::check()?$user->phone:"")}}">

                                              @if ($errors->has('whatsappNumber'))
  <span class="help-block">
  <strong>{{ $errors->first('whatsappNumber') }}</strong>
  </span>
 @endif 
                                  </div><!--/col-->

                              </div>



<div class="form-group {{ $errors->has('communication_source') ? ' has-error' : '' }}">
                                      <label for="CommunicationSourceID">{{trans("bookings.label_communication_source")}} <span
                                                  style="color:#F00;">*</span></label>
                                      <select class="form-control" id="CommunicationSourceID"
                                              name="communication_source" required>
                                          <option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option>
                                          <option value="email" {{old('communication_source')}}>{{trans("bookings.option_communication_types.email")}}</option>
                                          <option value="mobile">{{trans("bookings.option_communication_types.mobile")}}</option>
                                          <option value="whatsapp">{{trans("bookings.option_communication_types.whatsapp")}}</option>
                                          <option value="sms">{{trans("bookings.option_communication_types.sms")}}</option>
                                      </select>
                                      @if ($errors->has('communication_source'))
  <span class="help-block">
  <strong>{{ $errors->first('communication_source') }}</strong>
  </span>
 @endif    

                                  </div>

        <div class="form-group {{ $errors->has('media') ? ' has-error' : '' }}">
      <label for="CommunicationSourceID">{{trans("bookings.label_documents")}} </label>


                 <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("bookings.text_media_hint")}}</div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("media")?"has-error":''}}"
                         data-ng-controller="uploaderCtrl"
                         data-upload-url="{{url("$locale/upload")}}"
                         data-resize="200,150"
                         data-prefix="media_"
                    >
                        <div class="">
                            <a id="media"
                               class="btn btn-default"
                               ngf-select="uploadFile($files, $invalidFiles)"
                               ng-model="booking"
                               ngf-pattern="'*/*'"
                               ngf-accept="'*/*'"
                               ngf-max-size="10MB"
                               ngf-keep="true"
                               ngf-multiple="true"
                            >
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>
                            @if ($errors->has('media'))
                                <span class="help-block">
                                <strong>{{ $errors->first('media') }}</strong>
                            </span>
                            @endif
                            <div class="clearfix"></div>
                            <div class="">

                                <div ng-repeat="f in files">
                                    <div class="thumbnail col-sm-6 col-md-4 col-lg-4">
                                        <img src="/images/file_default.png" height="70" width="70" 
                                             class="">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeFile($index)"
                                           ng-show="files">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="media[]" value="<%f.result.file%>"
                                               ng-if="f && f.progress==100">
                                        <div class="progress  active" ng-show="f.progress >= 0"
                                             ng-hide="f.progress==100"
                                             ng-if="f">
                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                 role="progressbar" aria-valuenow="<%f.progress%>"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100" style="width: <%f.progress%>%">
                                                <span class="sr-only"><% f.progress %> % Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

     @if ($errors->has('media'))
  <span class="help-block">
  <strong>{{ $errors->first('media') }}</strong>
  </span>
 @endif    

                                  </div>                          
                              
              <div class="form-group {{ $errors->has('notes') ? ' has-error' : '' }}">


                                  <div class="col-md-12 col-sm-12 margin-bottom-15">
                                      <label for="notes">{{trans("bookings.label_notes")}}</label>
                                      <textarea class="form-control" cols="20" id="notes" maxlength="500" name="notes"
                                                placeholder="{{trans("bookings.holder_notes")}}" rows="2">{{old("notes")}}</textarea>

                                                 @if ($errors->has('notes'))
  <span class="help-block">
  <strong>{{ $errors->first('notes') }}</strong>
  </span>
 @endif 

                                  </div>
                                  <!--/col-->
                              </div>


                          

                          
                      </div>
                    </div>

                  </div>
              </div><!--End step -->
              <br>

              <div class="form_title">
                  <h3><strong>2</strong>{{trans("bookings.step_payments")}}</h3>

              </div>

              <div class="step">

               <div class="form-group" data-ng-init="paymentMethod='creditCard'">
                      <label for="card_type">{{trans("bookings.label_payment_method")}}</label>
                     {{--     <div class="radio">
                          <label for="paymentMethodCredit">
                              <input type="radio" id="paymentMethodCredit"
                                     name="paymentMethod"
                                     value="creditCard"
                                     checked
                                     data-ng-model="paymentMethod">

                              <img src="/assets/img/cards.png" alt="credit cards">

                          </label>
                      </div>
                      <div class="radio">
                          <label for="paymentMethodPayPal">
                              <input type="radio" id="paymentMethodPayPal" name="paymentMethod"
                                     value="paypal"
                                     data-ng-model="paymentMethod">

                              <img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left"
                                   style="margin-right:7px;"><span
                                      style="font-size:11px; font-family: Arial, Verdana;">{{trans('bookings.paypal_hint')}}</span>
                          </label>
                      </div> --}}

                       <div class="radio">
                          <label for="paymentMethodPayPal">
                              <input type="radio" id="paymentMethodoffice" name="paymentMethod"
                                     value="office"
                                     data-ng-model="paymentMethod">

                              <img src="/images/pay-offline.png" alt="{{trans('bookings.institutes_payment_hint')}}" height="40" width="50" align="left"
                                   style="margin-right:7px;"><span
                                      style="font-size:11px; font-family: Arial, Verdana;">{{trans('bookings.institutes_payment_hint')}}</span>
                          </label>
                      </div>


                  </div>
          {{--         <div id="creditCards row"
                       data-ng-show="paymentMethod=='creditCard'">
                      <div class="row">
                          <div class=" col-md-6 col-sm-6">
                              <div class="form-group">
                                  <label class="" for="cardType">{{trans("bookings.label_card_type")}}</label>
                                  <select name="card_type" id="cardType" class="form-control">
                                      <option value="visa"> Visa</option>
                                      <option value="mastercard"> Mastercard</option>
                                      <option value="discover"> Discover Card</option>
                                      <option value="AMEX">American Express Card</option>
                                  </select>
                              </div>
                          </div>

                      </div>
                      <div class="form-group">
                          <label>{{trans("bookings.label_card_name")}}</label>
                          <input type="text" class="form-control" id="cardHolder" name="card_holder">
                      </div>
                      <div class="row">
                          <div class="col-md-9 col-sm-9">
                              <div class="form-group">
                                  <label>{{trans("bookings.label_card_number")}}</label>
                                  <input type="number" id="card_number" name="card_number" class="form-control">
                              </div>
                          </div>

                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <label>{{trans("bookings.label_card_expiration_date")}}</label>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <select name="expire_month" id="card_expire_month" class="form-control">
                                              @for($i=1;$i<=12;$i++)
                                                  <option value="{{$i}}" {{date("m")+1==$i?"selected":""}}>{{sprintf("%02d", $i)}}</option>
                                              @endfor
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <select name="expire_year" id="card_expire_year" class="form-control">
                                              @for($i=date("Y");$i<=date("Y")+10;$i++)
                                                  <option value="{{$i}}">{{$i}}</option>
                                              @endfor
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{trans('bookings.security_code')}}</label>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <input type="number" id="ccv" name="ccv" class="form-control"
                                                     maxlength="4"
                                                     minlength="3"
                                                     placeholder="CCV">
                                          </div>
                                      </div>
                                      <div class="col-md-8">
                                          <img src="/assets/img/icon_ccv.gif" width="50" height="29" alt="ccv">
                                          <small>{{trans('bookings.last_digits')}}</small>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
                  <div id="paypal-button-container" data-ng-show="paymentMethod=='paypal'">
                    <p>{{trans('bookings.paypal_method_selected_text')}}</p>
                  </div> --}}

                  <div class="row" data-ng-show="paymentMethod=='office'">
                    <p>{{trans('bookings.office_method_selected_text')}}</p>
                  </div>

              </div><!--End step -->

              <div id="policy">
                  <h4>{{trans('bookings.previcy_conditions')}}</h4>
                  <div class="form-group">
                      <label><input type="checkbox" name="policy_terms" id="policy_terms" required> {{trans('bookings.previcy_conditions_text')}} </label>
                  </div>
                  <button class="btn_1 green medium" type="submit" form="bookingForm">{{trans("bookings.btn_confirm_booking")}}</button>
              </div>
          </div>

          <aside class="col-md-4">
              <div class="box_style_1">
                  <h3 class="inner">{{trans("bookings.summary_box_title")}}</h3>
                  <table class="table table_summary">
                      <tbody>
                      <tr>
                          <td>
                              {{trans("bookings.label_course_name")}}
                          </td>
                          <td class="text-right">
                              {{$course->name}}
                          </td>
                      </tr>
                      <tr>
                          <td>
                              {{trans("bookings.label_institute_name")}}
                          </td>
                          <td class="text-right">
                              {{$course->institute->name}}
                          </td>
                      </tr>
                      <tr>
                          <td>
                              {{trans("bookings.label_country_name")}}
                          </td>
                          <td class="text-right">
                              {{$course->institute->country?$course->institute->country->name:"--"}}
                          </td>
                      </tr>
                      <tr>
                          <td>
                              {{trans("bookings.label_city_name")}}
                          </td>
                          <td class="text-right">
                              @if($course->institute->city)
                                  {{$course->institute->city->name}}
                              @endif
                          </td>
                      </tr>
                      @if(Request::query("startDate"))
                          <tr>
                              <td>
                                  {{trans("courses.label_start_date")}}
                              </td>
                              <td class="text-right">
                                  {{Request::query("startDate")}}
                              </td>
                          </tr>
                      @endif
                      <tr>
                          <td>
                              {{trans("bookings.total_cost")}}
                          </td>
                          <td>
                            {{round($currencyRate * $course->totalCost)}}
                            <sup style="font-size: 12px">{{$currencyName}}</sup>
                              
                          </td>
                      </tr>
                      </tbody>
                  </table>
                  <button type="submit" form="bookingForm" class="btn_full" href="">{{trans('bookings.btn_book_compelete')}}</button>

              </div>
              @include('frontend.includes.help_col')
          </aside>

      </div><!--End row -->
      {!!Form::close()!!}
  </div><!--End container -->

</main>

@stop

@section('styles')
 <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
@stop

@section("scripts")
  <!--   <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
//                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function (data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: {total: '0.01', currency: 'USD'}
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function (data, actions) {

                actions.payment.cancel().then(function () {
                    console.log("it's canceled");
                })
                // Make a call to the REST api to execute the payment
                actions.payment.execute().then(function (resp) {
                    console.log("payment response");
                    console.log(resp);
                });
            }

        }, '#paypal-button-container');

    </script> -->

    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', 'today');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>
@endsection

