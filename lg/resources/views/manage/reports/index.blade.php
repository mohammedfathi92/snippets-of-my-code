@extends("layouts.app")
@section("content")
    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li><a class="active">{{trans("main.link_reports")}}</a></li>

                </ol>
            </div>

            <div class="panel-body ">
                <div class="col-md-3 col-sm-6 ">
                    <a href="{{url("manage/reports/opportunities")}}" class="text-center"><i class="fa fa-pie-chart fa-6" aria-hidden="true"></i><br> {{trans("reports.link_opportunities_reports")}}</a>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <a href="{{url("manage/reports/products")}}" class="text-center"><i class="fa fa-pie-chart fa-6" aria-hidden="true"></i><br> {{trans("reports.link_products_reports")}}</a>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <a href="{{url("manage/reports/distributors")}}" class="text-center"><i class="fa fa-pie-chart fa-6" aria-hidden="true"></i><br> {{trans("reports.link_distributors_reports")}}</a>
                </div>
            </div>
        </div>
        <!-- End Panel -->
    </div>
@endsection