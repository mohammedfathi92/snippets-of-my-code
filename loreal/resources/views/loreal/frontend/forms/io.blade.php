<?php
/**
 * Created by Ahmed Zidan.
 * email: php.ahmedzidan@gmail.com
 * Project: loreal
 * Date: 11/9/18
 * Time: 8:03 PM
 */
?>
<div class="container-fluid animated fadeIn sioreportpanel none du-5 yemainsec report-panel">
    {!! Form::open(['route'=>'frontend.reports.io.store','class'=>'ajax-form']) !!}
    <div class="row">
        <div class="close"></div>
        <div class="col-lg-3 heightvh sioleftbg animated fadeIn">
            <div class="underlogo yellow animated fadeInUp">
                <img class="innerlogo" src="{{asset('assets/frontend/img/logo.png')}}">
            </div>
            <div class="flexpadd">
                <span class="no animated fadeInUp delay-1-2s">1</span>
                <span class="animated fadeInUp delay-1-4s">Io</span>
                <span class="reporttxt animated fadeInUp delay-1-5s">Report</span>
            </div>
        </div>
        <div class=" col-lg-9 panelpadding ">
            <img class="back animated fadeInRight delay-1-7s" src="{{asset('assets/frontend/img/back.png')}}">
            <h1 class="animated fadeInUp delay-1-3s">Basic info</h1>
            <div class="container-fluid mainpanel">
                <div class="row animated fadeInUp delay-1-4s">
                    <div class="col-lg-6 lab">
                        <span class="labelicon"><img src="{{asset('assets/frontend/img/icon1.png')}}"></span>
                        <span class="labeltxt">User Type</span>
                    </div>
                    <div class="col-lg-6 rtl lab">
                        <span><img src="{{asset("assets/frontend/img/icon1.png")}}"></span>
                        <span class="labeltxtarabic">نوع المستخدم</span>
                    </div>
                    <div class="col-lg-12">
                        <select name="user_type" id="user_type">
                            <option value="employee">Employee :: موظف</option>
                            <option value="guest">Guest :: زائر</option>
                        </select>
                    </div>
                </div>
                <div class="row animated fadeInUp delay-1-4s" id="EmpNumberContainer">
                    <div class="col-lg-6 lab">
                        <span class="labelicon"><img src="{{asset('assets/frontend/img/icon1.png')}}"></span>
                        <span class="labeltxt">Employee ID</span>
                    </div>
                    <div class="col-lg-6 rtl lab">
                        <span><img src="{{asset("assets/frontend/img/icon1.png")}}"></span>
                        <span class="labeltxtarabic">رقم الموظف</span>

                        <span id="empData" class="m-2 ajax-resp-data" style="display: none"></span>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" name="employee_id" placeholder="Employee ID" id="employee_id"
                               autocomplete="off">
                    </div>
                </div>
                <div class="row animated fadeInUp delay-1-4s" id="GuestNameContainer" style="display: none">
                    <div class="col-lg-6 lab">
                        <span class="labelicon"><img src="{{asset('assets/frontend/img/icon1.png')}}"></span>
                        <span class="labeltxt">Guest Name</span>
                    </div>
                    <div class="col-lg-6 rtl lab">
                        <span><img src="{{asset("assets/frontend/img/icon1.png")}}"></span>
                        <span class="labeltxtarabic">اسم الزائر</span>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" name="guest_name" placeholder="Enter your name" autocomplete="off">
                    </div>
                </div>
                <div class="row animated fadeInUp delay-1-4s">
                    <div class="col-lg-6 lab">
                        <span class="labelicon"><img src="{{asset('assets/frontend/img/icon1.png')}}"></span>
                        <span class="labeltxt">Io Type</span>
                    </div>
                    <div class="col-lg-6 rtl lab">
                        <span><img src="{{asset("assets/frontend/img/icon2.png")}}"></span>
                        <span class="labeltxtarabic"></span>
                    </div>
                    <div class="col-lg-12">
                        <select name="io_type" id="io_type">
                            <option value="SIO">Sio</option>
                            <option value="PIO">Pio</option>
                            <option value="QIO">Qio</option>
                        </select>
                    </div>
                </div>

                <div class="row animated fadeInUp delay-1-5s">
                    <div class="col-lg-6 lab">
                        <span class="labelicon"><img src="{{asset('assets/frontend/img/icon2.png')}}"></span>
                        <span class="labeltxt">Work area</span>
                    </div>
                    <div class="col-lg-6 rtl lab">
                        <span><img src="{{asset("assets/frontend/img/icon2.png")}}"></span>
                        <span class="labeltxtarabic">منطقة العمل</span>
                    </div>
                    <div class="col-lg-12">
                        <select name="area" id="area">
                            <option value="">Select Work Area :: حدد منطقة العمل</option>
                            @foreach(\App\Area::all() as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-lg-12">
                        <select name="location" id="location">
                            <option value="">Select Area First :: حدد المنطقة أولاً</option>
                        </select>

                    </div>
                </div>
                <div class="row " id="allRisks">
                    <div class="col-lg-6 lab animated fadeInUp delay-1-6s">
                        <span class="labelicon"><img src="{{asset("assets/frontend/img/icon5.png")}}"></span>
                        <span class="labeltxt">Potential risks</span>
                    </div>
                    <div class="col-lg-6 rtl lab animated fadeInUp delay-1-6s">
                        <span><img src="{{asset("assets/frontend/img/icon5.png")}}"></span>
                        <span class="labeltxtarabic">الخطر المحتمل</span>
                    </div>
                    <div class="col-lg-12 animated fadeInUp delay-1-6s">
                        <div class="lightbg">
                            <div class="container-fluid">
                                <div class="row" id="risksContainer">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <br>
            <br>
            <br>


            <h1 class="animated fadeInUp">Further descriptions</h1>
            <div class="container-fluid mainpanel">
                <div class="row">
                    <div class="col-lg-6 lab">
                        <span class="labelicon"><img src="{{asset("assets/frontend/img/icon3.png")}}"></span>
                        <span class="labeltxt">Risk / Loss description</span>
                    </div>
                    <div class="col-lg-6 rtl lab">
                        <span><img src="{{asset("assets/frontend/img/icon3.png")}}"></span>
                        <span class="labeltxtarabic">وصف الخطر / الفقد</span>
                    </div>
                    <div class="col-lg-12">
                        <textarea name="description" placeholder="Descrip the risk"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 lab">
                        <span class="labelicon"><img src="{{asset("assets/frontend/img/icon4.png")}}"></span>
                        <span class="labeltxt">Suggested improvement</span>
                    </div>
                    <div class="col-lg-6 rtl lab">
                        <span><img src="{{asset("assets/frontend/img/icon4.png")}}"></span>
                        <span class="labeltxtarabic">التحسين المقترح</span>
                    </div>
                    <div class="col-lg-12">
                        <textarea name="suggestion" placeholder="How to enhance?"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary3 yellow btn-rounded">Send</button>
            </div>

        </div>


    </div>
    {!! Form::close() !!}
</div>
@push("scripts")
    <script>
        var checkEmpType = function (emp) {
            if (emp == "employee") {
                $("#EmpNumberContainer").show();
                $("#GuestNameContainer").hide();
            } else {
                $("#GuestNameContainer").show();
                $("#EmpNumberContainer").hide();
            }
        }

        $("#user_type").on("change", function () {
            checkEmpType($(this).val())
        });


        $('#employee_id').keyup(function () {
            let val = $(this).val();
            axios.post("{{route("frontend.ajax.validateEmpId")}}", {id: val}).then(
                resp => {
                    response = resp.data;
                    if (response.success) {

                        $("#empData").html(response.data.empname).removeClass().addClass("text-success").show();
                    } else {
                        $("#empData").html(response.message).removeClass().addClass("text-danger").show();

                    }
                }
            );
        });

        var getAreaLocations = function (area) {
            if (!area) {
                $("#location").html("<option value=''>Select Area First :: حدد المنطقة أولاً</option>");
                return false;
            }
            axios.get("{{route("frontend.ajax.get-area-locations")}}", {params: {area: area}}).then(resp => {
                var options = "", response = resp.data;
                if (response.success) {
                    _.each(response.data, function (option) {

                        options += "<option value='" + option.id + "'>" + option.name + "</option>";
                    });
                }
                $("#location").html(options);
            });
        }
        var getRisksByType = function (type) {
            axios.get("/frontend/ajax/risks/" + type).then(function (resp) {
                if (resp.data.success) {
                    var html = "";
                    $.each(resp.data.data, function (key, item) {
                        html += '<div class="custom-control custom-checkbox checkhaif col-lg-6">' +
                            '<input type="checkbox" class="custom-control-input" id="defaultChecked' + key + '" name="risks_list[]" value="' + item.name + '">' +
                            '<label class="custom-control-label" for="defaultChecked' + key + '">' +
                            '<span>' + item.name + '</span>' +
                            '</label>' +
                            '</div>';

                    });

                    $("#risksContainer").show().html(html);

                }
            });
        }

        $(document).ready(function () {
            var ioType = $("#io_type").val();
            getRisksByType(ioType);
            $("#user_type").val("employee");
            checkEmpType($("#user_type").val());
            $("#io_type").change(function () {
                getRisksByType($(this).val());
            });
            var area = $("#area").val();
            getAreaLocations(area);
            $("#area").change(function () {
                getAreaLocations($(this).val());
            });
        });

    </script>
@endpush
