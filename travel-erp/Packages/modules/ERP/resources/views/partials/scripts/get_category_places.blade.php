

<script type="text/javascript">
  $(document).ready(function () {
    $('body').on('change', '.get_place_type_lists', function(){

      var elem = $(this);
      var category = $(this).val();
      var cityDivId = $(this).data('city_div_id');
      var selectId = $(this).data('other_select_id');
      var select2 = $(this).data('select2_class');
      var closestClass = $(this).data('closest_class');
      var cityId = $('#'+cityDivId).val(); 

      var selectOptions = $('#'+selectId);
            selectOptions.html('');
            selectOptions.append(new Option('{{__('ERP::attributes.main.select_new_option')}}', ''));

           if(category !== null){
           $.ajax({
            method: 'GET',
            url: '/erp/ajax/cities/'+cityId+'/categories/'+ category +'/get-places-list',
           
            success: function (result) {

              if(result.success){
                var list = result.list;

                for (var key in list) {
                  if (list.hasOwnProperty(key)) {

                    selectOptions.append(new Option(list[key], key));
                 
                  }
                 }
              }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });

    } //end check input val

    }); 

    });

</script>


<script type="text/javascript">
      $('body').on('change', '.get_places_cat', function(){

        var catPlaceList = {!!trim(json_encode(__('ERP::attributes.transport_places')), '"') !!};
        var place_cat_div_id = $(this).data('place_cat_id');
        var place_div_id = $(this).data('place_id');
        var placeList = $('#'+place_div_id);
         placeList.html('');
            placeList.append(new Option('{{__('ERP::attributes.main.select_new_option')}}', ''));
          var selectOptions = $('#'+place_cat_div_id);

          selectOptions.html('');
            selectOptions.append(new Option('{{__('ERP::attributes.main.select_new_option')}}', ''));

            if($(this).val() > 0){

                for (var key in catPlaceList) {
                   
                  if (catPlaceList.hasOwnProperty(key)) {

                    selectOptions.append(new Option(catPlaceList[key], key));
                 
                  }
                 }

            }

    });
</script>
