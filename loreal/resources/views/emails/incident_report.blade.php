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
<h3> Incident Report Submitted</h3>
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

        <th>Reporter</th>
        <td>

            {{$report->reporter? $report->reporter->name:"N/A"}}
        </td>
    </tr>
    <tr>

        <th>Type of loreal site</th>
        <td>
            {{$report->type_loreal_site??"N/A"}}
        </td>
    </tr>
    <tr>
        <th>Injured Person Name</th>
        <td>
            {{$report->injured_person_name}}
        </td>
    </tr>
    <tr>
        <th>Incident Date</th>
        <td>
            {{$report->incident_date}}
        </td>
    </tr>
    <tr>
        <th>Time Between</th>
        <td>
            {{$report->time_between}}
        </td>
    </tr>
    <tr>
        <th>Incident Nature</th>

        <td>
            {{$report->incident_nature}}

        </td>
    </tr>

    <tr>
        <th>Incident Place</th>

        <td>
            {{$report->incident_place}}

        </td>
    </tr>

    <tr>
        <th>Incident Type</th>

        <td>
            {{$report->incident_type}}

        </td>
    </tr>

    <tr>
        <th>Lost Days</th>

        <td>
            {{$report->lost_days}}

        </td>
    </tr>
    <tr>
        <th>Lost Days</th>

        <td>
            {{$report->lost_days}}

        </td>
    </tr>
    <tr>
        <th>Duty Days</th>

        <td>
            {{$report->duty_days}}

        </td>
    </tr>
    <tr>
        <th>Circumstances</th>

        <td>
            {{$report->circumstances}}

        </td>
    </tr>
    <tr>
        <th>Consequences</th>

        <td>
            {{$report->consequences}}

        </td>
    </tr>
    <tr>
        <th>Lesions Nature</th>

        <td>
            {{$report->lesions_nature}}

        </td>
    </tr>
    <tr>
        <th>Lesions Location</th>

        <td>
            {{$report->lesions_location}}

        </td>
    </tr>
    <tr>
        <th>Causes Analysis</th>

        <td>
            {{$report->causes_analysis}}

        </td>
    </tr>
    <tr>
        <th>Description Causes</th>

        <td>
            {{$report->description_causes}}

        </td>
    </tr>

    </tbody>
</table>
</body>
</html>
