<script type="text/javascript">
  $('body').on('change', '.get-country-lists', function() {
  var thisDiv = $(this);
  var country_id = $(this).val();
  var other_type = $(this).data('other_type');
  var otherDiv = $(this).data('other_div');
  var otherList = $(this).data('other_list');
  var selector = $(this).closest('.row').find('.'+otherList);
  var data = {'name': selector.attr('name'), 'label': selector.data('label'), 'required': thisDiv.data('required_div'), 'selected': '', 'select2': 'select2', 'class': otherList, 'other_type': other_type};

   $('.empty-options').empty();

    $.ajax({
            method: 'GET',
            data: $.param(data),
            url: '/erp/ajax/countries/'+ country_id +'/get-lists',
           
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