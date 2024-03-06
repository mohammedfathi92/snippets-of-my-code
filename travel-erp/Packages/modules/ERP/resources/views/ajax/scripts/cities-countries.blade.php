<script type="text/javascript">
	
    var __baseUrl = "{{url('/')}}";

 $(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.country_id', function(){                
            var country =  $(this);
            // get the selected option value of country

            var country_id = country.val();
            var cities = country.attr('data-get-city');       
            var places = country.attr('data-get-place');       
            var hotels = country.attr('data-get-hotel'); 
            var rooms  = country.attr('data-get-room');
            var index  = country.attr('data-get-index');

            var replacedDiv = country.attr('data-get-replacedDiv'); 

                        if(index == null)
                        {
                            var replacedDivTwo = replacedDiv;
                        }
                        else {
                            var replacedDivTwo = replacedDiv+"_"+index
                        }
                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/cities",
                data: "country_id="+country_id+"&cities="+cities+"&places="+places+"&hotels="+hotels+"&rooms="+rooms+"&replacedDiv="+replacedDiv+"&index="+index,

                
                success: function(response){
                   $("#"+replacedDivTwo).html(response);
                    $("#"+replacedDiv).show();
                }
            });             
        });


    });

// function to get the cities , drivers , tax form country att transports order
$(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.transport_country_id', function(){                
            var country =  $(this);
            var country_id = country.val();
            var cities = country.attr('data-get-city');       
            var drivers = country.attr('data-get-driver');       
            var tax = country.attr('data-get-tax');       
            var index = country.attr('data-get-index');
            var replacedDiv = country.attr('data-get-replacedDiv'); 

                      
                      
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/cities",
                data: "country_id="+country_id+"&cities="+cities+"&drivers="+drivers+"&tax="+tax+"&replacedDiv="+replacedDiv+"&index="+index,

                success: function(response){
                    // from city
                    var from_city = $(response).find("#td_from_city_"+index);
                    $("#td_from_city_"+index).html(from_city);
                    // to city
                    var to_city = $(response).find("#td_to_city_"+index);
                    $("#td_to_city_"+index).html(to_city);
                    // driver
                    var driver = $(response).find("#td_driver_"+index);
                    $("#td_driver_"+index).html(driver);
                    // tax
                    var tax = $(response).find("#transport_tax_"+index);
                    $("#transport_tax_"+index).html(tax);

                    //$("#transports-table").trigger('reflow')
                }
            });             
        });
        });


// function to get the cities and tax form country att manual hotel order
$(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.manual_hotel_country_id', function(){                
            var country =  $(this);
            var country_id = country.val();
            var cities = country.attr('data-get-city');       
            var tax = country.attr('data-get-tax');       
            var index = country.attr('data-get-index');
            var replacedDiv = country.attr('data-get-replacedDiv'); 

                      
                      
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/cities",
                data: "country_id="+country_id+"&cities="+cities+"&tax="+tax+"&replacedDiv="+replacedDiv+"&index="+index,

                success: function(response){
                    // from city
                    var from_city = $(response).find("#country_manual_hotel_order_"+index);
                    $("#country_manual_hotel_order_"+index).html(from_city);
                   
                    // tax
                    var tax = $(response).find("#manual_hotel_tax_"+index);
                    $("#manual_hotel_tax_"+index).html(tax);
                   // alert(tax);

                    //$("#transports-table").trigger('reflow')
                }
            });             
        });
        });


// function to get the cities and tax form country at the flights order
$(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.flights_order_country_id', function(){                
            var country =  $(this);
            var country_id = country.val();
            var cities = country.attr('data-get-city');       
            var tax = country.attr('data-get-tax');       
            var index = country.attr('data-get-index');
            var replacedDiv = country.attr('data-get-replacedDiv'); 

                      
                      
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/cities",
                data: "country_id="+country_id+"&cities="+cities+"&tax="+tax+"&replacedDiv="+replacedDiv+"&index="+index,

                success: function(response){
                    // from city
                    var from_city = $(response).find("#from_country_flight_order_"+index);
                    $("#from_country_flight_order_"+index).html(from_city);
                   
                    // tax
                    var tax = $(response).find("#flights_tax_"+index);
                    $("#flights_tax_"+index).html(tax);
                   // alert(tax);

                    //$("#transports-table").trigger('reflow')
                }
            });             
        });
        });

