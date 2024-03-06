@extends('layouts.iframe')

@section('css')
    <style type="text/css">
        button {
           /* width:100%;*/
           /*display: block;*/
        }

        .zwibbler-builtin-toolbar {
    width: 70px;}

    </style>

@endsection
@section('content') 
<div class="row" style="width: 100%;">
	<div class="col-md-12">

			<form action="{{url('ajax/save-board-db').'?question='.$hashed_id}}" method="post" id="board-form">
				 {{ csrf_field() }}
				 <input type="hidden" name="white_board" id="white_board_data" value="{{$board_data?json_decode($board_data):''}}">
        <input type="hidden" name="save_type" id="save_doc_type" value="0">

<button type="button" class="btn btn-light" onclick="useTool('mouse')"><i class="fa fa-mouse-pointer"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('pen')"><i class="fa fa-pencil"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('brush')"><i class="fa fa-paint-brush"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('erase')"><i class="fa fa-eraser"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('line')"><i class="fa fa-window-minimize"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('text')"><i class="fa fa-font"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('circle')"><i class="fa fa-circle-o"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('square')"><i class="fa fa-square-o"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('triangle')"><i class="fa fa-caret-square-o-up"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('cut')"><i class="fa fa-cut"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('copy')"><i class="fa fa-copy"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('paste')"><i class="fa fa-paste"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('zoomout')"><i class="fa fa-search-minus"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('zoomin')"><i class="fa fa-search-plus"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('undo')"><i class="fa fa-mail-forward"></i></button>
<button type="button" class="btn btn-light" onclick="useTool('redo')"><i class="fa fa-mail-reply"></i></button>
<button type="button" class="btn btn-light" onclick="openFullscreen()" class="open-full"><i class="fa fa-arrows-h"></i> تكبير </button>
<button type="button" class="btn btn-light" onclick="closeFullscreen()" class="exit-full"><i class="fa fa-arrows-h"></i> تصغير </button>
  <button type="submit" class="btn btn-light"><i class="fa fa-bookmark"></i> حفظ</button>
<button type="button" class="btn btn-light" onclick="downloadPng()"><i class="fa fa-cloud-download"></i> تحميل</button>
<button type="button" class="btn btn-light" onclick="clearBoard()"><i class="fa fa-trash"></i> مسح الكل</button>
      <button tool onclick="insertImage2()" title="Insert image">
        <i class="fas fa-image"></i>
      </button>
</form>
</div>


</div>



{{--             <div class="row">
            	<div class="col-md-12">
            
            <a href="javascript:;"  class="show-hide-board btn btn-secondary">اغلاق</a>

            </div>
            </div> --}}

     

                    <div id="zwibbler" style="margin-left:auto;margin-right:auto;border:2px solid red;width:100%;height:80vh; background: #848484; "></div>



@endsection

@section('js')


<script src="/assets/themes/developnet-lms/js/zibber/zwibbler2.js"></script>
    <script type="text/javascript">
        var zwibbler = Zwibbler.create("zwibbler", {
        	    showToolbar: false,
    showColourPanel: true


        });



var canvass = document.getElementsByClassName("zwibbler-main-canvas");
var canvas  = canvass[0];
var context = canvas.getContext("2d");

function insertImage2() {
zwibbler.insertImage();
}

zwibbler.setConfig("background", '#848484');

zwibbler.setColour("white", true);

zwibbler.useBrushTool({
    lineWidth: 1, // optional
});


function useTool($tool) {
	switch($tool) {
  case 'pen':
    zwibbler.useBrushTool({
    lineWidth: 1, // optional
     });
    break;
  case 'mouse':
    zwibbler.usePickTool();
    break;
      case 'brush':
        zwibbler.useBrushTool({
    lineWidth: 7, // optional
     });
    break;
      case 'erase':
     zwibbler.useBrushTool({
    lineWidth: 10, // optional
    strokeStyle: "erase" //clear
});
    break;
      case 'line':
    zwibbler.useLineTool();
    break;
      case 'text':
    zwibbler.useTextTool();
    break;
      case 'circle':
    zwibbler.useCircleTool();
    break;
      case 'square':
    zwibbler.useRectangleTool();
    break;
      case 'triangle':
    zwibbler.usePolygonTool(3, 0, 1.0, {
    lineWidth: 1,
    strokeStyle: "white"
});
    break;
      case 'cut':
    zwibbler.cut();
    break;
      case 'copy':
    zwibbler.copy();
    break;
      case 'paste':
    zwibbler.paste();
    break;
      case 'zoomin':
    zwibbler.zoomIn();
    break;

      case 'zoomout':
    zwibbler.zoomOut();
    break;
          case 'undo':
    zwibbler.undo();
    break;
    case 'redo':
    zwibbler.redo();
    break;
  default:
        zwibbler.useBrushTool({
    lineWidth: 1, // optional
     });
}


}

function clearBoard() {
zwibbler.newDocument();
}

function downloadPng() {
    zwibbler.download('png', 'drawing.png');
   // zwibbler.download('jpg', 'drawing.jpg');
   //  zwibbler.download('svg', 'drawing.svg');
   //  zwibbler.download('pdf', 'drawing.pdf');
}
    </script>

    <script>
var elem = document.getElementById("body");
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
  $('.open-full').hide();
  $('.exit-full').show();
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }

  $('.open-full').show();
  $('.exit-full').hide();
}
</script>
    @if(!empty($board_data))

<script type="text/javascript">
$(window).load(function() {
    var data = $('#white_board_data').val();
  
  zwibbler.load(data);

});

</script>
@endif

<script type="text/javascript">

  $("#board-form").on('submit', function(e) {
     e.preventDefault(); 

    var saved = zwibbler.save(); 

    $('#white_board_data').val(saved);
        $('#save_doc_type').val(1);
    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), 
           success: function(response)
           {
            $('#save_doc_type').val(0);
           }
         });


});
</script>
<script type="text/javascript">
  zwibbler.on("document-changed", function() {
    if (zwibbler.dirty()) {
      var saved = zwibbler.save(); 

    $('#white_board_data').val(saved);
    $('#save_doc_type').val(0);

    var form = $('#board-form');
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), 
           success: function(response)
           {
            return true;
           }
         });
    } else {
        // disable save button
    }
});

</script>

@endsection