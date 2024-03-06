<script type="text/javascript">
  $('body').on('change', '.hotels_list', function() {
  var thisDiv = $(this);
  var hotel_id = $(this).val();

  var otherDiv = 'rooms_list_div';
  var otherList = 'rooms_list';
  var other_type = 'rooms';
  var classes = 'rooms_list empty-options';


  var selector = $(this).closest('.row').find('.'+otherList);
  var data = {'name': selector.attr('name'), 'label': selector.data('label'), 'required': true, 'selected': '', 'select2': 'select2', 'class': classes, 'other_type': other_type};

    $.ajax({
            method: 'GET',
            data: $.param(data),
            url: '/erp/ajax/hotels/'+ hotel_id +'/get-rooms',
           
            success: function (result) {

              if(result.success){
                 $('#'+otherDiv).html(result.data);
               }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });

});
</script>