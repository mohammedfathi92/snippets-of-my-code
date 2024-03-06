  <div>
    {!! Form::open(['url'=>route('block.create',['page_id'=>$page->id]), 'id'=>'form_create_block_st'] ) !!}


    <input type="hidden" name="is_dynamic" value="0">

    <div class="col-md-12"> 
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#price-1" aria-controls="price-1" role="tab" data-toggle="tab">اختر الاستايل</a>
        </li>
        <li role="presentation">
          <a href="#price-2" aria-controls="price-2" role="tab" data-toggle="tab">محتوى النصوص</a>
        </li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="row tab-pane active" id="price-1">

          <div class="col-md-12 col-sm-12">
            <div class="row">
              <div class="col-md-6">
@php
$page_order = "";

if($page->blocks()->count()){
 $page_order = $page->blocks()->orderBy('order', 'DESC')->first()->order; 
}

@endphp
 <div class="form-group">
  <label> ترتيب البلوك</label>
 <input type="number" class="form-control" name="order" min="1" value="{{old('order',$page_order?:0 + 1)}}"> 
    
             
  </div>
</div>
<div class="col-md-6">
           <div class="form-group">

            <label>نوع البلوك</label>
            <select class="form-control" name="block_type" data-ng-model="blockType" data-ng-init="blockType='header'" style="width: 100%" >

              <option class="no-select2"></option>

              <option value="header">رأسية الصفحة</option>
              <option value="parallex">سيكشن ثابت</option>
              <option value="banner">بانار اعلاني</option>
              <option value="divider">نص فقط</option>

