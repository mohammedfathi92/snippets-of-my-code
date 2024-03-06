<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")
@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-study"></i> {{trans("bookings.backend_page_create_header")}} </h1>
@stop
@section("content")
    <div class="page-content container-fluid">
        @if($errors->count())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {!! Form::open(['class'=>'form-horizontal','name'=>'form','novalidate', 'method'=>'put']) !!}
        <div class="col-md-8">


          <div class="panel panel-primary">
                <div class="panel-heading">{{trans("main.tab_general")}}</div>
                
                <div class="panel-body">
                  <br>
                  <div class="row nomargin-bottom">
                    <div class="col-md-6 col-sm-6 margin-bottom-15">

                    <h4> 1) Personal Info </h4>

                  </div>
                </div>
                  <hr>

                              <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('user') ? ' has-error' : '' }}">

<input type="hidden" name="user_id" value="{{$data->id}}">

               
            </div>
          </div>
                 
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
                                <div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                      <label for="gender">{{trans("bookings.label_gender")}} <span
                                                  style="color:#F00;">*</span></label>
                                      <select class="form-control" id="genderID"
                                              name="gender">
                                          <option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option>
                                          <option value="m" {{old("gender",$data->gender)=="m"?"selected":""}}>{{trans("bookings.option_male")}}</option>
                                          <option value="f" {{old("gender",$data->gender)=="mobile"?"selected":""}}>{{trans("bookings.option_female")}}</option>
                                     
                                      </select>
                                      @if ($errors->has('gender'))
  <span class="help-block">
  <strong>{{ $errors->first('gender') }}</strong>
  </span>
 @endif    

                                  </div>
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('email') ? ' has-error' : '' }}">
                                      <label for="email">{{trans("bookings.label_email")}}<span
                                                  style="color:#F00;">*</span>
                                      </label>
                                      <input class="form-control"
                                             maxlength="100"
                                             id="email"
                                             name="email" type="email"
                                             value="{{old("email", $data->email)}}">
                                              @if ($errors->has('email'))
  <span class="help-block">
  <strong>{{ $errors->first('email') }}</strong>
  </span>
 @endif 

                                  </div><!--/col-->

                              </div><!--/row-->
                              <div class="row nomargin-bottom">

                  <div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('birthDate') ? ' has-error' : '' }}">
                <label for="birthDate" >{{trans("users.birth_date")}}</label>
                
                    <input type="text" class="form-control datepicker" name="birthDate"
                           value="{{old("birthDate", $data->birth_date)}}">

                            @if ($errors->has('birthDate'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                                        @endif
                
            </div>

                               

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('nationality') ? ' has-error' : '' }}">
                                      <label for="residencePlace">{{trans("bookings.label_nationality")}} <span
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
                                      <span class="field-validation-valid" data-valmsg-for="residencePlace"
                                            data-valmsg-replace="true"
                                            style="color:red;font-size:12px;font-weight:bold;"></span>
                                  </div><!--/col-->

                              </div>

                              <div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('residencePlace') ? ' has-error' : '' }}">
                                      <label for="PlaceOfResidencesId">{{trans("bookings.label_residences_place")}}
                                          <span
                                                  style="color:#F00;">*</span></label>

                                      <select class="form-control select2" id="PlaceOfResidences"
                                              name="residencePlace">
                                          <option value="">{{trans("main.select_option")}}</option>
                                          @foreach(\Corsata\Country::published()->get() as $country)
                                              <option value="{{$country->id}}" {{old("residencePlace",$data->residence_place)==$country->id?"selected":""}}>{{$country->name}}</option>
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
                                             value="{{old("city",$data->city_name)}}">
                                                @if ($errors->has('city'))
  <span class="help-block">
  <strong>{{ $errors->first('city') }}</strong>
  </span>
 @endif
                                  </div><!--/col-->
                              </div>
                            <div class="row nomargin-bottom">

                              <div class="col-md-6 col-sm-5 margin-bottom-15 {{ $errors->has('zip_code') ? ' has-error' : '' }}">

                                  <label for="zip_code"
                                         class="control-label">{{trans("bookings.label_zip_code")}}</label>

                                  <input type="text" id="zip_code" required name="zip_code"
                                  value="{{old('zip_code', $data->zip_code)}}"
                                         class="form-control">
                                          @if ($errors->has('zip_code'))
  <span class="help-block">
  <strong>{{ $errors->first('zip_code') }}</strong>
  </span>
 @endif    


                              </div>
                            </div>     
                         <div class="row nomargin-bottom">

                              <div class="col-md-12 col-sm-12 margin-bottom-15 {{ $errors->has('address_line1') ? ' has-error' : '' }}">

                                  <label for="address_line1"
                                         class="control-label">{{trans("bookings.label_address_line1")}}</label>

                                  <input type="text" id="address_line1" required name="address_line1"
                                  value="{{old('address_line1', $data->address_line1)}}"
                                         class="form-control">
                                          @if ($errors->has('address_line1'))
  <span class="help-block">
  <strong>{{ $errors->first('address_line1') }}</strong>
  </span>
 @endif    


                              </div>
                            </div>
                              <div class="row nomargin-bottom">

                              <div class="col-md-12 col-sm-12 margin-bottom-15 {{ $errors->has('address_line2', $data->address_line2) ? ' has-error' : '' }}">
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


