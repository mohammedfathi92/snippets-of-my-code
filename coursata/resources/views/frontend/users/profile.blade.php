@extends('frontend.layouts.master')
@section("content")

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{url('/')}}">{{trans('users.home_page')}}</a></li>
                <li>{{trans('users.my_account')}}</li>
            </ul>
        </div>
    </div><!-- End Position -->
    @if(Session::has("message"))
        @if(Session::get("alert-type")=="error")
            <div class="alert alert-danger">{!! Session::get("message") !!}</div>
        @endif

        @if(Session::get("alert-type")=="success")
            <div class="alert alert-success">{!! Session::get("message") !!}</div>
        @endif
    @endif
    <main>
        <div class="margin_60 container">
            <aside class="col-md-2" id="sidebar">
        <div class="theiaStickySidebar">
        <div class="box_style_cat">
            @include('frontend.users.side_menu')
            </div>
        </div><!--End sticky -->
        </aside>
        <div class="col-md-10 add_bottom_15">
            <div class="content" style="background-color: #fff; padding: 10px;">
                
               

                         {!!Form::open(['url'=>'/account','method'=>'post','name'=>'bookingForm','id'=>'bookingForm'])!!}
                        <div class="row">
                            <div class="col-md-8">
                                <h4 style="background-color: #565a5c; padding: 10px; color: #fff">{{trans('users.your_profile')}}</h4>
                                <ul id="profile_summary">

                                    <li>{{trans('users.full_name')}} : <br>{{ $data->name }}</li>
                                    <li>{{trans('users.email')}} :<br> {{ $data->email }}</li>
                                    <li>{{trans('users.birth_date')}} : <br>{{ $data->birth_date }}</li>
                                    <li>{{trans('users.phone_no')}} : <br>{{ $data->phone }}</li>
                                    <li>{{trans('users.label_country')}}
                                        :<br> {{$data->country?$data->country->name:"--"}} </li>
                                    <li>{{trans('users.label_city')}} :<br> {{ $data->city_name }}</li>
                                    <li>{{trans('users.address')}} :<br> {{ $data->address_line1 }}<br> {{ $data->address_line1 }}</li>
                                    <!-- <li>{{trans('users.zip_code')}} <span>{{ $data->zip_code }}</span></li> -->

                                </ul>
                            </div>

                            <div class="col-md-4">
                                 <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("users.label_profile_photo")}} <span
                            class="text-danger">*</span></div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("photo")?"has-error":''}}"
                         data-ng-controller="uploaderCtrl"
                         data-upload-url="{{url("$locale/upload")}}"
                         data-resize="200,150"
                         data-prefix="institute_">

                        <div class="">
                            <div class="">
                                @if($data->avatar)
                                    <div class="thumbnail" id="file-{{$data->photo}}" data-ng-if="!photo" style="border: none;">
                                        <img src="{{url('files/{$data->avatar}')}}" alt="$data->name"
                                             class="responsive-img img-thumbnail" width="200" height="200">
                                        <input type="hidden" name="photo" value="{{$data->avatar}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{$data->avatar}}')">{{trans("main.btn_delete")}}</a>
                                    </div>
                                   @else
                                    <div class="thumbnail" id="file-{{$data->photo}}" data-ng-if="!photo" style="border: none;">
                                        <img src="/images/default-avatar.jpg" alt="$data->name"
                                             class="responsive-img img-thumbnail" width="200" height="200">
                                        <input type="hidden" name="photo" value="{{$data->avatar}}">
                                        
                                    </div>
                                    
                                @endif
                                <div ng-repeat="f in photos">
                                    <div class="thumbnail">
                                        <img ng-show="form.photo.$valid" ngf-thumbnail="f"
                                             class="responsive-img img-thumbnail" width="200" height="200">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removePhoto($index)"
                                           ng-show="photo">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="photo" value="<%f.result.file%>"
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
                            <div class="clearfix"></div>
                            <a id="photo"
                               class="btn btn btn-default"
                               ngf-select="uploadPhoto($files, $invalidFiles)"
                               ng-model="photo"
                               ngf-pattern="'image/*'"
                               ngf-accept="'image/*'"
                               ngf-max-size="10MB">
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>

                            @if ($errors->has('photo'))
                                <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>


                </div>
            </div>


                            </div>
                        </div>
                        </div><!-- End row -->

                        <div class="divider"></div>
                        

   

      <div class="row">
          <div class="col-md-11 add_bottom_15">
            @include('frontend.common.flash_message')
              <div class="form_title">
                  <h3>{{trans("bookings.step_details")}}</h3>
                  <p>
                      {{trans("bookings.personal_information_heading")}}
                  </p>
              </div>
             
                  <div class="container-fluid school-bordered-box-rounded">
                      <div class="row">
                          <div class="col-md-12">




                             
                              <div class="row nomargin-bottom">
                              <div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('firstName') ? ' has-error' : '' }}">
                                      <label for="first-name">{{trans("bookings.label_first_name")}}<span
                                                  style="color:#F00;">*</span></label>

                                      <input class="form-control" data-val="true"
                                             maxlength="100"
                                             name="firstName" type="text"
                                             id="first-name"
                                             value="{{old("firstName", $data->first_name)}}">
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
                                             value="{{old("lastName", $data->last_name)}}">

                                             @if ($errors->has('lastName'))
  <span class="help-block">
  <strong>{{ $errors->first('lastName') }}</strong>
  </span>
 @endif 

                                  </div><!--/col-->
                              </div><!--/row-->

                              <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('birthDate') ? ' has-error' : '' }}">
                                    <div class="form-group {{ $errors->has('birthDate') ? 'has-error' :'' }}">
                                        <label><i class="icon-calendar-7"></i> {{trans('users.birth_date')}} </label>
                                        <input class="date-pick form-control" name="birthDate" id="birthDate"
                                               value="{{old("birthDate", $data->birth_date?$data->birth_date:"")}}" type="text"
                                               >
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

                                      <select class="form-control select2" id="residencePlace" name="nationality">
                                          <option value="">{{trans("main.select_option")}}</option>
                                          @foreach(\Corsata\Country::published()->get() as $country)
                                              <option value="{{$country->id}}"{{old("nationality",$data->nationality)==$country->id?"selected":""}}>{{$country->name}}</option>
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

                                      <select class="form-control select2" id="residencePlace" name="nationality">
                                          <option value="">{{trans("main.select_option")}}</option>
                                          @foreach(\Corsata\Country::published()->get() as $country)
                                              <option value="{{$country->id}}"{{old("nationality",$data->nationality)==$country->id?"selected":""}}>{{$country->name}}</option>
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
                                             value="{{old("city", $data->city_name)}}">
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
                                  value="{{old('address_line1',  $data->address_line1)}}"
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
                                  value="{{old('address_line2', $data->address_line2)}}"
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
                                             type="text" value="{{old("phone", $data->phone)}}">
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
                                             type="text" value="{{old("whatsappNumber", $data->whatsapp)}}">

                                              @if ($errors->has('whatsappNumber'))
  <span class="help-block">
  <strong>{{ $errors->first('whatsappNumber') }}</strong>
  </span>
 @endif 
                                  </div><!--/col-->

                              </div>


              <div class="form-group {{ $errors->has('about') ? ' has-error' : '' }}">


                                  <div class="col-md-12 col-sm-12 margin-bottom-15">
                                      <label for="about">{{trans("users.label_about")}}</label>
                                      <textarea class="form-control" cols="20" id="about" maxlength="500" name="about"
                                                placeholder="{{trans("users.label_about_holder")}}" rows="2">{{old("about", $data->about)}}</textarea>

                                                 @if ($errors->has('about'))
  <span class="help-block">
  <strong>{{ $errors->first('about') }}</strong>
  </span>
 @endif 

                                  </div>
                                  <!--/col-->
                              </div>

       
                     

                          
                      </div>
                    </div>
                    <br>
                    <center><button type="submit" class="btn_1 green">{{trans('users.btn_update_profile')}}</button> </center>
  
                  </div>
             
              <br>


             
          </div>

       

      </div><!--End row -->
      
{!!Form::close()!!}
                    
   </div>         
        </div>

        </div><!-- end container -->
    </main>



@stop

@section("styles")

    <!-- CSS -->
    <link href="/assets/css/admin.css" rel="stylesheet">
    <link href="/assets/css/jquery.switch.css" rel="stylesheet">
    <link href="/assets/css/date_time_picker.css" rel="stylesheet">
    <style type="text/css">
        a .btn_3 {background-color: #e04f67; color: #fff;}
    </style>
    <style>
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    
    .table > tbody > tr > .no-line {
        border-top: none;
    }
    
    .table > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    </style>
    
@stop

@section("scripts")

   
  
    <!-- Date and time pickers -->
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap-timepicker.js"></script>
    <script>
        $('input.date-pick').datepicker('setDate', '');
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false
        })
    </script>

 <!-- Fixed sidebar -->
<script src="/assets/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
      additionalMarginTop: 80
    });
</script>
<!-- Cat nav mobile -->
<script  src="/assets/js/cat_nav_mobile.js"></script>
<script>$('#cat_nav').mobileMenu();</script>


@stop