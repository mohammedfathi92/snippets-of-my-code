
     <style>
                        .cer-wrap{
                            background-size:100% 100% !important;
                            direction: rtl;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            min-height: 625px;
                            min-width: 850px
                        }
                        .cer-content{
                            padding: 110px 0;
                        }
                        .cer-content, .cer-logo{
                            text-align: center;
                        }
                        .certify{
                            margin-top: 10px;
                            font-size: 21px;
                        }
                        .cStd-name, .cSub-name, .cer-degree{
                            font-size: 29px;
                            font-weight: 800;
                            color: #02475f

                        }
                        .cer-degree {
                            margin-bottom: 100px;
                        }
                        .cer-footer{
                            position: absolute;
                            right: 170px;
                            left: 170px;
                            width: calc(100% - 320px);  
                            bottom: 80px;
                            text-align: center;
                            font-size: 13px
                        }.m-0{
                            margin: 0;
                        }
                        .txth-line{
                            margin-top: 0.25rem;
                            margin-bottom: 0.5rem;
                            display: inline-block;
                            width: 100px;
                        }
                        .signature{
                            position: absolute;
                            bottom: 120px;
                            left: 150px;    
                        }
                        .signature-right{
                            position: absolute;
                            bottom: 120px;
                            right: 150px;   
                        }
                    </style>
    <div class="cirtificate_containter"> 
        <input  type="hidden" class="canvasDivId" value="canvas_{{$certificate->hashed_id}}">

                <div class="col-lg-12">
                    <div class="cer-wrap m-auto demo-box" style="background: url('{{$template->image}}');" id="canvas_{{$certificate->hashed_id}}">
                        <div class="cer-content">
                            @if($template->hasMedia('lms-certificate-site_logo'))
                            <div class="cer-logo">
                                <img src="{{$template->site_logo}}" class="">
                            </div>
                            @endif
                            <br>
                            <div style="margin: 30px 0px;">
                            
                            {!! $content !!}

                            </div>
                            
                        </div>
                        @if($template->hasMedia('lms-certificate-seal'))
                        <div class="signature">
                                <img src="{{$template->seal}}" >
                            </div>
                            @endif
                            @if($template->hasMedia('lms-certificate-signature'))
                            <div class="signature-right">
                                <br> <img src="{{$template->signature}}" >
                            </div>
                            @endif

                             <div class="cer-footer">
                            {!! strip_tags($template->note) !!}
                        </div>
                        
                    </div>
                  
                  
                </div>

                
          </div>


{{-- <script type="text/javascript">
    
    // var ctx = canvas.getContext("2d");

    // var ctx = canvas.getContext('2d');

    // ctx.beginPath();
    // ctx.arc(75,75,50,0,Math.PI*2,true); // Outer circle
    // ctx.moveTo(110,75);
    // ctx.arc(75,75,35,0,Math.PI,false);   // Mouth (clockwise)
    // ctx.moveTo(65,65);
    // ctx.arc(60,65,5,0,Math.PI*2,true);  // Left eye
    // ctx.moveTo(95,65);
    // ctx.arc(90,65,5,0,Math.PI*2,true);  // Right eye
    // ctx.stroke();

     $('#openCanvas').on('click', function() {
         console.log('Drew on the existing canvas');
        var canvas = $('canvas');
        html2canvas($("#content"), {canvas: canvas}).then(function(canvas) {
            console.log('Drew on the existing canvas');
        });
    });

</script> --}}

<script type="text/javascript">
    function download(){
    var link = document.createElement('a');
  link.download = 'filename.png';
  link.href = document.getElementById('myCanvas').toDataURL()
  link.click();
              //download.setAttribute("download","archive.png");
    }
</script>
  
        
        