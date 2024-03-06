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
<h3> IO Report Submitted</h3>
<table>
    <thead>
    <tr>


    </tr>
    </thead>
    <tbody>
    <tr>
        <th>IO ID</th>
        <td>
            {{$report->io_type}}-{{$report->issue_id}}
        </td>
    </tr>
    <tr>
        <th>IO Type</th>
        <td>
            {{$report->io_type}}
        </td>
    </tr>
    <tr>

        <th>Reporter Type</th>
        <td>
            {{$report->user_type}}
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
        <th>Location</th>
        <td>
            {{$report->location->name}}
        </td>
    </tr>
    <tr>
        <th>Description</th>

        <td>
            {{$report->description}}

        </td>
    </tr>
    <tr>
        <th>Suggestion</th>

        <td> {{$report->suggestion}}</td>
    </tr>

    </tbody>
</table>
</body>
</html>
