
    <section class="content">
         @include('include.message')
        <div class="row">
            <div class="col-md-12">
               {!! Form::open(['route'=>['categories.update', $data->id],'method'=>'put']) !!}
               
                    <div class="box box-success"  >
                      <div class="box-header with-border">
              <h3 class="box-title"> <i class="fa fa-list-ul"></i> تعديل التصنيف</h3>
            </div>
                        <div class="box-body">
                            <div class="form-group">
                               <!--  <div class="col-md-4">
                                    <div class="radio">
                                        <label style="float:right;">
                                            <input tabindex="1" onclick="" type="radio" name="cat_t" id="cat_t"
                                                   value="1" checked="" onchange="$('#par_cat').hide();"> رئيسي
                                        </label>
                                        <label style="float:right;margin-right:30px">
                                            <input type="radio" onclick="" name="cat_t" id="cat_t2" value="0"
                                                   onchange="$('#par_cat').show();"> فرعي
                                        </label>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <label>التصنيف <i class="required">*</i></label>
                                    <input type="text" name="name" class="form-control" autocomplete="off"
                                           placeholder="اسم التصنيف" value="{{$data->name}}">
                                </div>
                                <div class="col-md-6"  id="par_cat">
                                    <label>التصنيف الأب<i class="required">*</i></label>
                                    <select class="form-control select2" style="border:1px solid #aaa;" name="parent_id">
                                        <option value="">--أختر--</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $data->parent_id)selected @endif>{{$category->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                 
                            </div>

                        </div>
                                                    <div class="box-footer">
                <button type="submit" class="btn btn-success my_btn_left"><i class="fa fa-edit"></i> تعديل التصنيف </button>
              </div>

                    </div>

                {!! Form::close() !!}
              </div>
            </div>
          </section>
      