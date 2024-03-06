
 	<div>
 {!! Form::open(['url'=>route('block.update',['id'=>$block->page_id, 'block_id'=>$block->id]), 'id'=>'form_edit_block','method'=>'put']) !!}

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

                                     <option value="hotels">الفنادق</option>
                                        <option value="places">الأماكن السياحية</option>
                                        <option value="packages">العروض السياحية</option>
                                        <option value="packagesType">انواع العروض السياحية</option>
                                       
                                        <option value="articles">المقالات</option>
                                 

                                    </select>
  </div>
</div>
                       
                        </div>


          <div class="row" data-ng-hide="dataType =='countries'  || dataType =='cities' || dataType =='country_items' || dataType =='city_items'">
       <div class="col-md-6">
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
                            <div class="col-md-6" data-ng-hide="dataType =='articles'">
                                <label>المدينة</label>
                                <select class="form-control" name="city"
                                        data-ng-model="city"
                                        data-ng-init="city='{{!empty($block->city_id)?$block->city_id:''}}'"
                    data-ng-disabled="!citiesList.length || dataType=='packages' || dataType =='articles'"  style="width: 100%">
                    <option class="no-select2"></option>
                                    <option value="" disabled>اختر المدينة</option>
                                    <option data-ng-repeat="city in citiesList" value="<%city.id%>"
                                      data-ng-selected="city.id =='{{!empty($block->city_id)?$block->city_id:''}}'"> <%city.name%>
                                    </option>
                                </select>
                            </div>

                               <div class="col-md-6" data-ng-show="dataType =='articles'">
                                <label>التصنيفات</label>
                                <select class="form-control" name="category"
                                        data-ng-model="category"
                                        data-ng-init="category='{{!empty($block->category_id)?$block->category_id:''}}'"
                    data-ng-disabled="!categoriesList.length || dataType !=='articles'" style="width: 100%">
                    <option class="no-select2"></option>
                                    <option value="">اختر التصنيف</option>
                                    <option data-ng-repeat="cat in categoriesList" value="<%cat.id%>"
                                            > <%cat.name%>
                                    </option>
                                </select>
                            </div>



                          </div>

<div class="row" data-ng-hide="dataType =='countries' || dataType =='cities' || dataType =='country_items' || dataType =='city_items'">
       <div class="col-md-2" >
                         <div class="form-group">
                                    <label>بالموضوع ؟</label>
                                    <select class="form-control" name="by_ids"
                                            data-ng-model="by_ids"
                                            data-ng-init="by_ids='{{!empty($content->by_ids)?$content->by_ids:''}}'" style="width: 100%"
                                            data-ng-disabled="!topicsList.length">

                                        <option value="0">لا</option>
                                        <option value="1">نعم</option>

                                    </select>
                                </div>
                            </div>
                            @php

                                            $topics_list=[];
                                            if(!empty($content->topics)){

                                                foreach ($content->topics as $topic)
                                                    {
                                                        $topics_list[]=$topic;
                                                    }

                                                    }

                                        @endphp
                            <div class="col-md-10">
                                <label>الموضوع</label>
                                <select class="form-control select2" name="topics[]" id="topicId"
                                        data-ng-model="topics"
                                        
                    data-ng-disabled="!topicsList.length || by_ids=='0'" style="width: 100%" multiple="multiple">
                    <option class="no-select2" data-ng-init="topics='{{!empty($content->topics)?json_encode($content->topics):''}}'"></option>
                                    <option value="" disabled>اختر الموضوع</option>
                                    <option data-ng-repeat="topic in topicsList" value="<%topic.id%>"
                                            data-ng-selected="topics.includes(topic.id)"> <%topic.name%>
                                    </option>
                                </select>
                            </div>


                          </div>


                                  <div class="row" data-ng-hide="dataType =='countries' || dataType =='cities' || dataType =='country_items' || dataType =='city_items'">
<div class="col-md-4">
 <div class="form-group">
                                    <label>مستوى الفندق</label>
                                    <small style="font-size: 10px;">(للفنادق)</small>
                         <select class="form-control" name="order_stars" id="order_stars" data-ng-disabled="dataType!='hotels'" data-ng-model="order_stars" data-ng-init="order_stars='{{!empty($content->order_stars)?$content->order_stars:''}}'">
                                       <option class="no-select2"></option>
                                        <option value="1">1 star</option>
                                        <option value="2">2 star</option>
                                        <option value="3">3 star</option>
                                        <option value="4">4 star</option>
                                        <option value="5">5 star</option>
                                       

                                    </select>
  </div>
</div>
<div class="col-md-4">
 <div class="form-group">
                                    <label>اظهر فقط النص</label>
                                    <small style="font-size: 10px;">(للفنادق)</small>
                         <select class="form-control" name="only_text" id="only_text"  data-ng-model="only_text" data-ng-init="only_text='{{!empty($content->only_text)?$content->only_text:''}}'">
                                       <option class="no-select2"></option>
                                        <option value="0">لا</option>
                                        <option value="1">نعم</option>
                                        
                                       

                                    </select>
  </div>
</div>
 <div class="col-md-4">
  <div class="form-group">
  
   
          <input type="checkbox" name="order_comment" id="order_comment" value="1"  data-ng-model="order_comment"
                                        data-ng-checked="order_comment='{{!empty($content->order_comment)?$content->order_comment:''}}'">الاكثر تعليقات
                            </div>
                          </div>
    <div class="col-md-4">
  <div class="form-group clearfix"  id="">
  
                  <input type="checkbox" name="order_review" id="order_review" value="1"  data-ng-model="order_review"
                                        data-ng-checked="order_review='{{!empty($content->order_review)?$content->order_review:''}}'">  الاكثر تقييم



                            </div>
                          </div>
                        </div>



<div class="row" data-ng-hide="dataType =='countries' || dataType =='cities' || dataType =='country_items' || dataType =='city_items'">
  <div class="col-md-4">
 <div class="form-group">
                                    
              <input type="checkbox" name="most_visit" id="heigh_visit" value="1" data-ng-model="most_visit"
                                        data-ng-checked="most_visit='{{!empty($content->most_visit)?$content->most_visit:''}}'"> الاكثر زيارة
  </div>
</div>

<div class="col-md-4">
 <div class="form-group">
                                    
              <input type="checkbox" name="last_visit" id="last_visit" value="1" data-ng-model="last_visit"
                                        data-ng-checked="most_visit='{{!empty($content->last_visit)?$content->last_visit:''}}'"> آخر الزيارات
  </div>
</div>
<div class="col-md-4">
 <div class="form-group">
                                    
              <input type="checkbox" name="visit_now" id="visit_now" value="1" data-ng-model="visit_now"
                                        data-ng-checked="most_visit='{{!empty($content->visit_now)?$content->visit_now:''}}'"> يتم زيارته حاليا
  </div>
</div>

</div>

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





