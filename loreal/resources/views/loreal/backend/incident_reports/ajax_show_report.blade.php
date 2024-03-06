<div id="ReportView">
    <style>

        .wrap-content {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px 30px;
        }

        .p0 {
            padding: 0;
        }

        .bg-e {
            background: #eee;
        }

        .bg-d {
            background: #ddd;
        }

        .bg-f9 {
            background: #f9f96ad9
        }

        .bg-f0 {
            background: #f0ffff;
        }

        .font-bold {
            font-weight: 700;
        }

        /**/

        table {
            border: 1px solid #333;
            border-top: 1px solid #333;
        }

        .table td, .table th {
            border-top: initial;
        }

        tr {
            height: 33px;
            max-height: auto
        }

        td {
            border-right: 1px solid #333;
            border-left: 1px solid #333;
            border-bottom: 1px solid #777;
        }

        /**/
        .table thead th {
            border: 1px solid #333;
            border-bottom: 1px solid #333;
        }

    </style>
    <style media="print">
        #printBtn {
            display: none;
        }
    </style>
    <div class="wrapper">
        <a href="#" id="printBtn" class="pull-right btn btn-primary hidden-print"
                            onclick="printContent('ReportView')"><i class="glyphicon glyphicon-print"></i> Print</a>

        <div class="wrap-content container">

            <header>
                <div class="row">
                    <div class="col-sm-12 text-center p-3 ">
                        <h3>REPORTING INFORMATION OF AN INCIDENT</h3>
                    </div>
                </div>
            </header>

            <br>

            <section>
                <table class="table table-sm text-center">
                    <thead>
                    <tr>
                        <th> Types of LOREAL Sites</th>
                        <th>Name of LOREAL Site(*) <br>
                            <small class="text-mute"><i>Name UsedFor Safty Reports</i></small>
                        </th>
                        <th> Name Of Person Reporting The incident</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bg-f9">{{$data->type_loreal_site}}</td>
                        <td>{{$data->name_loreal_site}}</td>
                        <td>{{$data->incident_reporter_name}}</td>
                    </tr>

                    </tbody>
                </table>
            </section>

            <br>

            <section>
                <table class="table table-sm text-center">
                    <thead>
                    <tr>
                        <th>Date of the incident</th>
                        <th>Nature of the incident</th>
                        <th> Place of the incident</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bg-f0">{{$data->incident_date}}</td>
                        <td class="bg-f0">{{$data->incident_nature}}</td>
                        <td class="bg-f0">{{$data->incident_place}}</td>
                    </tr>

                    </tbody>
                </table>
            </section>
            <br>
            <section>
                <table class="table table-sm text-center">
                    <thead>
                    <tr>
                        <th>Type of the accident</th>
                        <th>Injured person</th>
                        <th>Position</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bg-f0">{{$data->incident_type}}</td>
                        <td class="bg-f0">{{$data->injured_person_type}}</td>
                        <td class="bg-f0">{{$data->injured_person_position}}</td>
                    </tr>

                    </tbody>
                </table>
            </section>
            <br>
            <section>
                <table class="table table-sm text-center">
                    <thead>
                    <tr>
                        <th>Number of days lost</th>
                        <th>Number of days in light duty</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bg-f0">{{$data->lost_days}}</td>
                        <td class="bg-f0">{{$data->duty_days}}</td>

                    </tr>

                    </tbody>
                </table>
            </section>
            <br>


            <br>
            <section>
                <div class="row">
                    <div class="col-md-12 offset-md-2">
                        <table class="table table-sm text-center ">
                            <thead>
                            <tr>
                                <th> Circumstances - Sequence of events (join photos in the thumbnail "photo")</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-f0" style="height: 100px;">
                                <td>{{$data->circumstances}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <br>

            <section>
                <div class="row">
                    <div class="col-md-12 offset-md-2">
                        <table class="table table-sm text-center ">
                            <thead>
                            <tr>
                                <th>Consequences (human, material, environmental …)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-f0" style="height: 100px;">
                                <td>{{$data->consequences}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <br>
            <section>
                <table class="table table-sm text-center">
                    <thead>
                    <tr>
                        <th>Nature of lesions</th>
                        <th>Location of lesions</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bg-f0">{{$data->lesions_nature}}</td>
                        <td class="bg-f0">{{$data->lesions_location}}</td>

                    </tr>

                    </tbody>
                </table>
            </section>
            <br>

            <section>
                <table class="table table-sm text-center">
                    <thead>
                    <tr>
                        <th>Nature of lesions</th>
                        <th>Location of lesions</th>
                        <th>Root causes analysis</th>


                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="bg-f0">{{$data->lesions_nature}}</td>
                        <td class="bg-f0">{{$data->lesions_location}}</td>
                        <td class="bg-f0">{{$data->causes_analysis}}</td>

                    </tr>

                    </tbody>
                </table>
            </section>
            <br>

            <section>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm text-center ">
                            <thead>
                            <tr>
                                <th>Possible causes</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-f9" style="height: 100px;">
                                <td>{{$data->description_causes}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <br>
            <section>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm text-center ">
                            <thead>
                            <tr>
                                <th>Plan of immediate actions / long-term</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-f9" style="height: 100px;">
                                <td>{{$data->actions_plans}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
            <br>
            <section>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm text-center ">
                            <thead>
                            <tr>
                                <th>Name, position, phone number and e.mail of the person to contact for more
                                    information
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-f9" style="height: 100px;">
                                <td>{{$data->injured_person_name}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </section>


        </div>
    </div>
</div>

<script>
    function printContent(id) {

        var divToPrint = document.getElementById(id);

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }
</script>
