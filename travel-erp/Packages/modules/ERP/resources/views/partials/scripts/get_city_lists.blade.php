<script type="text/javascript">
  $('body').on('change', '.cities_list', function() {
  var thisDiv = $(this);
  var city_id = $(this).val();
  @if($list_type == 'hotels')
  var otherDiv = 'hotels_list_div';
  var otherList = 'hotels_list';
  var other_type = 'hotels';
  var classes = 'hotels_list empty-options';
  @elseif($list_type == 'drivers')
  var otherDiv = 'drivers_list_div';
  var otherList = 'drivers_list';
  var other_type = 'drivers';
  var classes = 'drivers_list empty-options';
  @endif

  var selector = $(this).closest('.row').find('.'+otherList);
  var data = {'name': selector.attr('name'), 'label': selector.data('label'), 'required': true, 'selected': '', 'select2': 'select2', 'class': classes, 'other_type': other_type};

  $('.empty-options').empty();

    $.ajax({
            method: 'GET',
            data: $.param(data),
            url: '/erp/ajax/cities/'+ city_id +'/get-lists',
           
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

