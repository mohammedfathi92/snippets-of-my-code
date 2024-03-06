<div id="ReportView">

    <style>

        .wrap-content {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px 30px;
        }

        .fom-wrap {
            color: #fff;
        }

        .form-title {
            font-family: cursive;
        }

        .bordered-Bottem {
            display: inline-block;
            position: relative;
        }

        .bordered-Bottem:after {
            position: absolute;
            content: '';
            width: 30%;
            height: 2px;
            background: #a26516;
            bottom: -3px;
            left: 1px;
            border-radius: 1px;
        }

        .table i {
            font-size: 13px
        }

        .bg-f {
            background: #fff;
        }

        table {
            border: 1px solid #333;
            border-top: 1px solid #333;
        }

        .table td, .table th {
            border-top: initial;
        }

        tr {
            height: 40px;
            max-height: auto
        }

        td {
            border-right: 1px solid #333;
            border-left: 1px solid #333;
            border-bottom: 1px solid #777;
            text-align: left;
        }

        table table {
            border: 1px dashed #333;
            border-top: 1px dashed #333;
        }

        table .table td, table .table th {
            border-top: initial;
        }

        table table tr {
            height: 33px;
            max-height: auto
        }

        table table td {
            border-right: 1px dashed #333;
            border-left: 1px dashed #333;
            border-bottom: 1px dashed #777;
            text-align: left;
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
            <br>
            <header>
                <div class="row">
                    <div class="col-sm-12 text-center p-3 ">
                        <h3>IO
                            REPORT {{-- <span> <button class="btn btn-sm btn-primary pull-right edit"><i class="voyager-double-right"></i> Print </button></span> --}}</h3>
                    </div>
                </div>
            </header>
    
            <section>
                <div class="row">
                    <div class="col-md-12 offset-md-3">
                        <div class="form-title mb-2">
                            <h3 class="bordered-Bottem"> Basic Info</h3>
                        </div>
                        @php
                        $area = \App\Area::find($data->area_id);
                        $location = \App\Location::find($data->location_id);
                        $potential_risks = json_decode($data->risks_list, true);

                        @endphp
                        <table class="table table-sm mb-4 ">
                            <tbody>
                            <tr class="bg-f0">
                                <td style="width: 30%">
                                    <i class="fa fa-user"></i>
                                    <span><strong>Username</strong> </span>
                                </td>
                                <td>{{$data->reporter_name}}</td>
                            </tr>
                            <tr class="bg-f0">
                                <td>
                                    <i class="fa fa-empire"></i>
                                    <span><strong>Work area</strong> </span>
                                </td>
                                <td><p>{{$area?$area->name:''}}</p>
                                    <p>{{$location?$location->name:''}}</p></td>
                            </tr>
                            <tr class="bg-f0">
                                <td>
                                    <i class="fa fa-empire"></i>
                                    <span><strong>Potential risks</strong> </span>
                                </td>
                                <td>
                                    @foreach($potential_risks as $row)
                                        <p> - {{$row}}  </p>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-title mb-2 ">
                            <h3 class="bordered-Bottem">Further Description</h3>
                        </div>

                        <table class="table table-sm ">
                            <tbody>
                            <tr class="bg-f0">
                                <td style="width: 30%">
                                    <i class="fa fa-empire"></i>
                                    <span><strong>Reisk / Loss description</strong> </span>
                                </td>
                                <td>{{$data->description}}</td>
                            </tr>
                            <tr class="bg-f0">
                                <td>
                                    <i class="fa fa-empire"></i>
                                    <span><strong>Suggested improvment</strong> </span>
                                </td>
                                <td>{{$data->suggestion}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>

            <br><br><br>
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