// function to get the cities and tax form country at the hotels order
$(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.hotels_order_country_id', function(){                
            var country =  $(this);
            var country_id = country.val();
            var cities = country.attr('data-get-city');       
            var tax = country.attr('data-get-tax');       
            var index = country.attr('data-get-index');
            var replacedDiv = country.attr('data-get-replacedDiv'); 

                      
                      
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/cities",
                data: "country_id="+country_id+"&cities="+cities+"&tax="+tax+"&replacedDiv="+replacedDiv+"&index="+index,

                success: function(response){
                    // from city
                    var from_city = $(response).find("#country_hotel_order_"+index);
                    $("#country_hotel_order_"+index).html(from_city);
                   
                    // tax
                    var tax = $(response).find("#hotels_tax_"+index);
                    $("#hotels_tax_"+index).html(tax);
                   // alert(tax);

                    //$("#transports-table").trigger('reflow')
                }
            });             
        });
        });



 $(document).ready(function(){                


             // when any option from city list is selected
        $('body').on('change','.city_id', function(){                
            var city =  $(this);
            // get the selected option value of city

            var city_id = city.val();
            var places = city.attr('data-get-place');       
            var hotels = city.attr('data-get-hotel'); 
            var rooms = city.attr('data-get-room'); 
            var travels = city.attr('data-get-travel');
            var source = city.attr('data-get-source');
            var index = city.attr('data-get-index');
            var replacedDiv = city.attr('data-get-replacedDiv'); 


                        if(index == null)
                        {
                            var replacedDivTwo = replacedDiv;
                        }
                        else {
                            var replacedDivTwo = replacedDiv+"_"+index;
                        }      
                        
                     
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/places",
                data: "city_id="+city_id+"&places="+places+"&hotels="+hotels+"&rooms="+rooms+"&travels="+travels+"&replacedDiv="+replacedDiv+"&index="+index+"&source="+source,

                
                success: function(response){
                    $("#"+replacedDivTwo).html(response);
                    $("#"+replacedDivTwo).show();
                }
            });             
        });
    });


// ajax to get the source name like travel or bus stastion from the city and the source type

 $(document).ready(function(){                


             // when any option from city list is selected
        $('body').on('change','.source_type', function(){                
            var source =  $(this);
            // get the selected option value of source

            var source_type = source.val();
            var city_id = source.attr('city_id');       
            var index = source.attr('data-get-index');
            var replacedDiv = source.attr('data-get-replacedDiv'); 


                        if(index == null)
                        {
                            var replacedDivTwo = replacedDiv;
                        }
                        else {
                            var replacedDivTwo = replacedDiv+"_"+index;
                        }      
                        
                     
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/places",
                data: "city_id="+city_id+"&replacedDiv="+replacedDiv+"&index="+index+"&source_type="+source_type,

                
                success: function(response){
                    $("#"+replacedDivTwo).html(response);
                    $("#"+replacedDivTwo).show();
                }
            });             
        });
    });

// hotel ajax 

 $(document).ready(function(){                


             // when any option from hotel list is selected
        $('body').on('change','.hotel_id', function(){                
            var hotel =  $(this);
            // get the selected option value of hotel

            var hotel_id = hotel.val();
            var rooms = hotel.attr('data-get-room'); 
            var index = hotel.attr('data-get-index'); 
            var replacedDiv = hotel.attr('data-get-replacedDiv'); 

            if(index == null)   {
                var replacedDivTwo = replacedDiv;
            }
            else {
                var replacedDivTwo = replacedDiv+"_"+index;
            }        
                        
           
                
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/country/hotels",
                data: "hotel_id="+hotel_id+"&rooms="+rooms+"&replacedDiv="+replacedDiv+"&index="+index,

                
                success: function(response){
                    $("#"+replacedDivTwo).html(response);
                    $("#"+replacedDivTwo).show();
                }
            });             
        });
    });


// branch ajax

 $(document).ready(function(){                


             // when any option from hotel list is selected
        $('body').on('change','.branch_id', function(){                
            var branch =  $(this);
            // get the selected option value of branch

            var branch_id = branch.val();
            var accounts = branch.attr('data-get-account'); 
            var replacedDiv = branch.attr('data-get-replacedDiv');       
                        
           
                
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/branches/branch",
                data: "branch_id="+branch_id+"&accounts="+accounts+"&replacedDiv="+replacedDiv,

                
                success: function(response){
                    $("#"+replacedDiv).html(response);
                    $("#"+replacedDiv).show();
                }
            });             
        });
    });



