
     <div class="chat-icon-popup-left">
    <div>
       <div class="chat-icon-popup-cont">
             <div class="text-cener">
            </div>
            <br>

<a href="/messages" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=450,height=700');return false;"><img src="/img/chat-icon.jpg" style="width:80px;  border-radius: 50%;"></a>

            
            
         
       </div>
      </div>
 </div>

 @push('child_scripts')
 <script type="text/javascript">
           $( function() {
    
  $('body').on('click','.live_chat_modal',function(){

        var btn = $(this);


        $('#liveChatModal').modal('show').find('.modal-body').load('/messages');
       
});  

});
 </script>

 @endpush