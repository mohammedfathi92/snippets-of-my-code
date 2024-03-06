<?php
/**
 * Created by Ahmed Zidan.
 * email: php.ahmedzidan@gmail.com
 * Project: loreal
 * Date: 12/9/18
 * Time: 12:21 PM
 */
?>

        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3> Mesur Report Submitted</h3>
<table>
    <thead>
    <tr>


    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Report ID</th>
        <td>
            {{$report->id}}
        </td>
    </tr>
    <tr>

        <th>Leader</th>
        <td>

            {{$report->leader? $report->leader->name:"N/A"}}
        </td>
    </tr>
    <tr>

        <th>Co-Leader</th>
        <td>
            {{$report->co_leader?$report->co_leader->name:"N/A"}}
        </td>
    </tr>
    <tr>
        <th>Reporter Name</th>

        <td>
            {{$report->reporter_name}}
        </td>
    </tr>
    <tr>
        <th>Area</th>

        <td>
            {{$report->area->name}}
        </td>
    </tr>
    <tr>
        <th>Visit Date</th>
        <td>
            {{$report->visited_date}}
        </td>
    </tr>
    <tr>
        <th>Visit Topic</th>

        <td>
            {{$report->visit_topic}}

        </td>
    </tr>
    <tr>
        <th>Actions</th>
        <td>
            @if($actions)
                <table border="1">

                    @foreach($actions as $action)
                        <tr>
                            <th>Type</th>
                            <td>{{$action->type?$action->type->name:"N/A"}}</td>

                        </tr>
                        <tr>
                            <th>Source</th>
                            <td>{{$action->source?$action->source->name:"N/A"}}</td>
                        </tr>
                        <tr>
                            <th>Issuer</th>
                            <td>{{$action->issuer?$action->issuer->name:"N/A"}}</td>
                        </tr>
                        <tr>
                            <th>Issue Date</th>
                            <td>{{\Carbon\Carbon::parse($action->IssueDate)}}</td>
                        </tr>
                        <tr>
                            <th>Action Details</th>
                            <td>{{$action->ActionDetails}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                    @endforeach

                </table>
            @endif
        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