<!--               <option value="sponsers">sponsers</option>

 -->              <option value="features">خصائص الموقع</option>
                  <option value="reviews">آراء العملاء</option>


            </select>

          </div>
        </div>
        </div>



          <div class="form-group" data-ng-if="blockType=='header'">
            <img src="/builder/image/blocks/header_1.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="header_1" checked></center>
            <hr>
            <img src="/builder/image/blocks/header_2.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="header_2"></center>
          </div>
          <div class="form-group" data-ng-if="blockType =='parallex'">


          
            <img src="/builder/image/blocks/parallex_1.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="parallex_1"></center>
            <hr>
            <img src="/builder/image/blocks/parallex_2.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="parallex_2"></center>

          </div>
          <div class="form-group" data-ng-if="blockType =='banner'">


          
            <img src="/builder/image/blocks/banner_1.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="banner_1"></center>
            <hr>
            {{-- <img src="/builder/image/blocks/parallex_2.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="parallex_2"></center> --}}

          </div>
          <div class="form-group" data-ng-if="blockType =='sponsers'">


            <img src="/builder/image/blocks/sponsers_1.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="sponsers_1" checked></center>


          </div>
          <div class="form-group" data-ng-if="blockType =='features'">


            <img src="/builder/image/blocks/features_1.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="features_1"></center>



          </div>
          <div class="form-group" data-ng-if="blockType =='reviews'">


            <img src="/builder/image/blocks/reviews_1.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="reviews_1"></center>



          </div>
           <div class="form-group" data-ng-if="blockType =='divider'">


            <img src="/builder/image/blocks/divider_1.jpg" alt="" height="170" width="560">
            <center><input type="radio" name="layout" value="divider_1"></center>



          </div>
        </div>
      </div>



      <div role="tabpanel" class="tab-pane tab2" id="price-2">
        <div class="col-md-12" data-ng-if="blockType=='banner'">
             <div class="col-md-12">
            <div class="form-group clearfix"  id="">
              <h4>رابط الصورة</h4>
<input type="url" name="banner_img" placeholder="">              
            </div>
          </div>
             <div class="col-md-12">
            <div class="form-group clearfix"  id="">
              <h4>رابط الاعلان</h4>
 <input type="url" name="banner_url" placeholder="">            </div>
          </div>
          
         

          </div>
        <div class="col-md-12" data-ng-if="blockType=='reviews'">
           
              
              <p>
                لا توجد نصوص لهذا البلوك
              </p>
           
          </div>
        <div data-ng-show="blockType=='parallex' || blockType=='header' || blockType=='features'">
          <div class="col-md-12">
            <div class="form-group clearfix"  id="">
              <h4>العنوان</h4>
              <textarea class="form-control" name="title" ></textarea>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group clearfix"  id="">
              <h4>الوصف</h4>
              <textarea class="form-control"  name="description" ></textarea>
            </div>
          </div>

         

        </div>

        <div data-ng-show="blockType=='divider'">
        
          <div class="col-md-12">
            <div class="form-group clearfix"  id="">
              <h4>العنوان</h4>
              <input type="text" name="divider_title" placeholder="العنوان هنا" class="form-control"> 
              
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group clearfix"  id="">
              <h4>الوصف</h4>
              <textarea class="form-control ckeditor"  name="divider_content" placeholder="النص هنا">
               
              </textarea>
            </div>
          </div>
<div class="row">
           <div class="col-md-6">

            <div class="form-group">

              <label>نص الزر</label>
              <input type="text" name="div_btn_text" placeholder="">
            </div>

          </div>

           <div class="col-md-6">

            <div class="form-group">

              <label>رابط الزر</label>
              <input type="url" name="div_btn_url" placeholder="">
            </div>

          </div>
        </div>

         

        </div>

         <div class="col-md-12" data-ng-show="blockType=='parallex' || blockType=='header'">

            <div class="form-group">

              <label>صورة الخلفية</label>
              <input type="url" name="bg_img">
            </div>

          </div>

         <div data-ng-if="blockType=='parallex'">
          <div class="row">

        <div class="col-md-6">

            <div class="form-group">

              <label>نص الزر</label>
              <input type="text" name="btn_text" placeholder="">
            </div>

          </div>
          <div class="col-md-6">

            <div class="form-group">

              <label>رابط الزر</label>
              <input type="url" name="btn_url" placeholder="">
            </div>

          </div>
        </div>
      </div>

        <div data-ng-if="blockType=='header'">
          <div class="row">
          <div class="col-md-6">

            <div class="form-group">

              <label>نص الزر باليمين</label>
              <input type="text" name="btn_text_1" placeholder="">
            </div>

          </div>


           <div class="col-md-6">

            <div class="form-group">

              <label>رابط الزر باليمين</label>
              <input type="url" name="btn_url_1" placeholder="">
            </div>

          </div>
          </div>
           <div class="row">
          <div class="col-md-6">

            <div class="form-group">

              <label>نص الزر باليسار</label>
              <input type="text" name="btn_text_2" placeholder="">
            </div>

          </div>


           <div class="col-md-6">

            <div class="form-group">

              <label>رابط الزر باليسار</label>
              <input type="url" name="btn_url_2" placeholder="">
            </div>

          </div>
          </div>


      
        </div>





        <div data-ng-show="blockType=='features'">

<div class="row">
           <div class="col-md-9">
 <div class="form-group">
                            <label>عنوان 1</label>        
              <input type="text" name="title_1" id="title" class="form-control">
  </div>
</div>

 <div class="col-md-3">
 <div class="form-group">
                            <label>ايقونة 1</label>        
              <input type="text" name="icon_1" id="title" class="form-control icon-picker">
  </div>
</div>
</div>
          

            <div class="col-md-12">
              <div class="form-group clearfix"  id="">
                <h4>نص 1</h4>
                <textarea class="form-control"  name="content_1" ></textarea>
              </div>
            </div>

            


<div class="row">
           <div class="col-md-9">
 <div class="form-group">
                            <label>العنوان 2</label>        
              <input type="text" name="title_2" id="title" class="form-control">
  </div>
</div>

 <div class="col-md-3">
 <div class="form-group">
                            <label>الايقونة 2</label>        
              <input type="text" name="icon_2" id="title" class="form-control icon-picker">
  </div>
</div>
</div>


            <div class="col-md-12">
              <div class="form-group clearfix"  id="" >
                <h4>نص 2</h4>
                <textarea class="form-control"  name="content_2" ></textarea>
              </div>
            </div>

            <div class="row">
           <div class="col-md-9">
 <div class="form-group">
                            <label>العنوان 3</label>        
              <input type="text" name="title_3" id="title" class="form-control">
  </div>
</div>

 <div class="col-md-3">
 <div class="form-group">
                            <label>الايقونة 3</label>        
              <input type="text" name="icon_3" id="title" class="form-control icon-picker">
  </div>
</div>
</div>

            <div class="col-md-12">
              <div class="form-group clearfix"  id="">
                <h4>نص 3</h4>
                <textarea class="form-control"  name="content_3"></textarea>
              </div>
            </div>
          
           
          </div>


        </div>



       

       
      </div>
    </div> 
  
  <hr>
  <div class="row">
   <center>
    <button type="submit" class="btn product-btn blog-btn blog2-btn" style="margin: 0px;">انشاء</button>
  </center>
</div>
{!! Form::close() !!}
</div>







