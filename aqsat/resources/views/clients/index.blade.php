@extends('voyager::master')

@section('page_title', __('title.client.index'))

@section('content')


@section('page_header')
    <h1><i class="fa fa-users"></i>إدارة العملاء</h1>
@endsection



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
                {{Form::open(['route'=>'clients.search','method'=>'get'])}}
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="اختياري">
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
                                <input type="text" class="form-control" name="mobile" id="email"
                                       placeholder="اختياري">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary my_btn_left"><i class="fa fa-search"></i> أبحث
                    </button>
                </div>
                {{Form::close()}}
            </div>
            <!-- /.box -->

            <!-- Form Element sizes -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-list-alt"></i> قائمه العملاء</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="aqTable" class="table table-bordered table-striped">
                        <thead>

                        <tr>
                            <th>م
                            </th>
                            <th
                            >العميل
                            </th>

                            <th>السجل المدني
                            </th>
                            <th>رقم الجوال
                            </th>
                            <th>العقود السارية</th>
                            <th>التحكم
                            </th>
                        </tr>

                        </thead>
                        <tbody>

                        @foreach($clients->get() as $client)
                            @if($client->profile)
                            <tr>
                                <td>{{$client->id}}</td>

                                <td><a style="color:black"
                                       href="{{route('clients.show',$client->id)}}">
                                        {{$client->profile->full_name}}
                                    </a>
                                </td>

                                <td> {{$client->profile->national_id}} </td>
                                <td>
                                    <div style="direction:ltr;text-align:right;"> {{$client->profile->mobile}} </div>
                                </td>
                                <td>
                                    {{$client->client_contracts->where('kind',null)->count()}}
                                </td>

                                <td>
                                    <a href="{{route('clients.delete',$client->id)}}"
                                       class="btn btn-danger fa fa-trash-o"> حذف </a>
                                    <a href="{{route('clients.edit',$client->id)}}"
                                       class="btn btn-primary fa fa-edit"> تعديل </a>
                                    <a href="{{route('clients.show',$client->id)}}"
                                       class="btn btn-info fa fa-table"> اظهار </a>
                                </td>
                            </tr>
                            @endif
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>م
                            </th>
                            <th
                            >العميل
                            </th>

                            <th>السجل المدني
                            </th>
                            <th>رقم الجوال
                            </th>
                            <th>العقود السارية</th>
                            <th>التحكم
                            </th>
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