// add row ajax

 $(document).ready(function(){                

        $('body').on('click','.add_row', function(){                
            
            var type = $(this).attr('data-row-type'); 
            var replacedDiv = $(this).attr('data-get-replacedDiv');

            var index = $("#"+replacedDiv).data('index');
                if(index == null) {
                    index = 0;
                } else {
                    index+=1;
                }       
           // console.log("index = "+index);              
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/add_rows/add_row",
                data: "type="+type+"&replacedDiv="+replacedDiv+"&index="+index,

                success: function(response){
                    $("#"+replacedDiv).after(response);
                    $("#"+replacedDiv).show();
                }
            });             
        });
    });

 // add row ajax

 $(document).ready(function(){                

        $('body').on('click','.add_package_row', function(){                
            
            var type = $(this).attr('data-row-type'); 
            var replacedDiv = $(this).attr('data-get-replacedDiv');

            var index = $("#"+replacedDiv).data('index');
                if(index == null) {
                    index = 0;
                } else {
                    index+=1;
                }       
           // console.log("index = "+index);              
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/add_rows/add_package_row",
                data: "type="+type+"&replacedDiv="+replacedDiv+"&index="+index,

                success: function(response){
                    $("#"+replacedDiv).after(response);
                    $("#"+replacedDiv).show();
                }
            });             
        });
    });


 // store customer info  ajax

 $(document).ready(function(){                

    // submit the customer data and get this customer code selected               
        $('#btn_customer').on('click', function (e) {


          e.preventDefault();
          $.ajax({
            type: 'POST',
            url: __baseUrl+"/erp/ajax/customers/customer",
            data: $('#customer_form').serialize(),
            success: function (result) {
                if($.isEmptyObject(result.error)){
                    //$(".print-error-msg").hide();
                    $("#"+'customer_code').html(result);
                    $("#"+'add_customer').hide();
                    $("."+'modal-backdrop').hide();
                }
                else{
                    $(".print-error-msg").show();
                    printErrorMsg(result.error);
                }

            },
            error: function (result) {
                    alert('An error occurred.');

            },

          });
                        
           
        });
    });

 function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }




 // get the hotel price ajax

 $(document).ready(function(){                

    // when select the auto option get the price for the selected hotel

        $('body').on('change','.hotels_price_type', function (e) {
            var price =  $(this);


            var price_type = price.val();
            var index = price.attr('data-get-index'); 
            if(price_type == "auto"){

                $.ajax({
                    type: 'GET',
                    url: __baseUrl+"/erp/ajax/prices/hotels",
                    data: $(".hotels_order_price_"+index).serialize()+"&index="+index,
                    success: function (result) {
                        if($.isEmptyObject(result.error) && $.isEmptyObject(result.no_price)){
                           // alert(result.success);
                            document.getElementById("hotel_room_price_"+index).value = result.success;
                            document.getElementById("hotel_room_price_"+index).disabled = false;
                            $("#hotel_room_price_"+index).focus() ;

                        }else if($.isEmptyObject(result.error)){

                            alert(result.no_price);
                            document.getElementById("hotels_price_type_"+index).value = "manual";
                            document.getElementById("hotel_room_price_"+index).disabled = false;
                            document.getElementById("hotel_actual_price_"+index).disabled= false;
                            document.getElementById("hotel_final_price_"+index).disabled = false;

                        }else{
                            alert(result.error)
                        }

                    },
                    error: function (result) {
                            alert('An error occurred.');

                    },

                });

            }else{

            document.getElementById("hotel_room_price_"+index).disabled = false;
            document.getElementById("hotel_actual_price_"+index).disabled = false;
            document.getElementById("hotel_final_price_"+index).disabled = false;

                //$("#hotel_room_price_"+index).disabled = false;
            }

         
                                   
        });
    });



 // get the flight price ajax

 $(document).ready(function(){                

    // when select the auto option get the price for the selected flight

        $('body').on('change','.flights_price_type', function (e) {
            var price =  $(this);


            var price_type = price.val();
            var index = price.attr('data-get-index'); 
            if(price_type == "auto"){

                $.ajax({
                    type: 'GET',
                    url: __baseUrl+"/erp/ajax/prices/flights",
                    data: $(".flights_order_price_"+index).serialize()+"&index="+index,
                    success: function (result) {
                        if($.isEmptyObject(result.error) && $.isEmptyObject(result.no_price)){
                           // alert(result.success);
                            document.getElementById("flights_adult_price_"+index).value = result.success.price_adult;
                            document.getElementById("flights_chlid_price_"+index).value = result.success.price_child;
                            document.getElementById("flights_infant_price_"+index).value = result.success.price_infant;

                            $("#flights_final_price_"+index).focus() ;

                        }else if($.isEmptyObject(result.error)){

                            alert(result.no_price);
                            document.getElementById("flights_price_type_"+index).value ="manual";

                        }else{
                            alert(result.error)
                        }

                    },
                    error: function (result) {
                            alert('An error occurred.');

                    },

                });

            }else{


                //$("#hotel_room_price_"+index).disabled = false;
            }

         
                                   
        });
    });



 // get the transport price ajax

 $(document).ready(function(){                

    // when select the auto option get the price for the selected transport

        $('body').on('change','.transports_price_type', function (e) {
            var price =  $(this);


            var price_type = price.val();
            var index = price.attr('data-get-index'); 
            if(price_type == "auto"){

                $.ajax({
                    type: 'GET',
                    url: __baseUrl+"/erp/ajax/prices/transports",
                    data: $(".transports_order_price_"+index).serialize()+"&index="+index,
                    success: function (result) {
                        if($.isEmptyObject(result.error) && $.isEmptyObject(result.no_price)){
                           // alert(result.success);
                            document.getElementById("transports_final_price_"+index).value = result.success.price;
                            document.getElementById("transports_actual_price_"+index).value = result.success.cost;

                            $("#transports_final_price_"+index).focus() ;

                        }else if($.isEmptyObject(result.error)){

                            alert(result.no_price);
                            document.getElementById("transports_price_type_"+index).value ="manual";
                            $("#transports_final_price_"+index).focus() ;

                            
                        }else{
                            alert(result.error)
                        }

                    },
                    error: function (result) {
                            alert('An error occurred.');

                    },

                });

            }else{
                $("#transports_final_price_"+index).focus() ;


            }

         
                                   
        });
    });



 // Filters ajax

