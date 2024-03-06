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
        <i class="fa fa-h-square"></i> {{trans("packages.backend_page_create_header")}} </h1>
@stop
@section("content")
    <div class="page-content container-fluid" data-ng-controller="createUpdatePackagesCtrl">
        @if($errors->count())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['class'=>'form-horizontal','id'=>"packageFormData",'name'=>'form','novalidate']) !!}
        <div class="container">

            <div class="panel panel-primary">
                <div class="panel-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-pills" role="tablist">
                        <li role="presentation" class="active">
                            <a
                                    href="#tab-general"
                                    aria-controls="tab-general" role="tab"
                                    data-toggle="tab">{{trans('main.tab_general')}}</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab-details"
                               aria-controls="tab-details" role="tab"
                               data-toggle="tab">{{trans('main.tab_details')}}</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab-photos"
                               aria-controls="tab-photos" role="tab"
                               data-toggle="tab">{{trans('main.tab_photos')}}</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab-general">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-solid" role="tablist">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                    <li role="presentation" class="{{$loop->index==0?"active":""}}"><a
                                                href="#lang-{{$localeCode}}"
                                                aria-controls="lang-{{$localeCode}}" role="tab"
                                                data-toggle="tab">{{ $properties['native']}}</a>
                                    </li>

                                @endforeach
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div role="tabpanel" class="tab-pane {{$loop->index==0?"active":""}}"
                                         id="lang-{{$localeCode}}">
                                        <div class="form-group {{!$errors->has("name.$localeCode")?:"has-error"}} ">
                                            <label for="name"
                                                   class="col-sm-3 control-label">{{trans("packages.label_name")}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name[{{$localeCode}}]" class="form-control"
                                                       id="name"
                                                       placeholder="" value="{{old("name.$localeCode")}}">
                                                @if ($errors->has("name.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("name.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("description.$localeCode")?:"has-error"}}">
                                            <label for="description"
                                                   class=" control-label">{{trans("packages.label_description")}}
                                            </label>
                                            <div class="">
                                            <textarea type="text" name="description[{{$localeCode}}]"
                                                      cols="50" rows="10" class="form-control ckeditor"
                                                      id="description" placeholder=""
                                            >{{old("description.$localeCode")}}</textarea>
                                                @if ($errors->has("description.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("description.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("notes.$localeCode")?:"has-error"}}">
                                            <label for="notes"
                                                   class=" control-label">{{trans("packages.label_notes")}}
                                            </label>
                                            <div class="">
                                            <textarea type="text" name="notes[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control ckeditor"
                                                      id="notes" placeholder=""
                                            >{{old("notes.$localeCode")}}</textarea>
                                                @if ($errors->has("notes.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("notes.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("meta_keywords.$localeCode")?:"has-error"}}">
                                            <label for="meta_keywords"
                                                   class="col-sm-3 control-label">{{trans("packages.label_meta_keywords")}}
                                            </label>
                                            <div class="col-sm-9">
                                            <textarea type="text" name="meta_keywords[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
                                                      id="meta_keywords" placeholder=""
                                            >{{old("meta_keywords.$localeCode")}}</textarea>
                                                @if ($errors->has("meta_keywords.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("meta_keywords.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{!$errors->has("meta_description.$localeCode")?:"has-error"}}">
                                            <label for="meta_description"
                                                   class="col-sm-3 control-label">{{trans("packages.label_meta_description")}}
                                            </label>
                                            <div class="col-sm-9">
                                            <textarea type="text" name="meta_description[{{$localeCode}}]"
                                                      cols="50" rows="5" class="form-control"
                                                      id="meta_description" placeholder=""
                                            >{{old("meta_description.$localeCode")}}</textarea>
                                                @if ($errors->has("meta_description.$localeCode"))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first("meta_description.$localeCode") }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="form-group {{$errors->has("type")?"has-error":''}}">
                                <label for="type"
                                       class="control-label col-sm-3">{{trans("packages.label_type")}}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-3">
                                    <select name="type" id="type" class="form-control select2">
                                        @foreach(\App\PackageType::all() as $type)
                                            <option value="{{$type->id}}" {{old("type")==$type->id?"selected":""}}>{{$type->name}}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has("stars")?"has-error":''}}">
                                <label for="stars"
                                       class="control-label col-sm-3">{{trans("packages.label_stars")}}

                                </label>

                                <div class="col-sm-3">
                                    <select name="stars" id="stars" class="form-control select2">
                                        <option value="1" {{old("stars")==1?"selected":""}}>{{trans_choice("packages.package_stars_option",1)}}</option>
                                        <option value="2" {{old("stars")==2?"selected":""}}>{{trans_choice("packages.package_stars_option",2)}}</option>
                                        <option value="3" {{old("stars")==3?"selected":""}}>{{trans_choice("packages.package_stars_option",3)}}</option>
                                        <option value="4" {{old("stars")==4?"selected":""}}>{{trans_choice("packages.package_stars_option",4)}}</option>
                                        <option value="5" {{old("stars")==5?"selected":""}}>{{trans_choice("packages.package_stars_option",5)}}</option>
                                    </select>
                                    @if ($errors->has('stars'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stars') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has("people_count")?"has-error":''}}">
                                <label for="people_count"
                                       class="control-label col-sm-3">{{trans("packages.label_people_count")}}

                                </label>

                                <div class="col-sm-3">
                                    <input type="number" name="people_count" min="1" value="{{old("people_count")}}"
                                           class="form-control">
                                    @if ($errors->has('people_count'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('people_count') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr>
                            <div class="form-group {{$errors->has("price")?"has-error":''}}">
                                <label for="price"
                                       class="control-label col-sm-3">{{trans("hotels.label_price")}}

                                </label>

                                <div class="col-sm-3">
                                    <input type="number" name="price" class="form-control" id="price"
                                           placeholder="" value="{{old("price")}}">
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has("offer_price")?"has-error":''}}">
                                <label for="price" class="control-label col-sm-3">
                                    {{trans("hotels.label_offer_price")}}
                                </label>

                                <div class="col-sm-3">
                                    <input type="number" name="offer_price" class="form-control" id="offer_price"
                                           placeholder="" value="{{old("offer_price")}}">
                                    @if ($errors->has('offer_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('offer_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{$errors->has("season_price")?"has-error":''}}">
                                <label for="season_price"
                                       class="control-label col-sm-3">
                                    {{trans("hotels.label_season_price")}}

                                </label>

                                <div class="col-sm-3">
                                    <input type="number" name="season_price" class="form-control" id="season_price"
                                           placeholder="" value="{{old("season_price")}}">
                                    @if ($errors->has('season_price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('season_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-group {{$errors->has("embed_video")?"has-error":''}}">
                                <label for="embed_video"
                                       class="control-label col-sm-3">{{trans("countries.label_embed_video")}}

                                </label>

                                <div class="col-sm-9">
                                <textarea name="embed_video" class="form-control" id="embed_video" cols="50" rows="5"
                                          placeholder="">{{old("embed_video")}} </textarea>
                                    @if ($errors->has('embed_video'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('embed_video') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-group {{$errors->has("in_home")?"has-error":''}}">
                                <label for="in_home" class="label-control col-md-3">
                                    {{trans("packages.label_in_home")}}
                                </label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="in_home" id="in_home" class="toggle-checkbox"
                                           placeholder=""
                                           value="1" {{!old("in_home")?:"checked"}}>
                                </div>
                                @if ($errors->has('in_home'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('in_home') }}</strong>
                                        </span>
                                @endif

                            </div>
                            <div class="form-group {{$errors->has("in_country")?"has-error":''}}">
                                <label for="in_home" class="label-control col-md-3">
                                    {{trans("packages.label_in_country")}}
                                </label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="in_home" id="in_home" class="toggle-checkbox"
                                           placeholder=""
                                           value="1" {{!old("in_home")?:"checked"}}>
                                </div>
                                @if ($errors->has('in_home'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('in_home') }}</strong>
                                        </span>
                                @endif

                            </div>
                            <div class="form-group {{$errors->has("status")?"has-error":''}}">
                                <label for="in_home" class="label-control col-md-3">
                                    {{trans("packages.label_status")}}
                                </label>
                                <div class="col-md-9">
                                    <input type="checkbox" name="status" id="status" class="toggle-checkbox"
                                           placeholder=""
                                           value="1" {{!old("status",1)?:"checked"}}>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-details">
                            <div class="form-group {{$errors->has("country")?"has-error":''}}">
                                <label for="country"
                                       class="control-label col-sm-3">{{trans("packages.label_country")}}
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="col-sm-9">
                                    <select name="country" id="country" class=" form-control select2"
                                            data-ng-model="$root.country" data-ng-init="$root.country='{{old("country")}}'">
                                        <option value=""></option>
                                        @if($countries)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{old("country")==$country->id?"selected":""}} >{{$country->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--Start Package Rooms--}}
                            <div data-ng-controller="packageHotelsCtrl">
                                <div class="clearfix"></div>

                                {{--Hotels--}}
                                <h3>{{trans('packages.title_package_hotels')}} <span data-ng-show="hotelsLoading" class="btn-group-addon"><i
                                                class="fa fa-spinner fa-pulse fa-fw"></i></span></h3>
                                <fieldset class="group-list  well" id="citiesHotels">
                                    <legend></legend>
                                    <div class="group-list-item ">
                                        <div class="col-md-3">{{trans("packages.label_city")}}</div>
                                        <div class="col-md-3">{{trans("packages.label_hotel")}}</div>
                                        <div class="col-md-3">{{trans("packages.label_room")}}</div>
                                        <div class="col-md-2">{{trans("packages.label_days")}}</div>
                                        <div class="col-md-1">
                                            <button class="btn btn-primary" type="button" data-ng-click="addHotel()"><i
                                                        class="fa fa-plus"></i> {{trans("main.btn_add")}}</button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div class="group-list-item " data-ng-repeat="item in items ">
                                        <div class="col-md-3">
                                            <select name="rooms[city][]" id="city-<%$index%>" data-ng-model="item.city"
                                                    data-ng-change="getCityHotels($index)"
                                                    class="form-control"
                                                    data-ng-disabled="!citiesList.length || !country ">
                                                <option value=""></option>
                                                <option data-ng-repeat="city in citiesList" value="<%city.id%>">
                                                    <%city.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="rooms[hotel][]" id="hotel-<%$index%>"
                                                    data-ng-model="item.hotel"
                                                    data-ng-change="getHotelRooms($index)"
                                                    class="form-control"
                                                    data-ng-disabled="!citiesList.length || !item.hotelsList.length">
                                                <option value=""></option>
                                                <option data-ng-repeat="hotel in item.hotelsList"
                                                        value="<%hotel.id%>"><%hotel.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="rooms[room][]" id="room-<%$index%>" data-ng-model="item.room"
                                                    class="form-control"
                                                    data-ng-disabled="!citiesList.length || !item.hotel || !item.roomsList.length">
                                                <option value=""></option>
                                                <option data-ng-repeat="room in item.roomsList" value="<%room.id%>">
                                                    <%room.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="rooms[days][]" value="1" min="1"
                                                   class="form-control"
                                                   data-ng-model="item.days"
                                                   data-ng-disabled="!citiesList.length || !item.room">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger"
                                                    data-ng-click="removeHotel($index)"><i
                                                        class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </fieldset>

                            </div>
                            {{--End Package Rooms--}}

                            {{--Start Package Transports--}}
                            <div data-ng-controller="packageTransportsCtrl">
                                <h3>{{trans('packages.title_package_transports')}} <span data-ng-show="transportsLoading" class="btn-group-addon"><i
                                                class="fa fa-spinner fa-pulse fa-fw"></i></span></h3>
                                {{--Transports--}}

                                <fieldset class="group-list  well" id="citiesHotels">
                                    <legend></legend>
                                    <div class="group-list-item ">
                                        <div class="col-md-3">{{trans("packages.label_city")}}</div>
                                        <div class="col-md-3">{{trans("packages.label_transport_type")}}</div>
                                        <div class="col-md-5">{{trans("packages.label_transport_name")}}</div>

                                        <div class="col-md-1">
                                            <button class="btn btn-primary" type="button"
                                                    data-ng-click="addTransport()"><i
                                                        class="fa fa-plus"></i> {{trans("main.btn_add")}}</button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div class="group-list-item " data-ng-repeat="item in items ">
                                        <div class="col-md-3">
                                            <select name="transports[city][]" id="city-<%$index%>"
                                                    data-ng-model="item.city"
                                                    data-ng-change="getCityTransportTypes($index)"
                                                    class="form-control"
                                                    data-ng-disabled="!citiesList.length ">
                                                <option value=""></option>
                                                <option data-ng-repeat="city in citiesList" value="<%city.id%>">
                                                    <%city.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="transports[type][]" id="type-<%$index%>"
                                                    data-ng-model="item.type"
                                                    data-ng-change="getTypeTransports($index)"
                                                    class="form-control"
                                                    data-ng-disabled="!citiesList.length">
                                                <option data-ng-repeat="(type,name) in item.typesList"
                                                        value="<%type%>"><%name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="transports[transport][]" id="transport-<%$index%>"
                                                    data-ng-model="item.transport"
                                                    class="form-control"
                                                    data-ng-disabled="!citiesList.length || !item.type || !item.transportsList.length">
                                                <option value=""></option>
                                                <option data-ng-repeat="transport in item.transportsList"
                                                        value="<%transport.id%>">
                                                    <%transport.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger"
                                                    data-ng-click="removeTransport($index)"><i
                                                        class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </fieldset>

                            </div>
                            {{--End Package Transports--}}

                            {{--Start Package Flights--}}
                            <div data-ng-controller="packageFlightsCtrl">
                                <h3>{{trans('packages.title_package_flights')}} <span data-ng-show="flightsLoading" class="btn-group-addon"><i
                                                class="fa fa-spinner fa-pulse fa-fw"></i></span></h3>
                                {{--Transports--}}

                                <fieldset class="group-list  well" id="citiesHotels">
                                    <legend></legend>
                                    <div class="group-list-item ">
                                        <div class="col-md-2">{{trans("packages.label_from_country")}}</div>
                                        <div class="col-md-2">{{trans("packages.label_from_city")}}</div>
                                        <div class="col-md-2">{{trans("packages.label_to_country")}}</div>
                                        <div class="col-md-2">{{trans("packages.label_to_city")}}</div>
                                        <div class="col-md-3">{{trans("packages.label_transport_name")}}</div>

                                        <div class="col-md-1">
                                            <div class="btn-group">

                                                <button class="btn btn-primary" type="button"
                                                        data-ng-click="addFlight()"><i
                                                            class="fa fa-plus"></i> {{trans("main.btn_add")}}</button>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    </div>
                                    <div class="group-list-item " data-ng-repeat="item in items ">
                                        <div class="col-md-2" data-ng-init="getFromCountryCities($index)">
                                            <select name="flights[from_country][]" id="from_country-<%$index%>"
                                                    data-ng-model="item.fromCountry"
                                                    data-ng-change="getFromCountryCities($index)"
                                                    class="form-control">
                                                <option value=""></option>
                                                @if($countries)
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="flights[from_city][]" id="from_city-<% $index %>"
                                                    class="form-control"
                                                    data-ng-model="item.fromCity"
                                                    data-ng-disabled="!item.fromCountry">
                                                <option value=""></option>
                                                <option data-ng-repeat="city in item.fromCitiesList"
                                                        value="<%city.id%>"><%city.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="flights[to_country][]" id="from_country-<%$index%>"
                                                    data-ng-model="item.toCountry"
                                                    data-ng-change="getToCountryCities($index)"
                                                    data-ng-disabled="!item.fromCity"
                                                    class="form-control">
                                                <option value=""></option>
                                                @if($countries)
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="flights[to_city][]" id="to_city-<% $index %>"
                                                    class="form-control"
                                                    data-ng-model="item.toCity"
                                                    data-ng-change="getFlights($index)"
                                                    data-ng-disabled="!item.toCountry">
                                                <option value=""></option>
                                                <option data-ng-repeat="city in item.toCitiesList"
                                                        value="<%city.id%>"><%city.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="flights[flight][]" id="flight-<%$index%>"
                                                    data-ng-model="item.flight"
                                                    class="form-control"
                                                    data-ng-disabled="!item.toCitiesList.length || !item.flightsList.length">
                                                <option value=""></option>
                                                <option data-ng-repeat="flight in item.flightsList"
                                                        value="<%flight.id%>">
                                                    <%flight.name%>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger"
                                                    data-ng-click="removeFlight($index)"><i
                                                        class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </fieldset>

                            </div>
                            {{--End Package Flights--}}

                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-photos">
                            <div class="form-group {{$errors->has("photo")?"has-error":''}}"
                                 data-ng-controller="backendUploaderCtrl"
                                 data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                                 data-resize="200,150"
                                 data-prefix="hotel_"
                            >
                                <label for="photo"
                                       class="col-md-2 control-label">{{trans("packages.label_photo")}}</label>
                                <div class="col-md-10">
                                    <div class="">

                                        <div ng-repeat="f in photos">
                                            <div class="thumbnail">
                                                <img ng-show="form.photo.$valid" ngf-thumbnail="f"
                                                     class=" img-thumbnail">
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
                                    </div>
                                    <div class="clearfix"></div>
                                    <a id="photo"
                                       class="btn btn btn-default"
                                       ngf-select="uploadPhoto($files, $invalidFiles)"
                                       ng-model="photo"
                                       required
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
                            <div class="form-group{{$errors->has("gallery")?"has-error":''}}"
                                 data-ng-controller="backendUploaderCtrl"
                                 data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                                 data-resize="200,150"
                                 data-prefix="gallery_"
                            >
                                <label for="gallery"
                                       class="col-md-2 control-label">{{trans("packages.label_gallery")}}</label>
                                <div class="col-md-10">
                                    <a id="gallery"
                                       class="btn btn-default"
                                       ngf-select="uploadPhoto($files, $invalidFiles)"
                                       ng-model="gallery"
                                       ngf-pattern="'image/*'"
                                       ngf-accept="'image/*'"
                                       ngf-max-size="10MB"
                                       ngf-keep="true"
                                       ngf-multiple="true"
                                    >
                                        <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                                    </a>
                                    @if ($errors->has('gallery'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('gallery') }}</strong>
                            </span>
                                    @endif
                                    <div class="clearfix"></div>
                                    <div class="">

                                        <div ng-repeat="f in photos">
                                            <div class="thumbnail">
                                                <img ng-show="form.gallery.$valid" ngf-thumbnail="f"
                                                     class=" img-thumbnail">
                                                <a href="javascript:;" class="btn btn-danger"
                                                   ng-click="removePhoto($index)"
                                                   ng-show="gallery">{{trans("main.btn_delete")}}</a>
                                                <br>
                                                <i ng-show="f.$error.required">*required</i>
                                                <i ng-show="f.$error.maxSize">File too large
                                                    <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                                <input type="hidden" name="gallery[]" value="<%f.result.file%>"
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
    </div>
@endsection
@section("javascript")
    <script>
        $("#packageFormData").submit(function (e) {
            var photo = $('input[name=photo]').val();
            if (!photo) {
                e.preventDefault();
                toastr.error("Upload Package photo before submit");
                return false;
            } else {
                return true;
            }

        });
    </script>
@stop
