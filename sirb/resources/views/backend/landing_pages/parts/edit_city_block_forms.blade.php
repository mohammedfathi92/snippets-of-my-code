
  <div>
 {!! Form::open(['url'=>route('block.update',['id'=>$block->page_id, 'block_id'=>$block->id]), 'id'=>'form_edit_city_block','method'=>'put']) !!}

    <input type="hidden" name="is_dynamic" value="1">
    <input type="hidden" name="block_type" value="dynamic">
          <div class="row">
              <div class="col-md-6 col-sm-6">
  <div class="form-group clearfix"  id="">
  <label>Data Amount</label>
    <input class="form-control" type="number" id="data_amount" name="data_amount" min="4" value="{{old('data_amount', $block->amount)}}">

                            </div>
                          </div>
                             <div class="col-md-6 col-sm-6">
  <div class="form-group clearfix"  id="">
  <label>Read more url</label>
    <input class="form-control" type="url" id="read_more_url" name="read_more_url" value="{{old('read_more_url', !empty($content->read_more_url)?$content->read_more_url:'')}}">

                            </div>
                          </div>
                          {{--  <div class="col-md-3 col-sm-3">
  <div class="form-group clearfix"  id="">
  <label>Read more btn</label>
<input class="form-control" type="color" id="btnColor" name="btn_color" value="#1574d4">

                            </div>
                          </div>

   <div class="col-md-3 col-sm-3">
  <div class="form-group clearfix"  id="">
  <label>Block bg</label>
    <input class="form-control" type="color" id="bgColor" name="bg_color" value="#14e06e">

                            </div>
                          </div> --}}
          
                        </div>
 <div class="row">
  <div class="col-md-6">
 <div class="form-group">
  <label>Block order</label>
 <input type="number" class="form-control" name="order" min="1" value="{{old('name', $block->order)}}"> 
    
             
  </div>
</div>
<div class="col-md-6">
 <div class="form-group">

  @php
  $data_type = "";
  if(!empty($content->data_type)){
  $data_type = $content->data_type;
  }

  $place_topic = "";
  if(!empty($content->place_topic)){
  $place_topic = $content->place_topic;
  }

  @endphp
  
                                    <label>قسم المواضيع</label>
                         <select class="form-control" name="data_type" data-ng-model="dataType" data-ng-init="dataType='{{$data_type}}'" style="width: 100%" >
                          <option class="no-select2"></option>
                                        <option value="countries">الواجهات السياحية</option>
                                        <option value="cities">المدن</option>
<!--                                         <option value="country_items">country items</option>
 -->                                        <option value="city_items">مواضيع المدينة</option>

                                    </select>
  </div>
</div>
                       
                        </div>

                              <div class="row">
                          <div class="col-md-6" data-ng-hide="dataType =='cities'">
 <div class="form-group">
  
                                    <label>تصنيف البيانات</label>
                         <select class="form-control" name="place_topic" data-ng-model="placeTopic" data-ng-init="placeTopic='{{$place_topic}}'" style="width: 100%" >
                          <option class="no-select2"></option>
<option value="hotels">الفنادق</option>
                                        <option value="places">الاماكن السياحية</option>
                                        <option value="packages" data-ng-hide="dataType =='city_items'">العروض السياحية</option>
                                        
                                        
                                       

                                    </select>
                                    </div>
                                  </div>
        <div class="col-md-6" >
                         <div class="form-group" >
                                    <label>الدولة</label>
                                    <select class="form-control" name="country" id="countryId"
                                            data-ng-model="country"
                                            data-ng-init="country='{{!empty($block->country_id)?$block->country_id:''}}'" style="width: 100%">
                                        <option value="" disabled>اختر الدولة</option>
                                        <option data-ng-repeat="item in countriesList" value="<%item.id%>"
                                                >
                                            <%item.name%>
                                        </option>

                                    </select>
                                </div>
                            </div>                               


                        </div>
<!--start cities ids -->
                        <div class="row" data-ng-show="dataType =='cities' || dataType =='city_items'">
       <div class="col-md-2" >
                         <div class="form-group">
                                    <label>طبقا للمدينة</label>
                                    <select class="form-control" name="by_cities_ids"
                                            data-ng-model="by_cities_ids"
                                            data-ng-init="by_cities_ids='{{!empty($content->by_cities_ids)?$content->by_cities_ids:''}}'" style="width: 100%"
                                            data-ng-disabled="!citiesList.length">

                                        <option value="0">لا</option>
                                        <option value="1">نعم</option>

                                    </select>
                                </div>
                            </div>
                            @php

                                            $citiesIdsList=[];
                                            if(!empty($content->citiesIds)){

                                                foreach ($content->citiesIds as $city)
                                                    {
                                                        $citiesIdsList[]=$city;
                                                    }

                                                    }

                                        @endphp
                            <div class="col-md-10">
                                <label>المدينة</label>
                                <select class="form-control select2" name="citiesIds[]" id="cityId"
                                        data-ng-model="citiesIds"
                                        
                    data-ng-disabled="!citiesList.length || by_cities_ids=='0'" style="width: 100%" multiple="multiple">
                    <option class="no-select2" data-ng-init="citiesIds='{{!empty($content->citiesIds)?json_encode($content->citiesIds):''}}'"></option>
                                    <option value="" disabled>اختر المدينة</option>
                                    <option data-ng-repeat="city in citiesList" value="<%city.id%>"
                                            data-ng-selected="citiesList.includes(city.id)"> <%city.name%>
                                    </option>
                                </select>
                            </div>


                          </div>
                    <!-- end cities -->


<div class="row">
  <div class="col-md-12">
 <div class="form-group">
                            <label>عنوان البلوك</label>        
              <input type="text" name="title" id="title" class="form-control" value="{{old('title', !empty($content->title)?$content->title:'')}}">
  </div>
</div>

<div class="col-md-12">
 <div class="form-group">
  <label>وصف البلوك</label> 

  <textarea class="form-control" name="description" placeholder="Write What you want here">
    {{old('description', !empty($content->description)?$content->description:'')}}
  </textarea>
             
  </div>
</div>




</div>

    
    <hr>
    <div class="row">
      <center>
    <button type="submit" class="btn product-btn blog-btn blog2-btn" style="margin: 0px;">تعديل</button>
    </center>
    </div>
    {!! Form::close() !!}

</div>





