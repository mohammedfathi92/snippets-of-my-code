@extends('voyager::master')
@section('page_title', __('title.categories.index'))

@section('page_header')
    <h1><i class="fa fa-list-ul"></i>تصنيفات المنتجات <a href="#" class="btn btn-danger my_btn_left"
                                                         onclick="$('#add_panal').toggle();">
            <i class="fa fa-plus-circle"> </i>تصنيف جديد
        </a></h1>
@endsection
@section('content')



    <section class="content">
        @include('include.message')
        <div class="row">
            <div class="col-md-12">

                {!! Form::open(['route'=>'categories.store','method'=>'post']) !!}
                <div class="box box-danger box-solid" id="add_panal" style="display:none;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list-ul"></i> تصنيف جديد</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-4">
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
                            </div>
                            <div class="col-md-4">
                                <label>التصنيف <i class="required">*</i></label>
                                <input type="text" name="name" class="form-control" autocomplete="off"
                                       placeholder="اسم التصنيف">
                            </div>
                            <div class="col-md-4" style="display:none" id="par_cat">
                                <label>نوع التصنيف<i class="required">*</i></label>
                                <select class="form-control select2" style="border:1px solid #aaa;" name="parent_id">
                                    <option value="">--أختر--</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger my_btn_left"><i class="fa fa-plus-circle"></i> إضافة
                            التصنيف
                        </button>
                    </div>

                </div>

                {!! Form::close() !!}
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-list-alt"></i> قائمه التصنيفات</h3>
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
                                <th>م</th>
                                <th>اسم التصنيف</th>
                                <th>نوع التصنيف</th>
                                <th>تاريخ الانشاء</th>
                                <th>خيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td> {{$category->id}} </td>
                                    <td>
                                        <a href="{{route('categories.products',['id'=> $category->id])}}"> {{$category->name}} </a>
                                    </td>
                                    <td> {{$category->parent_id == null ? "رائيسى":"فرعى"}} </td>
                                    <td> {{$category->created_at->toFormattedDateString()}} </td>
                                    <td><a href="{{route('categories.products',['id'=> $category->id])}}"
                                           class="btn btn-info btn-sm"><i class="fa fa-shopping-cart"></i> المنتجات </a>
                                        <a href="avascript:void(0);" class="btn btn-success btn-sm"
                                           onclick="openEditModal({{$category->id}})"><i class="fa fa-edit"></i> تعديل
                                        </a>
                                        @if($category->id != 1)
                                            <a href="{{route('categories.delete',$category->id)}}"
                                               class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>م</th>
                                <th>اسم التصنيف</th>
                                <th>نوع التصنيف</th>
                                <th>تاريخ الانشاء</th>
                                <th>خيارات</th>
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
            $('#myEditModal').modal('show').find('.modal-body').load('/admin/categories/ajax/' + id + '/edit');

        }


    </script>
@endsection