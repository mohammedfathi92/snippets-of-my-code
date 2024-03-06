@extends('voyager::master')
<!-- Just change investors.page_title -->
@section('page_title', __('title.investor.index'))

@section('page_header')
    <h1><i class="fa fa-users"></i>ادارة المستثمريين</h1>
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">
        @include('include.message')
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> البحث المتقدم</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {{Form::open(['route'=>'investors.search','method'=>'get'])}}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">الاسم</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="اختياري">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="segel">الهوية الوطنية/الإقامة</label>
                                        <input type="text" class="form-control" name="national_id" id="email"
                                               placeholder="اختياري">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">رقم الجوال</label>
                                        <input type="text" class="form-control" name="mobile" id="email" placeholder="اختياري">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit"  class="btn btn-primary my_btn_left"><i class="fa fa-search"></i> أبحث</button>
                        </div>
                    {{Form::close()}}
                </div>
                <!-- /.box -->

                <!-- Form Element sizes -->
                <div class="box box-success box-solid">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-list-alt"></i> قائمة المستثمرين</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="aqTable" class="table table-bordered table-striped">
                            <thead>

                            <tr>
                                <th>م</th>
                                <th>المستثمر/الصندوق الإستثماري</th>
                                <th>العقود</th>
                                <th>السجل المدني</th>
                                <th>رقم الجوال</th>
                                <th>التحكم</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($investors->get() as $investor)
                                @if($investor->profile)
                                <tr>
                                    <td>{{$investor->profile->id}}</td>
                                    <td><a style="color:black"
                                           href="{{route('investors.show',$investor->id)}}">
                                            {{$investor->name}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$investor->contracts->count()}}
                                    </td>
                                    <td> {{$investor->profile->national_id}} </td>
                                    <td>
                                        <div style="direction:ltr;text-align:right;"> {{$investor->profile->mobile}} </div>
                                    </td>

                                    <td>

                                        @if($investor->id != 1)
                                        <a href="{{route('investors.delete',$investor->id)}}"
                                           class="btn btn-danger fa fa-trash-o"> حذف </a>
                                        @endif

                                        <a href="{{route('investors.edit',$investor->id)}}"
                                           class="btn btn-primary fa fa-edit"> تعديل </a>
                                        <a href="{{route('investors.show',$investor->id)}}"
                                           class="btn btn-info fa fa-table"> اظهار </a>

                                    </td>
                                </tr>
                                @endif
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>م</th>
                                <th>المستثمر/الصندوق الإستثماري</th>
                                <th>العقود</th>
                                <th>السجل المدني</th>
                                <th>رقم الجوال</th>
                                <th>التحكم</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- /.box -->


            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


@endsection