<div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('communication_source') ? ' has-error' : '' }}">
                                      <label for="CommunicationSourceID">{{trans("bookings.label_communication_source")}} <span
                                                  style="color:#F00;">*</span></label>
                                      <select class="form-control" id="CommunicationSourceID"
                                              name="communication_source">
                                          <option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option>
                                          <option value="email" {{old("communication_source",$booking->communication_source)=="email"?"selected":""}}>{{trans("bookings.option_communication_types.email")}}</option>
                                          <option value="mobile" {{old("communication_source",$booking->communication_source)=="mobile"?"selected":""}}>{{trans("bookings.option_communication_types.mobile")}}</option>
                                          <option value="whatsapp" {{old("communication_source",$booking->communication_source)=="whatsapp"?"selected":""}}>{{trans("bookings.option_communication_types.whatsapp")}}</option>
                                          <option value="sms" {{old("communication_source",$booking->communication_source)=="sms"?"selected":""}}>{{trans("bookings.option_communication_types.sms")}}</option>
                                      </select>
                                      @if ($errors->has('communication_source'))
  <span class="help-block">
  <strong>{{ $errors->first('communication_source') }}</strong>
  </span>
 @endif    

                                  </div>
                                </div>

                                <div class="row nomargin-bottom">
                              
              <div class="col-md-12 col-sm-12 margin-bottom-15 {{ $errors->has('notes') ? ' has-error' : '' }}">


                                 
                                      <label for="notes">{{trans("bookings.label_notes")}}</label>
                                      <textarea class="form-control" cols="20" id="notes" maxlength="500" name="notes"
                                                placeholder="{{trans("bookings.holder_notes")}}" rows="2">{{old("notes",$booking->notes)}}</textarea>

                                                 @if ($errors->has('notes'))
  <span class="help-block">
  <strong>{{ $errors->first('notes') }}</strong>
  </span>
 @endif 

                                  
                                  </div>
                                </div>
