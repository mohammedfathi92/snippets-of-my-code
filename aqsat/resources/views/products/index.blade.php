@extends('voyager::master')

@section('page_title', __('title.products.index'))

@section('page_header')
    <h1><i class="fa fa-shopping-cart"></i> المنتجات <a href="#" class="btn btn-danger my_btn_left"
                                                        onclick="$('#add_panal').toggle();">
            <i class="fa fa-plus-circle"> </i> منتج جديد
        </a></h1>
@endsection
@section('content')
 


    <section class="content">
        @include('include.message')
        <div class="row">
            <div class="col-md-12">

                {!! Form::open(['route'=>'products.store','method'=>'post']) !!}
                <div class="box box-danger box-solid" id="add_panal" style="display:none;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-shopping-cart"></i> منتج جديد</h3>
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

                            <div class="col-md-4" id="par_cat">
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
                        <button type="submit" class="btn btn-danger my_btn_left"><i class="fa fa-shopping-cart"></i>
                            إضافة منتج
                        </button>
                    </div>

                </div>

                {!! Form::close() !!}
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-list-alt"></i> قائمة المنتجات</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="aqTable" class="table table-bordered table-striped table-hover"
                        >
                            <thead>
                            <tr>
                                <th> م</th>
                                <th id="name">اسم المنتج</th>
                                <th id="name">التصنيف</th>
                                <th id="name">الحاله</th>
                                <!-- <th id="name">السعر</th> -->
                                <!--  <th id="name">العدد</th> -->
                                <th id="name">التحكم</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $cat)
                                <tr>
                                    <td>{{$cat->id}}</td>
                                    <td>{{$cat->name}}</td>
                                    <td>{{$cat->category->name}}</td>
                                    <td>{{$cat->status == 1 ? "مفعل": "غير مفعل"}}</td>
                                    {{--  <td>{{$cat->price}}</td>
                                    <td>{{$cat->available_num}}</td> --}}
                                    <td>
                                        <a href="avascript:void(0);" class="btn btn-success btn-sm"
                                           onclick="openEditModal({{$cat->id}})"><i class="fa fa-edit"></i> تعديل </a>
                                        @if($cat->id != 1)
                                        <a href="{{route('products.delete',$cat->id)}}" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash"></i> حذف </a>
                                            @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th> م</th>
                                <th id="name">اسم المنتج</th>
                                <th id="name">التصنيف</th>
                                <th id="name">الحاله</th>
                                <!-- <th id="name">السعر</th> -->
                                <!-- <th id="name">العدد</th> -->
                                <th id="name">التحكم</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myEditModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
                    <p>انتظر قليلا .... .</p>
                </div>

            </div>

        </div>
    </div>

@endsection


@section('javascript')
    <script>

        function openEditModal(id) {
            $('#myEditModal').modal('show').find('.modal-body').load('/admin/products/ajax/' + id + '/edit');

        }


    </script>
@endsection