@extends('voyager::master')

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="col-md-12">

                <br>
                <div><h3 class="no_print page-title"><i
                                class=" icon-briefcase page_title_icon"></i> إدارة العقود </h3>
                </div>
            </div>

                <div class="col-md-12">
                    <a href="{{url('admin/contracts/1/create')}}" class="icon-btn">
                        <i class="fa fa-plus "></i>
                        <div>عقد تقسيط جديد</div>
                    </a>
                    <a href="{{url('admin/contracts/2/create')}}" class="icon-btn">
                        <i class="fa fa-plus"></i>
                        <div>عقد آجل جديد</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="fa fa-credit-card"></i>
                        <div>التحصيل والسداد</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div>العقود السارية</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div>المتأخرة بالسداد</div>
                    </a>

                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div>العقود المتعثرة</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div> أرباح العقود</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div> العقود الخالصة</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div> الأقساط والدفعات</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div>عمولة العقد</div>
                    </a>
                    <a href="" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div>الرسوم الإدارية</div>
                    </a>
                    <a href="https://u51657.dhman.io/125/210/225/104" class="icon-btn">
                        <i class="icon-briefcase "></i>
                        <div>new group</div>
                    </a>
                </div>
            </div>
            <br clear="both"/>
        </div>


@endsection