// ajax to get the cities from the country id



// ajax to get the cities from the country id

 $(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.from_country_filter', function(){                
            var country =  $(this);
            var country_id = $("#from_country_id").val();                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/filters/cities",
                data: "country_id="+country_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var from_city = $('#from_city_id');
                        if(from_city.prop) {
                          var options_from = from_city.prop('options');
                        }
                        else {
                          var options_from = from_city.attr('options');
                        }
                        $('option', from_city).remove();

                        var to_city = $('#to_city_id');
                        if(to_city.prop) {
                          var options_to = to_city.prop('options');
                        }
                        else {
                          var options_to = to_city.attr('options');
                        }
                        $('option', to_city).remove();

                        $.each(result.success, function(val, text) {
                            options_from[options_from.length] = new Option(text, val);
                            options_to[options_to.length] = new Option(text, val);
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


// ajax to get the cities from the country id

 $(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.country_id_filter', function(){                
            var country =  $(this);
            var country_id = $("#country_id").val();                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/filters/cities",
                data: "country_id="+country_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var from_city = $('#from_city_id');
                        if(from_city.prop) {
                          var options_from = from_city.prop('options');
                        }
                        else {
                          var options_from = from_city.attr('options');
                        }
                        $('option', from_city).remove();

                        var to_city = $('#to_city_id');
                        if(to_city.prop) {
                          var options_to = to_city.prop('options');
                        }
                        else {
                          var options_to = to_city.attr('options');
                        }
                        $('option', to_city).remove();

                        $.each(result.success, function(val, text) {
                            options_from[options_from.length] = new Option(text, val);
                            options_to[options_to.length] = new Option(text, val);
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


// ajax to get the cities from the country id

 $(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.to_country_filter', function(){                
            var country =  $(this);
            var country_id = $("#to_country_id").val();                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/filters/cities",
                data: "country_id="+country_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var select = $('#to_city_id');
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



// ajax to get the hotels from the city id

 $(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.hotel_filter', function(){                
            var city =  $(this);
            var city_id = $("#city_id").val();                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/filters/hotels",
                data: "city_id="+city_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var select = $('#hotel_id');
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



// ajax to get the hotels from the city id

 $(document).ready(function(){                
        // when any option from country list is selected
        $('body').on('change','.room_filter', function(){                
            var hotel =  $(this);
            var hotel_id = $("#hotel_id").val();                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/filters/rooms",
                data: "hotel_id="+hotel_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var select = $('#room_id');
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




// ajax to get the source name when choose the source on the filters   

 $(document).ready(function(){                
        $('body').on('change','.source_filter', function(){ 

            var source = $("#from_source").val();                        
            var city_id = $("#from_city_id").val();                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/filters/sources",
                data: "source="+source+"&from_city_id="+city_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var select = $('#source_name');
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





// ajax to get the target name when choose the target type on the filters   

 $(document).ready(function(){                
        $('body').on('change','.target_filter', function(){ 

            var source = $("#to_source").val();                        
            var city_id = $("#to_city_id").val();                        
            $.ajax({
                type: "GET",
                url: __baseUrl+"/erp/ajax/filters/targets",
                data: "source="+source+"&to_city_id="+city_id,
                success: function(result){
                    if($.isEmptyObject(result.error) ){

                        var select = $('#target_name');
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




