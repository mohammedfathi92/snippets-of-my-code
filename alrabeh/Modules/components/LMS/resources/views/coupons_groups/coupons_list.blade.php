<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ \Settings::get('site_name', 'Modules') }} | أكواد الحجز</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
   {!! Theme::css('plugins/bootstrap/dist/css/bootstrap.min.css') !!}
<!-- Font Awesome -->
{!! Theme::css('plugins/font-awesome/css/font-awesome.min.css') !!}
<!-- Theme style -->
{!! Theme::css('css/AdminLTE.css') !!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  @if(\Language::isRTL())
    {!! Theme::css('css/style-rtl.css') !!}
    {!! Theme::css('plugins/bootstrap/dist/css/bootstrap-rtl.css') !!}

@endif
</head>
<body class="hold-transition{{--  lockscreen --}}" >
<!-- Automatic element centering -->
<div class="lockscreen-wrapper" style=" margin: 10px" id="exportContent">
<button onclick="Export2Doc('exportContent', 'word-content');">تصدير الى  .doc</button>

<button onclick="myFunction()">طباعة</button>


  <div style="margin: 30px">

    @foreach($coupons_list as $coupon)

<p>{!! str_replace("coupon_code",$coupon->code,$coupon_group->template); !!}</p>
@endforeach

  </div>

</div>
<!-- /.center -->

<!-- jQuery 3 -->
{!! Theme::js('plugins/jquery/dist/jquery.min.js') !!}
<!-- Bootstrap 3.3.7 -->
{!! Theme::js('plugins/bootstrap/dist/js/bootstrap.min.js') !!}
{!! Theme::js('plugins/googoose/jquery.googoose.js') !!}
<script type="text/javascript">
function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Alrabeh Academy</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        // downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
</script>
<script type="text/javascript">
  function myFunction() {
  window.print();
}
  
</script>
</body>
</html>
