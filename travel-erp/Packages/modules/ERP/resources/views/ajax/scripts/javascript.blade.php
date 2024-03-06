<script>

	$('.select_multiple').select2();


    $("#accordion").accordion();


function tour_disable()
{
var e = document.getElementById("to_source");
var value = e.options[e.selectedIndex].value;

if(value != 'tour')
  document.getElementById("travel").disabled = true;

else
    document.getElementById("travel").disabled = false;

 
}

function acc_disable()
{
var e = document.getElementById("account_type");
var value = e.options[e.selectedIndex].value;

if(value != 'sub')
  document.getElementById("parent_id").disabled = true;

else
    document.getElementById("parent_id").disabled = false;

 
}

function flight_toggle_hide(index)
{
var e = document.getElementById("transporter_type_"+index);
var value = e.options[e.selectedIndex].value;
var index = index;
//alert("#type_ferry_"+index);

if(value == 'flight'){
  $("#type_airline_"+index).show();
  $("#type_ferry_"+index).hide();
}
else{
  $("#type_ferry_"+index).removeClass('hidden');
  $("#type_ferry_"+index).show();
  $("#type_airline_"+index).hide();
}
 
}

function getDateObject(str) {
      var arr = str.split("-");
      return new Date(arr[0], arr[1], arr[2]);
}

$('body').on('change','#hotels_leave_date', function (e){


    var index = $(this).attr('data-get-index');


    var leave_date = $(this).val();

    var entry_date = $("#hotels_entry_date_"+index).val();

    var  validation = window.translations = {
        entry_date: '{{ trans('ERP::attributes.validation.entry_date') }}',
        leave_entry: '{{ trans('ERP::attributes.validation.leave_entry') }}',
      };

 
    if(entry_date){
      if(leave_date >= entry_date){
         var entry_date = getDateObject(entry_date);
         var leave_date = getDateObject(leave_date);
      
      var days =Math.round((leave_date - entry_date) / (1000*60*60*24));
      if(days ==0)
      {
        days = 1;
      }
      document.getElementById("hotels_days_numbers_"+index).value = days;

      }else{
        alert(validation.leave_entry);

      }
     

    }else{
       
      alert(validation.entry_date);
    }


});

// function to get the final price for the hotel order 

$('body').on('focusout','.hotels_room_price', function (e){


    var index = $(this).attr('data-get-index');


    var room_price = $(this).val();

    var rooms_numbers = $("#hotels_rooms_numbers_"+index).val();
    var days_numbers  = $("#hotels_days_numbers_"+index).val();
    //alert(rooms_numbers);
    //alert(days_numbers);

    var  validation = window.translations = {
        rooms_numbers: '{{ trans('ERP::attributes.validation.rooms_numbers') }}',
        days_numbers: '{{ trans('ERP::attributes.validation.days_numbers') }}',
      };

 
    if(rooms_numbers){
      if(days_numbers){
         
      
      var final_price =(room_price*rooms_numbers*days_numbers);
      //alert(final_price);
      document.getElementById("hotel_final_price_"+index).value = final_price;

      }else{
        alert(validation.days_numbers);
        $("#hotels_days_numbers_"+index).focus();

      }
     

    }else{
       
      alert(validation.rooms_numbers);
      $("#hotels_rooms_numbers_"+index).focus();
    }


});


// function to get the final price for the flight order 

$('body').on('focus','.flights_final_price', function (e){


    var index = $(this).attr('data-get-index');


    //var room_price = $(this).val();

    var adult_numbers  = $("#flights_adult_numbers_"+index).val();
    var chlid_numbers  = $("#flights_chlid_numbers_"+index).val();
    var infant_numbers = $("#flights_infant_numbers_"+index).val();
    var adult_price    = $("#flights_adult_price_"+index).val();
    var chlid_price    = $("#flights_chlid_price_"+index).val();
    var infant_price   = $("#flights_infant_price_"+index).val();

    //var days_numbers  = $("#hotels_days_numbers_"+index).val();
    //alert(rooms_numbers);
    //alert(days_numbers);

    var  validation = window.translations = {
        adult_numbers:  '{{ trans('ERP::attributes.validation.adult_numbers') }}',
        chlid_numbers:  '{{ trans('ERP::attributes.validation.chlid_numbers') }}',
        infant_numbers: '{{ trans('ERP::attributes.validation.infant_numbers') }}',
        adult_price:    '{{ trans('ERP::attributes.validation.adult_price') }}',
        chlid_price:    '{{ trans('ERP::attributes.validation.chlid_price') }}',
        infant_price:   '{{ trans('ERP::attributes.validation.infant_price') }}',
      };

    if(!adult_numbers){
        alert(validation.adult_numbers);
        $("#flights_adult_numbers_"+index).focus();

    }else if(!chlid_numbers){
        alert(validation.chlid_numbers);
        $("#flights_chlid_numbers_"+index).focus();


    }else if(!infant_numbers){
        alert(validation.infant_numbers);
        $("#flights_infant_numbers_"+index).focus();

      
    }else if(!adult_price){
        alert(validation.adult_price);
        $("#flights_adult_price_"+index).focus();
      
    }else if(!chlid_price){
        alert(validation.chlid_price);
        $("#flights_chlid_price_"+index).focus();

      
    }else if(!infant_price){
        alert(validation.infant_price);
        $("#flights_infant_price_"+index).focus();

      
    }else{
      var final_price =(adult_numbers*adult_price)+(chlid_numbers*chlid_price)+(infant_numbers*infant_price);
      //alert(final_price);
      document.getElementById("flights_final_price_"+index).value = final_price;

    }

    if(rooms_numbers){
      if(days_numbers){
         
      
      var final_price =(room_price*rooms_numbers*days_numbers);
      //alert(final_price);
      document.getElementById("hotel_final_price_"+index).value = final_price;

      }else{
        alert(validation.days_numbers);

      }
     

    }else{
       
      alert(validation.rooms_numbers);
    }


});




























// (function() {
//    var button=document.getElementById("addMore");
//    button.addEventListener('click', function(event) {
//       event.preventDefault();
//       var cln = document.getElementsByClassName("date")[0].cloneNode(true);
//       document.getElementById("dates").insertBefore(cln,this);
//       return false;
//    });
// })();

 

//     var i= 1;

// 	$(function() {
//   	$("#addMore").click(function(e) {
//     e.preventDefault();
//      i=i+1;
//     var html = "<div class='row'>"+
//                             "<div class='col-md-4'>"+
//                               " <div class='form-group   required-field '><label for='from_date'>ERP::attributes.hotelprice.from_date</label><input class='form-control ' placeholder='ERP::attributes.hotelprice.from_date' id='from_date' name='dates[][from_date]' type='date'></div>" 
//                             +"</div>"+
//                             "<div class='col-md-4'>"+
//                               " <div class='form-group   required-field '><label for='to_date'>ERP::attributes.hotelprice.to_date</label><input class='form-control ' placeholder='ERP::attributes.hotelprice.to_date' id='to_date' name='dates[to_date][]' type='date'></div>"
//                             +"</div>"+
                           
//                          "</div>";

//     $("#dates").append(html);
//   });
// });

</script>