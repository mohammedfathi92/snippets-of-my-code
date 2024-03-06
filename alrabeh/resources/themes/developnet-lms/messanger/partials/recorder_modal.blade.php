<!-- Modal -->
<div class="modal fade" id="showRecorderModal" tabindex="-1" role="dialog" aria-labelledby="showRecorderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #fff">
        <div class="modal-body" dir="rtl">
           {!! Form::model($user, ['url' => route('message.audio_store'),'method'=>'POST','files'=>true,'class'=>'ajax-send-audio-message
           ', "enctype" => "multipart/form-data", 'id' => 'new_fowmato']) !!}

    <input type="hidden" name="reciever_id" value="{{$user->hashed_id}}">

             <div class="recorder container recorder-container">
 
      <p class="recorder-buttons-group" style="text-align: center;">
        <a href="javascript:;" class="btn btn-primary start_recording" ><i class="fa fa-play"></i> تسجيل  </a>
        <a href="javascript:;" class="btn btn-warning stop_recording"  disabled style="display: none;"><i class="fa fa-stop-circle"></i> إيقاف   </a>
      </p>
      
      <br>
      <center>
      <table id="recordingslist" class="recordings-list" >

       

      </table>
      </center>
    </div>
    {!! Form::close() !!}

         </div>
          <div class="modal-footer border-top-0" style="padding-right: 30px">
            <a href="javascript:;" class="btn btn-danger store_audio_msg" data-reciever_id="{{$user->hashed_id}}" data-dismiss="modal" ><i class="fa fa-paper-plane"></i> ارسال </a>
            <a href="javascript:;"  class="btn btn-secondary" data-dismiss="modal">@lang('LMS::attributes.main.label_cancel')</a>
          </div>
    </div>
  </div>
</div>


