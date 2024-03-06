<div id="ReportView">
    <div class="wrapper">
        <a href="#" id="printBtn" class="pull-right btn btn-primary hidden-print"
           onclick="printContent('ReportView')"><i class="glyphicon glyphicon-print"></i> Print</a>

        <div class="wrap-content container">
            <style>
                body {
                    background: #eee;
                    padding-top: 30px;
                    padding-bottom: 30px
                }

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
                    border-bottom: 1px dashed #777;
                }

                /* table1 */
                .table1 tr > td:first-child {
                    width: 25%;
                    border-bottom: 1px solid #333;
                    text-align: center;
                }

                .table1 tr > td:last-child {
                    width: 75%;
                    border-bottom: 1px dashed #777;
                }

                .tr-3in1 > div {
                    display: inline-block;
                    padding: 3px;
                    margin-top: -1px;
                }

                .tr-3in1 > div:first-child {
                    width: 55%;
                }

                .tr-3in1 > div:nth-child(2) {
                    width: 20%;
                    border: 1px solid #333;

                }

                .tr-3in1 > div:last-child {
                    width: 20%;
                }

                /* table2 */
                .table2 tr > td:first-child {
                    width: 25%;
                    border-bottom: 1px solid #333;
                    text-align: center;
                }

                .table2 tr > td:last-child {
                    width: 75%;
                    border-bottom: 1px solid #333;
                }

                .with-bordered-div {
                    padding: 0 !important;
                }

                .with-bordered-div > div {
                    height: 33px;
                    max-height: auto;
                    border-bottom: 1px dashed #777;
                    padding: 5px;
                }

                .with-bordered-div > div:last-child {
                    border-bottom: 0;
                }

                .table-header {
                    border: 1px solid #333;
                    border-bottom-color: #ddd;
                    padding: 2px;
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
            <header>
                <div class="row">
                    <div class="col-md-3">
                        <div>
                            <h2>LOREAL</h2>
                            <!-- 							<div><span>Document 1 of 1</span></div>
                             -->                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-center border border-dark p-3 bg-e">
                            <h3>MESUR – Visit Report N°.</h3>
                            <div><span>Manage Effectively Safety  Using Recognition and Realignment</span></div>
                        </div>
                    </div>
                </div>
            </header>

            <br>

            <section>
                <div class="">
                    <table class="table table-sm table1 ">
                        <tr>
                            <td class="bg-e">Leader: Mngr. n+1 / Mentor m</td>
                            <td style="padding: 0">
                                <div class="tr-3in1">
                                    <div>{{$data->leader}}</div>
                                    <div class="bg-e text-center">Date</div>
                                    <div>{{$data->visited_date}}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <td class="bg-e">Co-Leader: Direct report, n</td>
                            <td style="padding: 0">
                                <div class="tr-3in1">
                                    <div>{{$data->co_leader}}</div>
                                    <div class="bg-e text-center">Visited Area</div>
                                    <div>{{$data->visited_area}}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-e">Copy of the report to</td>
                            <td>
                                {{$data->copy_to}}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-e"></td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="bg-e">Person Visited</td>
                            <td>
                                {{$data->person_visited}}
                            </td>
                        </tr>
                    </table>
                </div>
            </section>

            <br>

            <section>
                <div class="text-center bg-e table-header">
                    <h5>Preparation</h5>
                </div>
                <table class="table table-sm table2 " style="border-top: transparent;">
                    <tr>
                        <td>
                            Follow up of Previous Visits performed in the Area of responsibility of the Direct report /
                            Co-Leader "n"
                        </td>
                        <td class="with-bordered-div">
                            {!! $data->visit_preparation !!}
                            {{-- <div class="border-bottom-dashed"></div>
                            <div class="border-bottom-dashed"></div>
                            <div class="border-bottom-dashed"></div>
                            <div class="border-bottom-dashed"></div>
                            <div class="border-bottom-dashed"></div> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Topic of the Visit</td>
                        <td>{{$data->visit_topic}}</td>
                    </tr>
                </table>
            </section>

            <br>

            <section>
                @php

                    $observations = json_decode($data->observations, true);
                    $actions = json_decode($data->actions, true);

                @endphp
                @if(count($observations))
                    <table class="table table-sm ">
                        <thead class="bg-e text-center">
                        <tr>
                            <th>N°</th>
                            <th style="width: 70%">Observations</th>
                            <th>Risk</th>
                            <th>Type (*)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($observations as $row)
                            <tr>
                                <td class="text-center">{{$loop->index + 1}}</td>
                                
                                <td>{{isset($row['observation'])?$row['observation']:''}}</td>
                                <td>{{isset($row['risk'])?$row['risk']:''}}</td>
                                <td>{{isset($row['type'])?$row['type']:''}}</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                    <div class="text-center text-secondary">
                        <span class="font-bold">(**)</span> <span>(**)</span>&nbsp;&nbsp;
                        <span class="font-bold">GP:</span> <span>Safety Good Practice</span>&nbsp;&nbsp;
                        <span class="font-bold">RP:</span> <span>At-Risk Practice</span>&nbsp;&nbsp;
                        <span class="font-bold">RC:</span> <span>At-Risk Condition</span>
                    </div>
            </section>
            @endif

            <br>
            @if(count($actions))
                <section>
                    <table class="table table-sm ">
                        <thead class="bg-e text-center">
                        <tr>
                            <th>Observ</th>
                            <th style="width: 60%">Actions</th>
                            <th>C /CA / PA (**)</th>
                            <th>by Co-leader, leader / Part.</th>
                            <th>Immediateor target date</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($actions as $raw)
                            <tr>
                                <td class="text-center">{{$loop->index + 1}}</td>
                                <td>{{isset($row['action'])?$row['action']:''}}</td>
                                <td>{{isset($row['type'])?$row['type']:''}}</td>
                                <td>{{isset($row['person_type'])?$row['person_type']:''}}</td>
                                <td>{{isset($row['target_date'])?$row['target_date']:''}}</td>

                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <div class="text-center text-secondary">
                        <span class="font-bold">(**)</span> <span>(**)</span>&nbsp;&nbsp;
                        <span class="font-bold">GP:</span> <span>Safety Good Practice</span>&nbsp;&nbsp;
                        <span class="font-bold">RP:</span> <span>At-Risk Practice</span>&nbsp;&nbsp;
                        <span class="font-bold">RC:</span> <span>At-Risk Condition</span>
                    </div>
                </section>
            @endif
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
