<script type="text/javascript">
	$(document).ready(function () {
		$('body').on('change', '.get_geo_lists', function(){

      var elem = $(this);

			var itemId = $(this).val();
			var type = $(this).data('item_type');
			var listType = $(this).data('list_type');
			var selectId = $(this).data('other_select_id');
			var select2 = $(this).data('select2_class');
			var closestClass = $(this).data('closest_class');
      var geoChildClass = $(this).data('geo_child_class');

			var data = {
				list_type: listType,
				select_id: selectId,
				select2: select2,
				closest_class: closestClass
			};
			var selectOptions = $('#'+selectId);
            selectOptions.html('');
            selectOptions.append(new Option('{{__('ERP::attributes.main.select_new_option')}}', ''));

            var closestGeo = $(this).closest('.row').find('.'+geoChildClass);

           closestGeo.each(function(i, elem) {
			var ele_type = $(elem).data('item_type');
			if(type !== ele_type){
				if (ele_type !== 'countries' &&  ele_type !== 'cities') {
				$(elem).html('');
            $(elem).append(new Option('{{__('ERP::attributes.main.select_new_option')}}', ''));
			}
			}

			 });

           if(itemId !== null){
           $.ajax({
            method: 'GET',
            data: $.param(data),
            url: '/erp/ajax/'+type+'/'+ itemId +'/get_geo_lists',
           
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



     if (typeof doGeoLists === "function") { 

      doGeoLists(elem, data);
    
      }
		}); 

		});

</script>




