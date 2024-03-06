
    <section class="content">
         @include('include.message')
        <div class="row">
            <div class="col-md-12">
               {!! Form::open(['route'=>['categories.update', $data->id],'method'=>'put']) !!}
               
                    <div class="box box-success"  >
                      <div class="box-header with-border">
              <h3 class="box-title"> <i class="fa fa-list-ul"></i> تعديل بيانات المنتج</h3>
            </div>
                        <div class="box-body">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>اسم المنتج <i class="required">*</i></label>
                                    <input type="text" name="name" class="form-control" autocomplete="off"
                                           placeholder="اسم المنتج">
                                </div>
                                <!-- <div class="col-md-4">
                                    <label>العدد </label>
                                    <input type="number" name="available_num" class="form-control" autocomplete="off"
                                           placeholder="الكميه الموجودة">
                                </div> -->

                              <!--   <div class="col-md-4">
                                    <label>السعر </label>
                                    <input type="number" name="price" class="form-control" autocomplete="off"
                                           placeholder="سعر المنتج">
                                </div> -->

                                <div class="col-md-4"  id="par_cat">
                                    <label>نوع التصنيف<i class="required">*</i></label>
                                    <select class="form-control select2" style="border:1px solid #aaa;" name="category_id">
                                        <option value="">--أختر--</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>حاله المنتج<i class="required">*</i></label>
                                    <select class="form-control" style="border:1px solid #aaa;" name="status">
                                        
                                        <option value="1" selected>مفعل</option>
                                        <option value="0">غير مفعل</option>
                                    </select>
                                </div>
                              
                            </div>

                        </div>
                                                    <div class="box-footer">
                <button type="submit" class="btn btn-success my_btn_left"><i class="fa fa-edit"></i> تعديل المنتج </button>
              </div>

                    </div>

                {!! Form::close() !!}
              </div>
            </div>
          </section>
      