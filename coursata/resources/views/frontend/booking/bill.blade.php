<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    <title>Invoice (PDF) - Download </title>
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="/assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144-precomposed.png">

    <!-- CSS -->
    <link href="/assets/css/base.css" rel="stylesheet">
  
    <!-- Google web fonts -->
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    
  <style>
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    
    .table > tbody > tr > .no-line {
        border-top: none;
    }
    
    .table > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    </style>
        
    <!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.min.js"></script>
      <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
        
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-xs-12">
        <div class="invoice-title">
          <h2>{{trans('bookings.title_invoice')}}</h2><h3 class="pull-right">{{trans('bookings.label_booking_id')}} #{{$booking->booking_code}}</h3>
        </div>
        <hr>
        <div class="row">
          <div class="col-xs-6">
            <address>
            <strong>{{trans('bookings.label_billed_to')}} :</strong><br>
              {{$buyer->name}}<br>
                        {{$buyer->country->name}}<br>
              {{$buyer->city_name}}<br>
              {{$buyer->address_line1}}<br>
              {{$buyer->address_line2}}
            </address>
          </div>
          <div class="col-xs-6 text-right">
            

          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <address>
              <strong>{{trans('bookings.label_payment_method')}} :</strong><br>
              {{$booking->payment_method}}<br><br>
              {{$buyer->email}}
            </address>
          </div>
          <div class="col-xs-6 text-right">
            <address>
              <strong>{{trans('bookings.label_booking_at')}} :</strong><br>
              {{$buyer->created_at->format('Y-m-d')}}<br><br>
            </address>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Order summary</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-condensed">
                <thead>
                                <tr>
                      <td><strong>{{trans('bookings.label_bill_item')}}</strong></td>
                      <td class="text-center"><strong>{{trans('bookings.label_bill_price')}}</strong></td>
                      <td class="text-center"><strong>{{trans('bookings.label_bill_weeks')}}</strong></td>
                      <td class="text-right"><strong>{{trans('bookings.label_bill_total_price')}}</strong></td>
                                </tr>
                </thead>
                <tbody>
                  <!-- foreach ($order->lineItems as $line) or some such thing here -->
                  <tr>
                    <td>{{$booking->course->name}}</td>
                    <td class="text-center">{{$booking->course_week_price}}</td>
                    <td class="text-center">{{$booking->course_weeks}}</td>
                    <td class="text-right">{{$booking->course_total_price}}</td>
                  </tr>
                                 @foreach($booking->services as $service)
                                <tr>
                      <td>{{$service->name}}</td>
                    <td class="text-center">{{$service->type==house?$service->week_price:"---"}}</td>
                    <td class="text-center">{{$service->type==house?$service->num_weeks:"---"}}</td>
                    <td class="text-right">{{$service->total_price}}</td>
                  </tr>
                                 @endforeach
                                
                   <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>{{trans('bookings.label_bill_all_total_price')}}</strong></td>
                                    <td class="thick-line text-right">{{$booking->total_price}}</td>
                                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>



  </body>
</html>