
<script src="/assets/chat/recorder/js/lib/recorder.js"></script>
<script src="/assets/chat/recorder/js/recordLive.js"></script>
<script type="text/javascript">
  //load ask teacher modal

        $( function() {

  $('body').on('click','.show_recorder_btn',function(){

        var btn = $(this);


        $('#showRecorderModal').modal('show');
        $('.recordings-list').html('');
        // .find('.modal-body').load('/load_recorder')

});

});
</script>


<script type="text/javascript">
  //load ask teacher modal

        $( function() {

  $('body').on('click','.store_audio_msg',function(){

  	var btn = $(this);
  	var blob = $('input[name=audio_message]').val();
    var link = $('input[name=audio_message]').attr('link');
  	console.log(blob);
  	var reciever_id = btn.data('reciever_id');
    var file = new File([blob], "name");
    var formData = new FormData();
    formData.append('audio_message', file);
    formData.append('reciever_id', reciever_id);
           $.ajax({
            method: 'POST',
            url: '{{route('message.audio_store')}}',
            data: formData,
             processData: false,
             contentType: false,
            cache: false,
            success: function (result) {
             console.log('sumbitted');
            },

            error: function (result) {
                alert('An error occurred.');

            },
        });

});

});
</script>