<hr>
                                <div class="row nomargin-bottom">
                    <div class="col-md-6 col-sm-6 margin-bottom-15">

                    <h4> 2) Booking Info </h4>


                  </div>
                </div>

                <!-- institutes || services || Courses -->
 <div data-ng-controller="instituteServicesCoursesCtrl">

             <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('institute') ? ' has-error' : '' }}">

                <label for="institute">{{trans("bookings.label_institute")}}</label>
               
                     <select class="form-control select2" id="institutes" data-ng-model="institute"
                     data-ng-init="institute='{{old("institute",$booking->institute_id)}}'"
                                              name="institute">
                                          <option value="">{{trans("main.select_option")}}</option>
                                          @foreach(\Corsata\Institute::published()->get() as $institute)
                                                <option value="{{$institute->id}}" {{old("institute",$booking->institute_id)==$institute->id?"selected":""}} >{{$institute->name}}</option>

                                          @endforeach
                                      </select>
                                       @if ($errors->has('institute'))
  <span class="help-block">
  <strong>{{ $errors->first('institute') }}</strong>
  </span>
 @endif 
               
            </div>
          </div>


 <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('course') ? ' has-error' : '' }}">
                <label for="course">{{trans("bookings.label_course")}}</label>
               
                       <select name="course" id="course" data-ng-model="course" class=" form-control"
                                        data-ng-init="course='{{old('course',$booking->course_id)}}'"
                                        data-ng-disabled="!coursesList.length">
                                    <option value=""></option>
                                    <option data-ng-repeat="course in coursesList" value="<%course.id%>"
                                      
                                           ><%course.name%>
                                    </option>
                                </select>
                       @if ($errors->has('course'))
  <span class="help-block">
  <strong>{{ $errors->first('course') }}</strong>
  </span>
 @endif 
                
            </div>

        <div class="col-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('course_price') ? ' has-error' : '' }}">
                <label for="course_price" >{{trans("bookings.label_course_custom_price_per_week")}}</label>
                      <input type="number"  name="course_price" start="0" id="course_price" min="0" placeholder="0" 
                      class="form-control"
                      data-ng-disabled="!course.length" value="{{$booking->course_week_price}}">
                      <div>
  <span class="help-block">
  <strong>{{ trans('bookings.msg_custom_price') }}</strong>
  </span> 
  </div>
  <div>

 @if ($errors->has('course_price'))
  <span class="help-block">
  <strong>{{ $errors->first('course_price') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>

             <div class="col-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('course_weeks') ? ' has-error' : '' }}">
                <label for="course_weeks" >{{trans("bookings.label_course_weeks")}}</label>
                      <input type="number"  name="course_weeks" min="1" placeholder="1"  id="course_weeks"  class="form-control" 
                      data-ng-disabled="!course.length" value="{{$booking->course_weeks}}"> 
             
  <div>

 @if ($errors->has('course_weeks'))
  <span class="help-block">
  <strong>{{ $errors->first('course_weeks') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>

          </div>

           <div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('house_service') ? ' has-error' : '' }}">
                <label for="house_service">{{trans("bookings.label_house_service")}}</label>
                      <select name="house_service" id="house_service" data-ng-model="house_service" class=" form-control"
                                        data-ng-init="house_service= '{{old('house_service',$house?$house->service_id:'')}}'"
                                        data-ng-disabled="!houseServicesList.length">
                                    <option value=""></option>
                                    <option data-ng-repeat="service in houseServicesList" value="<%service.id%>" 
                                           ><%service.name%>
                                    </option>
                                </select>
                     

 @if ($errors->has('house_service'))
  <span class="help-block">
  <strong>{{ $errors->first('house_service') }}</strong>
  </span>
 @endif 
               
            </div>

                    <div class="colcol-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('house_price') ? ' has-error' : '' }}">
                <label for="house_price" >{{trans("bookings.label_service_custom_price_per_week")}}</label>
                      <input type="number"  name="house_price" id="house_price" class="form-control"
                      data-ng-disabled="!house_service.length" min="0" placeholder="0" value="{{$house?$house->week_price:0}}">
                   
                      <div>
  <span class="help-block">
  <strong>{{ trans('bookings.msg_custom_price') }}</strong>
  </span> 
  </div>
  <div>

 @if ($errors->has('house_price'))
  <span class="help-block">
  <strong>{{ $errors->first('house_price') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>

                               <div class="colcol-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('house_weeks') ? ' has-error' : '' }}">
                <label for="house_weeks" >{{trans("bookings.label_num_weeks")}}</label>
                      <input type="number"  name="house_weeks" id="house_weeks"  class="form-control"
                      data-ng-disabled="!house_service.length" min="1" placeholder="1" value="{{$house? $house->num_weeks:0}}">
             
  <div>

 @if ($errors->has('house_weeks'))
  <span class="help-block">
  <strong>{{ $errors->first('house_weeks') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>

          </div>


           <div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('transport_service') ? ' has-error' : '' }}">
                <label for="transport_service" >{{trans("bookings.label_transport_service")}}</label>
               
                      <select name="transport_service" id="transport_servicetransport_service" data-ng-model="transport_service" class="form-control"
                                        data-ng-init="transport_service='{{old('transport_service',$transport? $transport->service_id:'')}}'"
                                        data-ng-disabled="!transportServicesList.length">
                         <option value="">{{trans("bookings.input_no")}}</option>
                         <option value="<%transportServicesList[0].id%>" 
                         >{{trans("bookings.input_yes")}}
                         </option>
                      </select>

 @if ($errors->has('transport_service'))
  <span class="help-block">
  <strong>{{ $errors->first('transport_service') }}</strong>
  </span>
 @endif 
                
            </div>

              <div class="col-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('transport_price') ? ' has-error' : '' }}">
                <label for="transport_service" >{{trans("bookings.label_service_custom_price")}}</label>
                      <input type="number"  name="transport_price" id="transport_price"  class="form-control"
                      data-ng-disabled="!transport_service.length" min="0" placeholder="0" value="{{$transport?$transport->total_price:0}}"> 
                      <div>
  <span class="help-block">
  <strong>{{ trans('bookings.msg_custom_price') }}</strong>
  </span> 
  </div>
  <div>

 @if ($errors->has('transport_price'))
  <span class="help-block">
  <strong>{{ $errors->first('transport_price') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>

          </div>

<div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('insurance_service') ? ' has-error' : '' }}">
                <label for="insurance_service" >{{trans("bookings.label_insurance_service")}}</label>
               



                      <select name="insurance_service" id="insurance_service" data-ng-model="insurance_service" class="form-control"
                      data-ng-disabled="!coursesList.length"
                      data-ng-init="insurance_service='{{old('insurance_service',$insurance?$insurance->service_id:'')}}'">
                       <option value="">{{trans("bookings.input_no")}}</option>
                         <option value="<%insuranceServicesList[0].id%>"> {{trans("bookings.input_yes")}}
                         </option>
                      </select>

 @if ($errors->has('insurance_service'))
  <span class="help-block">
  <strong>{{ $errors->first('insurance_service') }}</strong>
  </span>
 @endif 
                
            </div>

            <div class="col-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('insurance_price') ? ' has-error' : '' }}">
                <label for="insurance_price" >{{trans("bookings.label_service_custom_price")}}</label>
                      <input type="number"  name="insurance_price" id="insurance_price"  class="form-control"
                      data-ng-disabled="!insurance_service.length" value="{{$insurance?$insurance->total_price:0}}">
                      <div>
  <span class="help-block">
  <strong>{{ trans('bookings.msg_custom_price') }}</strong>
  </span> 
  </div>
  <div>

 @if ($errors->has('insurance_price'))
  <span class="help-block">
  <strong>{{ $errors->first('insurance_price') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>

          </div>

        </div>
        <!-- books -->          
<div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('books_service') ? ' has-error' : '' }}">
                <label for="books_service">{{trans("bookings.label_books_service")}}</label>
               
                      <select name="books_service" id="books_service" data-ng-model="books_service" class="form-control"
                                        data-ng-init="books_service='{{old('books_service',$books?$books->service_id:'')}}'"
                                        data-ng-disabled="!booksServicesList.length">
                         <option value="">{{trans("bookings.input_no")}}</option>
                         <option value="<%booksServicesList[0].id%>"> {{trans("bookings.input_yes")}}
                         </option>
                      </select>

 @if ($errors->has('books_service'))
  <span class="help-block">
  <strong>{{ $errors->first('books_service') }}</strong>
  </span>
 @endif 
               
            </div>

            <div class="col-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('books_price') ? ' has-error' : '' }}">
                <label for="books_price" >{{trans("bookings.label_service_custom_price")}}</label>
                      <input type="number" name="books_price" id="books_price"  class="form-control"
                      data-ng-disabled="!books_service.length"
                      value="{{$books?$books->total_price:0}}">
                      <div>
  <span class="help-block">
  <strong>{{ trans('bookings.msg_custom_price') }}</strong>
  </span> 
  </div>
  <div>

 @if ($errors->has('books_price'))
  <span class="help-block">
  <strong>{{ $errors->first('books_price') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>

          </div>

        


        <!-- Advisors -->          
<div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('advisor_service') ? ' has-error' : '' }}">
                <label for="advisor_service">{{trans("bookings.label_advisor_service")}}</label>
               
                      <select name="advisor_service" id="advisor_service" data-ng-model="advisor_service" class="form-control"
                                        data-ng-init="advisor_service='{{old('advisor_service',$advisor_service?$advisor_service->service_id:'')}}'"
                                        data-ng-disabled="!advisorServicesList.length">
                         <option value="">{{trans("bookings.input_no")}}</option>
                         <option value="<%advisorServicesList[0].id%>"> {{trans("bookings.input_yes")}}
                         </option>
                      </select>

 @if ($errors->has('advisor_service'))
  <span class="help-block">
  <strong>{{ $errors->first('advisor_service') }}</strong>
  </span>
 @endif 
               
            </div>
        

        <div class="col-md-2 col-sm-2 margin-bottom-15 {{ $errors->has('advisor_price') ? ' has-error' : '' }}">
                <label for="advisor_price" >{{trans("bookings.label_service_custom_price")}}</label>
                      <input type="number" name="advisor_price" id="advisor_price"  class="form-control"
                      data-ng-disabled="!advisor_service.length"
                      >
                      <div>
  <span class="help-block">
  <strong>{{ trans('bookings.msg_custom_price') }}</strong>
  </span> 
  </div>
  <div>

 @if ($errors->has('advisor_price'))
  <span class="help-block">
  <strong>{{ $errors->first('advisor_price') }}</strong>
  </span>
 @endif 
 </div> 
                
            </div>
                                </div>
        <hr>
        <div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('advisor') ? ' has-error' : '' }}">
                                      <label for="houseID">{{trans("bookings.label_advisor")}} <span
                                                  style="color:#F00;">*</span></label>
                                      <select class="form-control select2" id="advisor"
                                              name="advisor">
                                          <option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option>

                                             @foreach(\Corsata\User::getAdvisors()->get() as $advisor)     
                                          <option value="{{$advisor->id}}" {{old('advisor',$booking->advisor_id)==$advisor->id?"selected":""}}>
                                            {{$advisor->name}}
                                          </option>
                                          @endforeach
                                         
                                      </select>
                                      @if ($errors->has('advisor'))
  <span class="help-block">
  <strong>{{ $errors->first('advisor') }}</strong>
  </span>
 @endif    

                                  </div>
                                </div>

<div class="row nomargin-bottom">
<div class="col-md-6 col-sm-6 margin-bottom-15 {{ $errors->has('housing') ? ' has-error' : '' }}">
                                      <label for="houseID">{{trans("bookings.label_house_booked")}} <span
                                                  style="color:#F00;">*</span></label>
                                      <select class="form-control select2" id="house"
                                              name="housing">
                                          <option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option>

                                             @foreach(\Corsata\BookedHousing::all() as $house)     
                                          <option value="{{$house->id}}" {{old('house', $booking->house_id)==$house->id?"selected":""}}>
                                            {{$house->name}}
                                          </option>
                                          @endforeach
                                         
                                      </select>
                                      @if ($errors->has('housing'))
  <span class="help-block">
  <strong>{{ $errors->first('housing') }}</strong>
  </span>
 @endif    

                                  </div>
                                </div>

<hr>

                    
                  <div class="form-group">
                <label for="" class="control-label col-md-3">{{trans("bookings.label_booking_status")}}</label>
                <div class="col-md-5">
                    <div class="col-md-3"><span
                                class="label label-{{trans_choice("bookings.status_options_color",$booking->status)}}">{!! trans_choice("bookings.status_options",$booking->status) !!}</span>
                    </div>
                    <div class="col-md-5">
                        <select name="status" id="status" class="form-control ">
                            <option value="1" {{old("status",$booking->status)==1?"selected":""}}>{{trans_choice("bookings.status_options",1)}}</option>
                            <option value="2" {{old("status",$booking->status)==2?"selected":""}}>{{trans_choice("bookings.status_options",2)}}</option>
                            <option value="3" {{old("status",$booking->status)==3?"selected":""}}>{{trans_choice("bookings.status_options",3)}}</option>
                            <option value="4" {{old("status",$booking->status)==4?"selected":""}}>{{trans_choice("bookings.status_options",4)}}</option>

                        </select>
                    </div>


                </div>
            </div>

                    <div class="form-group {{$errors->has("send_email")?"has-error":''}}">
                        <label for="send_email" class="label-control col-md-3">
                            {{trans("bookings.label_send_email")}}
                        </label>
                        <div class="col-md-9">
                            <input type="checkbox" name="send_email" id="send_email" class="toggle-checkbox"
                                   placeholder=""
                                   value="1" {{!old("send_email")?:"checked"}}>
                        
                        <div>
                        <span class="help-block">
                                            <strong>{{trans("bookings.hint_send_email")}}</strong>
                                        </span>
                                        </div>
                        @if ($errors->has('send_email'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('send_email') }}</strong>
                                        </span>
                        @endif
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4">
            
              <div class="panel panel-primary">
                <div class="panel-heading text-center">{{trans("bookings.label_media")}}</div>
                <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("media")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
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
                               ngf-max-size="100MB"
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
                               @if($booking->media()->count())
                                    @foreach($booking->media as $file)
                                        <div class="thumbnail col-sm-6 col-md-6 col-lg-6" id="file-{{$file->name}}" data-ng-if="!file">
                                            <img src="/images/file_default.png" height="70" width="70" 
                                             class="">
                                            <a href="javascript:;" class="btn btn-danger"
                                               ng-click="removeByName('{{$file->name}}')">{{trans("main.btn_delete")}}</a>
                                        </div>
                                    @endforeach
                                @endif

                                <div ng-repeat="f in files">
                                    <div class="thumbnail col-sm-6 col-md-6 col-lg-6">
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
        </div>

        <div class="form-group margin-none">
            <div class="col-sm-offset-3 col-sm-9">
                <button href="categories.html" type="submit"
                        class="btn btn-primary">{{trans("main.btn_create")}}</button>
            </div>
        </div>

    {!! Form::close() !!}

    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection

@section("javascript")
    <script>
        $(".datepicker").datepicker({dateFormat: 'dd-mm-yy'});
        
    </script>


@stop
