<script type="text/javascript">
	 $(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.country_filter', function(){                
            var country =  $(this);
            var country_id = $("#country_id").val();                        
            $.ajax({
                type: "GET",
                url: "/erp/ajax/filters/cities",
                data: "country_id="+country_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var select = $('#city_id');
                        if(select.prop) {
                          var options = select.prop('options');
                        }
                        else {
                          var options = select.attr('options');
                        }
                        $('option', select).remove();

                        $.each(result.success, function(val, text) {
                            options[options.length] = new Option(text, val);
                        });
        

                        }else{
                            alert(result.error)
                        }

                    },
                error: function (result) {
                            alert('An error occurred.');

                },
                   
            
            });             
        });


    });
</script>