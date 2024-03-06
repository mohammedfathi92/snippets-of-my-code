<?php
/**
 * Created by Ahmed Zidan.
 * email: php.ahmedzidan@gmail.com
 * Project: loreal
 * Date: 11/9/18
 * Time: 8:08 PM
 */
?>
<?php $employees = \App\Employee::all() ?>
{!! Form::open(["url"=>route("frontend.reports.mesur.store"),'class'=>'ajax-form', 'id' => 'main-form-id']) !!}
<div class="container-fluid animated fadeIn mesurreportpanel none du-5 report-panel">
    <div class="row">
        <div class="close"></div>
        <div class="col-lg-3 heightvh mesurleftbg animated fadeIn">
            <div class="underlogo purple animated fadeInUp">
                <img class="innerlogo" src="{{asset("assets/frontend/img/logo.png")}}">
            </div>
            <div class="flexpadd">
                <span class="no animated fadeInUp delay-1-2s purple">2</span>
                <span class="animated fadeInUp delay-1-4s">Mesur</span>
                <span class="reporttxt animated fadeInUp delay-1-5s">Report</span>
            </div>
        </div>
        <div class=" col-lg-9 panelpadding purplesection">
            <img class="back animated fadeInRight delay-1-7s" src="{{asset("assets/frontend/img/back.png")}}">
            <h1 class="animated fadeInUp delay-1-3s">Leader manager</h1>
            <div class="container-fluid mainpanel">
                <div class="row animated fadeInUp delay-1-4s">
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Leader: Mngr. n+1 / Mentor m </span>
                        <span id="leader-id-data" class="m-2 ajax-resp-data" style="display: none"></span>
                    </div>

                    <div class="col-lg-12">
                        <input type="text" placeholder="Enter Leader ID Number" name="leader_id" autocomplete="off"
                               id="leader-id">
                        {{--<select name="leader" id="leader">
                            <option value=""></option>
                        @foreach($employees as $employee)
                                <option value="{{$employee->empno}}">{{$employee->empname}}</option>
                            @endforeach
                        </select>--}}
                    </div>
                </div>
                <div class="row animated fadeInUp delay-1-5s">
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Co-Leader: Direct report, n </span>
                        <span id="leader-co-id-data" class="m-2 ajax-resp-data" style="display: none"></span>

                    </div>

                    <div class="col-lg-12">
                        <input type="text" placeholder="Enter CO-Leader ID Number" name="co_leader_id"
                               autocomplete="off"
                               id="co-leader-id">
                        {{--<select name="co_leader" id="co_leader">
                            <option value=""></option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->empno}}">{{$employee->empname}}</option>
                            @endforeach
                        </select>--}}
                    </div>
                </div>

                <div class="row animated fadeInUp delay-1-5s">
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Copy of the report to</span>
                    </div>

                    <div class="col-lg-12">
                        {{--<input type="text" placeholder="" name="copy_to" autocomplete="off">--}}
                        <select name="copy_to_id" id="copy_to">
                            <option value=""></option>
                            @foreach($employees as $employee)
                                <option value="{{$employee->empno}}">{{$employee->empname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row animated fadeInUp delay-1-5s">
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Person Visited</span>
                    </div>

                    <div class="col-lg-12">
                        <input type="text" placeholder="" name="person_visited" autocomplete="off">
                    </div>
                </div>
                <div class="row animated fadeInUp delay-1-5s">
                    <div class="col-lg-6 lab">

                        <span class="labeltxt">Date</span>
                        <div id="visited_date_container">
                            <input type="text" id="visited_date" class="datepicker" placeholder=""
                                   data-toggle="datepicker" autocomplete="off" name="visited_date" style="width: 100%;">
                        </div>

                    </div>

                    <div class="col-lg-6 lab">
                        <span class="labeltxt">Visited Area</span>
                        {{--<input type="text" placeholder="" name="visited_area" autocomplete="off">--}}
                        <select name="visited_area_id" id="visited_area">
                            <option value="">-- Select area --</option>
                            @foreach(\App\Area::all() as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>


            </div>


            <br>
            <br>
            <br>
            <br>

            <h1 class="animated fadeInUp">Preparation</h1>
            <div class="container-fluid mainpanel">
                <div class="row">
                    <div class="col-lg-12 lab">

                        <span class="labeltxt">Preparation</span>
                        <p>
                            Follow up of Previous Visits
                            performed in the Area of responsibility of the Direct report / Co-Leader "n"
                        </p>
                    </div>

                    <div class="col-lg-12">
                        {{--<textarea placeholder="Username"></textarea>--}}
                        <input type="text" placeholder="preparation Username" name="visit_preparation"
                               autocomplete="off">
                    </div>

                    <div class="col-lg-12 lab">

                        <span class="labeltxtarabic">Topic of the Visit</span>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" placeholder="Topic of the Visit" name="visit_topic" autocomplete="off">
                    </div>

                </div>


            </div>
            <br>
            <br>
            <br>
            <br>
            <h1 class="animated fadeInUp"><span>Observations</span>
                <div class="addicon" onclick="addObservation()">
                    <span>Add Observation</span>
                    <span>
                        <img src="{{asset("assets/frontend/img/addicon.png")}}">
                    </span>
                </div>
            </h1>
            <div class="container-fluid mainpanel nopaddingbottom">
                <div class="row">
                    <div class="table">
                        <table id="observations-table">
                            <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th class="actionssec">
                                    Opservaition
                                </th>
                                <th>
                                    Risk
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Options
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr></tr>

                            </tbody>
                        </table>
                        <div class="divspan">
                            <span>(*) Observation Type</span>
                            <span>GP: Safety Good Practice</span>
                            <span>RP: At-Risk Practice</span>
                            <span>RC: At-Risk Condition</span>
                        </div>
                    </div>

                </div>


            </div>

            <br>
            <br>
            <br>
            <br>
            <h1 class="animated fadeInUp"><span>Actions</span>
                <div class="addicon" data-toggle="modal" data-target="#actionsModal">
                    <span>Add Action</span><span><img src="{{asset("assets/frontend/img/addicon.png")}}"></span>
                </div>
            </h1>
            <div class="container-fluid mainpanel nopaddingbottom">
                <div class="row">
                    <div class="table">
                        <table id="actions-table">
                            <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th class="actionssec">
                                    Actions
                                </th>
                                <th class="smallt">
                                    C /CA /<br>PA (**)
                                </th>
                                <th class="smallt">
                                    Co-leader,<br>
                                    leader / Part.

                                </th>
                                <th class="smallt">
                                    Immediate<br>
                                    or target date

                                </th>
                                <th class="smallt">
                                    options

                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr></tr>


                            </tbody>
                        </table>
                        <div class="divspan">
                            <span>(**)  Action Type </span>
                            <span>C: Curative Action (eliminate the deviation) </span>
                            <span>CA: Corrective Action (avoid the repetition of the deviation)</span>
                            <span>PA: Preventive Action (avoid the occurrence of potential similar deviations)</span>
                        </div>
                    </div>

                </div>


            </div>


            <button type="submit" class="btn btn-primary3 btn-rounded purple">Send</button>


        </div>


    </div>
</div>
{!! Form::close() !!}



<!-- add Observation Modal -->
<div class="modal fade" id="observationsModal" tabindex="-1" role="dialog" aria-labelledby="observationsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="observationsModalLabel">Add Observation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url'=>'','id'=>'add-observation-form']) !!}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 lab">

                            <span class="labeltxt">Observation</span>
                        </div>
                        <div class="col-lg-12">
                            <textarea name="observation"></textarea>

                        </div>
                        <div class="col-lg-12 lab">

                            <span class="labeltxt">Risk</span>
                        </div>
                        <div class="col-lg-12">
                            <select name="risk">
                                <option value="Broken / missing parts">Broken / missing parts</option>
                                <option value="Safety Card">Safety Card</option>
                                <option value="Heat / pressure / lighting">Heat / pressure / lighting</option>
                                <option value="lose air">lose air</option>
                                <option value="Risk of fire / explosion">Risk of fire / explosion</option>
                                <option value="Risk of sliding stitches for cables, Hoses">Risk of sliding stitches for
                                    cables, Hoses
                                </option>
                                <option value="Electrical risks">Electrical risks</option>
                                <option value="Take the wrong situation">Take the wrong situation</option>
                                <option value="Sharp surfaces / moving parts">Sharp surfaces / moving parts</option>
                                <option value="Chemicals">Chemicals</option>
                                <option value="lose a product">lose a product</option>
                                <option value="Other">Other</option>
                            </select>

                        </div>
                        <div class="col-lg-12 lab">

                            <span class="labeltxt">Type</span>
                        </div>
                        <div class="col-lg-12">
                            <select name="type">
                                <option value="RP">RP</option>
                                <option value="RC">RC</option>
                                <option value="GP">GP</option>
                            </select>

                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary popupbtn purple">Add</button>
                <button type="button" class="btn btn-primary popupbtn purple" data-dismiss="modal">Close</button>
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>


<!-- add actions Modal -->
<div class="modal fade" id="actionsModal" tabindex="-1" role="dialog" aria-labelledby="actionsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url'=>'','id'=>'add-action-form']) !!}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 lab">

                            <span class="labeltxt">Action Details</span>
                        </div>
                        <div class="col-lg-12">
                            <textarea name="action_details"></textarea>

                        </div>
                        <div class="col-lg-12 lab">

                            <span class="labeltxt">Action type <!-- RiC /CA / PA (**)sk --></span>
                        </div>
                        <div class="col-lg-12">
                            <select name="action_type">
                                @foreach($actionTypes as $type)
                                    <option value="{{$type->id}}">{{$type->TypeName}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-lg-12 lab">

                            <span class="labeltxt">Co-leader, leader / Part</span>
                        </div>
                        <div class="col-lg-12">

                            <select name="action_coLeader">

                                @foreach($leaders as $leader)
                                    <option value="{{$leader->id}}">{{$leader->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-lg-12 lab">

                            <span class="labeltxt">Immediate or target date</span>
                        </div>
                        <div class="col-lg-12">
                            <div id="target_date_container"></div>
                            <input type="text" id="target_date" class="datepicker" name="target_date"
                                   autocomplete="off">
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary popupbtn purple">Add</button>
                <button type="button" class="btn btn-primary popupbtn purple" data-dismiss="modal">Close</button>
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>

@push("scripts")
    <script>
        $("#leader-id").keyup(function () {
            let val = $(this).val();
            axios.post("{{route("frontend.ajax.validateEmpId")}}", {id: val}).then(
                resp => {
                    response = resp.data;
                    if (response.success) {
                        $("#leader-id-data").html(response.data.empname).removeClass().addClass("text-success").show();
                    } else {
                        $("#leader-id-data").html(response.message).removeClass().addClass("text-danger").show();

                    }
                }
            );
        });
        $("#co-leader-id").keyup(function () {
            let val = $(this).val();
            axios.post("{{route("frontend.ajax.validateEmpId")}}", {id: val}).then(
                resp => {
                    response = resp.data;
                    if (response.success) {
                        $("#leader-co-id-data").html(response.data.empname).removeClass().addClass("text-success").show();
                    } else {
                        $("#leader-co-id-data").html(response.message).removeClass().addClass("text-danger").show();

                    }
                }
            );
        });
    </script>
    <script>
        $("#visited_date").datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            scrollTop: 0,
            container: "#visited_date_container"
        });
        $("#target_date").datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            scrollTop: 0,
            container: "#target_date_container"
        });
        var form_is_valid = function (form) {

            var inputs = $(form).find("input[type=text],select,textarea"), hasErrors = 0;
            $(form).find(".error-message").remove();
            $.each(inputs, function (k, input) {

                if (!$(input).val()) {
                    hasErrors++;
                    $(input).parent().append("<span class='text-danger error-message'>This field is required </span>");
                }

            });
            return hasErrors ? false : true;
        }

        var observations = [],
            addObservation = function () {
                this.modal = $("#observationsModal").modal();
                this.modal.attr('method', 'post');
                this.modal.find("[name]").val('');


            },
            editObservation = function (index) {
                var s = this;
                s.modal = $("#observationsModal").modal();
                s.data = observations[index];
                s.modal.find('form').attr("method", "put");
                s.modal.find('form').attr("data-index", index);
                if (s.data) {
                    $.each(s.data, function (k, v) {
                        var input = s.modal.find("[name=" + k + "]");

                        input.val(v).trigger('change');
                    });
                }

            },
            deleteObservation = function (index) {
                observations.splice(index, 1);
                loadObservations();
            },
            loadObservations = function () {
                var row = "", table = $("#observations-table");
                table.find('tbody tr').remove();
                // var mainForm = $("#main-form-id");
                $.each(observations, function (index, item) {
                    row = "<tr class='row-form-table'>";
                    row += "<td>" + (index + 1) + "</td>";
                    row += "<td>" + item.observation + "</td>";
                    row += "<td>" + item.risk + "</td>";
                    row += "<td>" + item.type + "</td>";
                    row += "<td>" +
                        "<a href='#' onclick='editObservation(" + index + ")'>Edit</a>  " +
                        "<a href='#' onclick='deleteObservation(" + index + ")'>Delete</a>" +
                        "<input type='hidden' name='observations[" + index + "][observation]' value='" + item.observation + "'/></td>" + "<input type='hidden' name='observations[" + index + "][risk]' value='" + item.risk + "'/>" + "<input type='hidden' name='observations[" + index + "][type]' value='" + item.type + "'/>" + "</td>";

                    row += "</tr>";


                    table.find('tbody').append(row);
                });

            };

        function getInputValue(name) {

            return $("[name=" + name + "]").val();
        }

        $("#add-observation-form").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            if ($(this).attr('method') == "put") {

                if (form_is_valid(this) === true) {
                    var index = parseInt($(this).data('index')), obj = {
                        observation: getInputValue("observation"),
                        risk: getInputValue("risk"),
                        type: getInputValue("type")
                    };
                    observations.splice(index, 1, obj);
                    $(this).attr("method", 'post').attr("data-index", "");
                }


            } else {
                if (form_is_valid(this) === true) {
                    observations.push({
                        observation: getInputValue("observation"),
                        risk: getInputValue("risk"),
                        type: getInputValue("type")
                    });
                    $(this).find("[name]").val('');
                }
            }

            loadObservations();
        });

    </script>
    <script>
        var actions = [],
            addAction = function () {
                console.log("testing action");
                this.modal = $("#actionsModal").modal();
                this.modal.attr('method', 'post');
                this.modal.find("[name]").val('');

            },
            editAction = function (index) {
                var s = this;
                s.modal = $("#actionsModal").modal();
                s.data = actions[index];
                s.modal.find('form').attr("method", "put");
                s.modal.find('form').attr("data-index", index);
                if (s.data) {
                    $.each(s.data, function (k, v) {
                        var input = s.modal.find("[name=" + k + "]");

                        input.val(v).trigger('change');
                    });
                }

            },
            deleteAction = function (index) {
                actions.splice(index, 1);
                loadActions();
            },
            loadActions = function () {
                var row = "", table = $("#actions-table");
                table.find('tbody tr').remove();
                // var mainForm = $("main-form-id");
                $.each(actions, function (index, item) {

                    row = "<tr class='row-form-table'>";
                    row += "<td>" + (index + 1) + "</td>";
                    row += "<td>" + item.details + "</td>";
                    row += "<td>" + item.type + "</td>";
                    row += "<td>" + item.coLeader + "</td>";
                    row += "<td>" + item.target_date + "</td>";
                    row += "<td>" +
                        "<a href='#' onclick='editAction(" + index + ")'>Edit</a>  " +
                        "<a href='#' onclick='deleteAction(" + index + ")'>Delete</a>" +
                        "<input type='hidden' name='actions[" + index + "][details]' value='" + item.details + "'/>" +
                        "<input type='hidden' name='actions[" + index + "][type]' value='" + item.type + "'/>" +
                        "<input type='hidden' name='actions[" + index + "][coLeader]' value='" + item.coLeader + "'/>" +
                        "<input type='hidden' name='actions[" + index + "][target_date]' value='" + item.target_date + "'/>" +
                        "</td>";
                    row += "</tr>";

                    table.find('tbody').append(row);
                });

            };

        function getInputValue(name) {

            return $("[name=" + name + "]").val();
        }

        function getInputText(name) {
            return $("[name=" + name + "]").text();
        }

        $("#add-action-form").submit(function (e) {

            e.preventDefault();
            var formData = $(this).serializeArray();


            if ($(this).attr('method') == "put") {
                if (form_is_valid(this) === true) {
                    var index = parseInt($(this).data('index')), obj = {
                        details: getInputValue("action_details"),
                        type: getInputValue("action_type"),
                        coLeader: getInputValue("action_coLeader"),
                        target_date: getInputValue("target_date")
                    };
                    actions.splice(index, 1, obj);
                    $(this).attr("method", 'post').attr("data-index", "");

                }

            } else {

                if (form_is_valid(this) === true) {
                    console.log("valid");
                    actions.push({
                        details: getInputValue("action_details"),
                        type: getInputValue("action_type"),
                        coLeader: getInputValue("action_coLeader"),
                        target_date: getInputValue("target_date")
                    });
                    $(this).find("[name]").val('');
                }
            }

            loadActions();
        });
        $(".back").on("click touchstart", function () {
            observations = [];
            actions = [];
            loadObservations();
            loadActions();
        });
    </script>
@endpush
