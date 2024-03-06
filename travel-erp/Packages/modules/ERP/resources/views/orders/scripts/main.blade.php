<script type="text/javascript">



    function doGeoLists(elem, data){

   if($(elem).data('item_type') === 'countries'){
    	var currencyDivId = '#'+$(this).data('currency_div_id');
    	var currencyId = $('option:selected', this).data('currency');
    	$(currencyDivId).val(currencyId).trigger('change');
			var currentCurrencyRate = $('option:selected', currencyDivId).data('rate');
			var modRateInput = $(currencyDivId).closest('.row').find('.mod-exchange-rate').val(currentCurrencyRate);
			var origRateInput = $(currencyDivId).closest('.row').find('.orig-exchange-rate').val(currentCurrencyRate);
			// var mainCurrencyInput = $(currencyDivId).closest('.row').find('.main-currency-id').val(currencyId);

    } 

    } //end func


function getNumber(number, defaultNumber = 1) {
    return isNaN(Number(number)) ? defaultNumber : Number(number);
}
function getModDate(dateStr, duration, plus) {


  var date = new Date(dateStr);
  if(isNaN(duration) || duration < 0){

  	duration = 0;

  }
  
  if(plus){

  	date.setDate(date.getDate() + parseInt(duration, 10));

  }else{

  	date.setDate(date.getDate() - parseInt(duration, 10));

  }

  function pad(s) { return (s < 10) ? '0' + s : s; }
  return [ date.getFullYear(), pad(date.getMonth()+1), pad(date.getDate())].join('-');
 
}

function getDiffDates(dateStr_1, dateStr_2) {
	    var diff = Date.parse( dateStr_2 ) - Date.parse( dateStr_1 );
	   //  {
    //     diff : diff,
    //     ms : Math.floor( diff            % 1000 ),
    //     s  : Math.floor( diff /     1000 %   60 ),
    //     m  : Math.floor( diff /    60000 %   60 ),
    //     h  : Math.floor( diff /  3600000 %   24 ),
    //     d  : Math.floor( diff / 86400000        )
    // }; 
    return isNaN( diff ) ? NaN : Math.floor( diff / 86400000);

}


</script>

<script type="text/javascript">
	

		$('body').on('change', '#destination_id', function(){

			var currencyId = $('option:selected', this).data('currency');
			$('#currency_id').val(currencyId).trigger('change');
			var currentCurrencyRate = $('option:selected', '#currency_id').data('rate');
			var modRateInput = $('#currency_id').closest('.row').find('.mod-exchange-rate').val(currentCurrencyRate);
			var origRateInput = $('#currency_id').closest('.row').find('.orig-exchange-rate').val(currentCurrencyRate);

			
		}); 

		


</script>

<script type="text/javascript">
	$(document).ready(function () {

		$('body').on('change', '.get-currency-rate', function(){

			var currencyId = $(this).val();
			var currentCurrencyRate = $('option:selected', this).data('rate');
			$(this).closest('.row').find('.mod-exchange-rate').val(currentCurrencyRate);
			$(this).closest('.row').find('.orig-exchange-rate').val(currentCurrencyRate);
			$(this).closest('.row').find('.orig-currency-id').val(currencyId);

		});

		});


</script>


<script type="text/javascript">
		$(document).ready(function () {

		$('body').on('dp.change','#general_data_start_date', function(e){

			var startDateValue = e.date;
			var durationInput = $('#order_duration_value');
			if(isNaN(durationInput.val()) || durationInput.val() < 1){
				durationInput.val(1);
			}
			var endDate = getModDate(startDateValue, (durationInput.val() - 1), true);
			var endDateInput = $('#general_data_end_date');
            endDateInput.val(endDate);
            chickInOutChanged();
            itemStartDateChange();

		});

		});
</script>

<script type="text/javascript">
		$(document).ready(function () {

		$('body').on('dp.change','#general_data_end_date', function(e){

			var endDateValue = e.date;
			var startDate = $('#general_data_start_date');
			var durationInput = $('#order_duration_value');
			if(isNaN(durationInput.val()) || durationInput.val() < 1){
				durationInput.val(1);
			}

			var newDuration = 1;

			getDuration = getDiffDates(startDate.val(), endDateValue);

			newDuration = getDuration + 2;


			if(newDuration < -1){
				$('#general_data_end_date').val(startDate.val());
				newDuration = 1;

				alert('End date can not be less than Start date');

			}

			if(newDuration < 1){
				newDuration = 1;

			}

			durationInput.val(newDuration);
            durationChanged(startDate.val(), newDuration);
            chickInOutChanged();
            itemStartDateChange();
            calculateAllHotelsPrices();

		});

		});
</script>

<script type="text/javascript">
		$(document).ready(function () {

		$('body').on('change', '#order_duration_value', function(e){

			

			var durationInput = $(this);
			var startDate = $('#general_data_start_date');
			if(isNaN(durationInput.val()) || durationInput.val() < 1){
				durationInput.val(1);
			}

			var endDate = getModDate(startDate.val(), (durationInput.val() - 1), true);
			var endDateInput = $('#general_data_end_date');
            endDateInput.val(endDate);

            durationChanged(startDate.val(), durationInput.val());
            chickInOutChanged();
            itemStartDateChange();
            calculateAllHotelsPrices();

		});

		});
</script>

<script type="text/javascript">
	function durationChanged(startDateValue, duration){
        var selectOrderDays = $(".order-days");
        selectOrderDays.html('');
		for (var i = 1; i <= duration; i++) {
		selectOrderDays.append(new Option(i, i));	
		}

		errorArray = [];

		$('.order-days').each(function(i, elem) {
			var old_input = $(elem).closest('.day-row').find('.hidden_day_val');
			
			if(old_input.val() > duration){
				old_input.val(duration);
				$(elem).val(duration).trigger('change');
				errorArray.push('alert');

				
			}else{
				$(elem).val(old_input.val());
			}


			 });
		if(errorArray.includes('alert')){
			alert('{{__('ERP::messages.orders.must_rest_program')}}');
				
			}

			errorArray = [];
		
	}
</script>

{{-- start Date changed --}}



<script type="text/javascript">
	function itemStartDateChange(){

		var startDateStr = $('#general_data_start_date').val();

		$('.general-row').each(function(i, elem) {
		var day_input = $(elem).find('.order-days');
	
		var rowStartDate = getModDate(startDateStr, (day_input.val() - 1), true);

        $(elem).find('.start-date-input').val(rowStartDate);

         });
		
	}
</script>

<script type="text/javascript">
	function chickInOutChanged(){

		var startDateStr = $('#general_data_start_date').val();

		$('.hotel-row').each(function(i, elem) {
		var day_input = $(elem).closest('.hotel-row').find('.order-days');
		var nightsNum = $(elem).closest('.hotel-row').find('.nights-num');
		var checkInDate = getModDate(startDateStr, (day_input.val() - 1), true);
        var checkInInput = $(elem).closest('.hotel-row').find('.checkin-input');
        checkInInput.val(checkInDate);
        var checkOutDate = getModDate(checkInInput.val(), (nightsNum.val()), true);
        var checkOutInput = $(elem).closest('.hotel-row').find('.checkout-input');
        checkOutInput.val(checkOutDate);
        // checkDatesForEndDate(checkOutInput.val());
        calculateAllHotelsPrices();

         });
		

	}
</script>

<script type="text/javascript">
	function checkDatesForEndDate(date){


     var endDate = $('#general_data_end_date').val();

     var remains = getDiffDates(date, endDate);


	  if(remains < -1){

		alert('{{__('ERP::messages.orders.date_less_than_end_date')}}');

		}


      return remains;



	}
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$('body').on('change', '.general-day', function(){

		var startDateStr = $('#general_data_start_date').val();

        var day_input = $(this).closest('.general-row').find('.order-days');

           $(this).closest('.general-row').find('.hidden_day_val').val(day_input.val());

		var startDate = getModDate(startDateStr, (day_input.val() - 1), true);
		$(this).closest('.general-row').find('.start-date-input').val(startDate);

		});
		 });
		</script>

<script type="text/javascript">
		$('body').on('change', '.hotel-day', function(){

		var startDateStr = $('#general_data_start_date').val();

        var day_input = $(this).closest('.hotel-row').find('.order-days');
           $(this).closest('.hotel-row').find('.hidden_day_val').val(day_input.val());
		var nightsNum = $(this).closest('.hotel-row').find('.nights-num');
		var checkInDate = getModDate(startDateStr, (day_input.val() - 1), true);
        var checkInInput = $(this).closest('.hotel-row').find('.checkin-input');
        checkInInput.val(checkInDate);
        var checkOutDate = getModDate(checkInInput.val(), (nightsNum.val()), true);
        var checkOutInput = $(this).closest('.hotel-row').find('.checkout-input');
        checkOutInput.val(checkOutDate);
        calculateHotelPrice(this);
        checkDatesForEndDate(checkOutInput.val());


		});

		$('body').on('change','.nights-num', function(){

		var nightsNum = $(this);
		
        var checkInInput = $(this).closest('.hotel-row').find('.checkin-input');
        var checkOutDate = getModDate(checkInInput.val(), (nightsNum.val()), true);
        var checkOutInput = $(this).closest('.hotel-row').find('.checkout-input');
        checkOutInput.val(checkOutDate);
        checkDatesForEndDate(checkOutInput.val());


		});

		$('body').on('dp.change', '.checkout-input', function(e){


			var checkoutValue = e.date;
			checkDatesForEndDate(checkoutValue);
			var checkInInput = $(this).closest('.hotel-row').find('.checkin-input');
			var nightsNum = $(this).closest('.hotel-row').find('.nights-num');
			if(isNaN(nightsNum.val()) || nightsNum.val() < 1){
				nightsNum.val(1);
			}

			var newNightsNum = 1;

			newNightsNum = getDiffDates(checkInInput.val(), checkoutValue);


			if(newNightsNum < -1){
				$(this).val(checkInInput.val());

				alert('Checkout date can not be less than Chickin date');

			}

			if(newNightsNum < 1){
				newNightsNum = 1;

			}

			nightsNum.val(newNightsNum);



		});



</script>



<script type="text/javascript">
		$('body').on('click', '.get-auto-hotel-prices', function(){
			var type = $(this).closest('.hotel-row').find('.hotel_price_type').val();
			if(type === 'auto'){

				getHotelAutoPrices(this, false);

			}else{
				getHotelAutoPrices(this, true);
			}
			
		});
</script>

<script type="text/javascript">
		$('body').on('change', '.hotel_price_type', function(){
			var type = $(this).val();

			if(type === 'auto'){

				getHotelAutoPrices(this, false);
			}else{
			$(this).closest('.hotel-row').find('.room-price').removeAttr('readonly');
			$(this).closest('.hotel-row').find('.room-cost').removeAttr('readonly');	
			$(this).closest('.hotel-row').find('.extra-bed-price').removeAttr('readonly');
			$(this).closest('.hotel-row').find('.extra-bed-cost').removeAttr('readonly');
			}

		});
</script>


<script type="text/javascript">
	$(document).ready(function () {

		$('body').on('keyup', '.price_input_group', function(){
			

        calculateHotelPrice(this);
			
		}); 

		});

	function calculateAllHotelsPrices(){

		$('.hotel-row').each(function(i, elem) {

			calculateHotelPrice(elem);


			}); 
	}

 function calculateHotelPrice(elem){
 	
 	var price = $(elem).closest('.hotel-row').find('.room-price').val();
 	var cost = $(elem).closest('.hotel-row').find('.room-cost').val();

 	var rooms = $(elem).closest('.hotel-row').find('.rooms-number').val();
 	var nights = $(elem).closest('.hotel-row').find('.nights-num').val();
 	var extraBeds = $(elem).closest('.hotel-row').find('.extra-beds').val();
 	var extraBedPrice = $(elem).closest('.hotel-row').find('.extra-bed-price').val();
 	var extraBedCost = $(elem).closest('.hotel-row').find('.extra-bed-cost').val();
 	var totalExtraBedPriceInput = $(elem).closest('.hotel-row').find('.total-extra-beds-prices');
 	var totalExtraBedCostInput = $(elem).closest('.hotel-row').find('.total-extra-beds-costs');
 	var totalPriceInput = $(elem).closest('.hotel-row').find('.hotel-total-price');
 	var totalCostInput = $(elem).closest('.hotel-row').find('.hotel-total-cost');

 	calTotalPrice = (getNumber(price) * getNumber(rooms) * getNumber(nights)) + (getNumber(extraBeds) * getNumber(extraBedPrice));

    calTotalCost = (getNumber(cost) * getNumber(rooms) * getNumber(nights)) + (getNumber(extraBeds) * getNumber(extraBedCost));		

 	calTotalExtraBedPrices = (getNumber(extraBeds) * getNumber(extraBedPrice));
 	calTotalExtraBedCosts = (getNumber(extraBeds) * getNumber(extraBedCost));
 	totalExtraBedPriceInput.val(calTotalExtraBedPrices);
 	totalExtraBedCostInput.val(calTotalExtraBedCosts);
 	totalPriceInput.val(calTotalPrice);
 	totalCostInput.val(calTotalCost);

 }
</script>
<script type="text/javascript">
	 function getHotelAutoPrices(elem, edit = true){

	    var hotel_id = $(elem).closest('.hotel-row').find('.hotel-input').val();
		var room_id = $(elem).closest('.hotel-row').find('.room-input').val();
		var checkin = $(elem).closest('.hotel-row').find('.checkin-input').val();
		


		var dataObj = {hotel_id:hotel_id, room_id: room_id, checkin:checkin};

		    $.ajax({
            method: 'GET',
            data: $.param(dataObj),
            url: '/erp/ajax/hotels/get-hotel-auto-prices',
           
            success: function (result) {

              if(result.success){

              var priceInput = $(elem).closest('.hotel-row').find('.room-price').attr('readonly','readonly');
              priceInput.val(result.data.price);

              var costInput = $(elem).closest('.hotel-row').find('.room-cost').attr('readonly','readonly');
              costInput.val(result.data.cost);

              $(elem).closest('.hotel-row').find('.auto_room_price').val(result.data.price);
              var extraBedInputPrice = $(elem).closest('.hotel-row').find('.extra-bed-price').attr('readonly','readonly');
              $(elem).closest('.hotel-row').find('.auto_extra_bed_price').val(result.data.extra_bed_price);
              extraBedInputPrice.val(result.data.extra_bed_price);

              var extraBedInputCost = $(elem).closest('.hotel-row').find('.extra-bed-cost').attr('readonly','readonly');
              $(elem).closest('.hotel-row').find('.auto_extra_bed_cost').val(result.data.extra_bed_cost);
              extraBedInputCost.val(result.data.extra_bed_cost);


             var currencySelect = $(elem).closest('.hotel-row').find('.get-currency-rate');

             currencySelect.val(result.data.currency_id).trigger('change');

			var currentCurrencyRate = $('option:selected', currencySelect).data('rate');

			var modRateInput = currencySelect.closest('.row').find('.mod-exchange-rate').val(currentCurrencyRate);

			var origRateInput = currencySelect.closest('.row').find('.orig-exchange-rate').val(currentCurrencyRate);
			
			var origCurrencyInput = currencySelect.closest('.row').find('.orig-exchange-id').val(result.data.currency_id);


              if(edit){
              	extraBedInputPrice.removeAttr('readonly');
              	priceInput.removeAttr('readonly');
              	extraBedInputCost.removeAttr('readonly');
              	costInput.removeAttr('readonly');
              }

              	calculateHotelPrice(elem);
                 
               }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });

 	


 }


</script>

<script type="text/javascript">
	
		$('body').on('click', '.new-hotel-row-btn', function(){

		var mainRowId = $(this).data('main_row_id');
		var mainRowClass = $(this).data('main_row_class');
		var mainRowPrefix = $(this).data('main_row_prefix');

		var lastRow = $('#'+mainRowId+' div.'+mainRowClass+':last');
	
		var newIndex = getNumber(lastRow.data('index'), 1) + 1;

		var html = '{!! base64_encode(html_entity_decode(view('ERP::orders.partials.displayeds.hotels')->with(compact('providers', 'countries', 'currencies', 'main_currency', 'roomsTypes'))))!!}';
		function b64DecodeUnicode(str) {

         return decodeURIComponent(atob(str).split('').map(function(c) {
          return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
          }
			var newHtml = b64DecodeUnicode(html);

		var elements = $(newHtml).filter('#get_'+mainRowId).html();
	


		 $('#'+mainRowId).append(elements.replace(/>[\n\t ]+</g, "><").replace(/r0099/gi, newIndex).replace(/with-select3/gi, 'with-select2'));
		  $('.with-select2').select2();
		 $('.datepicker').datetimepicker({
           format: 'YYYY-MM-DD',
         
           });

		 var newRow = $('#'+mainRowPrefix+newIndex);

		 var lastSelectedCountry = lastRow.find('.countries-list');
		 var newSelectedCountry = newRow.find('.countries-list');
		 newSelectedCountry.val(lastSelectedCountry.val()).trigger('change');
		 newSelectedCountry.addClass('get_geo_lists');
		 var lastCitiesListId = lastRow.find('.cities-list').attr('id');
		 var newCitiesList = newRow.find('.cities-list');
		 var optionValues = [];
		 $('#'+lastCitiesListId+' option').each(function() {

    var option = {};
    option['id']  = $(this).val();
    option['text']  = $(this).text();

    optionValues.push(option);

    
});

 newCitiesList.html('').select2({data: optionValues});

			var lastCheckOut = lastRow.find('.checkout-input').val();
			var lastDay = lastRow.find('.hotel-day').val();
			var lastNights = lastRow.find('.nights-num').val();
			var duration = getNumber(lastDay) + getNumber(lastNights);
			var newCheckIn = lastCheckOut; //getModDate(lastCheckOut, duration, true);
			var origDuration = $('#order_duration_value').val();

			if(origDuration < duration){
				newCheckIn = lastCheckOut;
				duration = origDuration;
			}
		
	        var selectOrderDays = newRow.find('.hotel-day');
            selectOrderDays.html('');
		    for (var i = 1; i <= origDuration; i++) {
		      selectOrderDays.append(new Option(i, i));	
		     } 
			newRow.find('.hotel-day').val(newCheckIn);
			newRow.find('.order-days').val(duration).trigger('change');
			newRow.find('.hidden_day_val').val(duration);
		});

		
</script>

<script type="text/javascript">
		$('body').on('click', '.remove-row-btn', function(){
          var rowId = $(this).data('row_id');
          $('#'+rowId).animate({'line-height':0},1000).remove();

		});
	
</script>

<script type="text/javascript">

	$('body').on('click', '.disabled-row-btn', function(){

          disabledRow(this);
          
		});

	function disabledRow(elem){
			var rowId = $(elem).data('row_id');
			if($(elem).hasClass("active")){
				$(elem).removeClass('active');
				$(elem).html('<i class="fa fa-check"></i>');
				$(elem).toggleClass('btn-danger btn-success');
				$('#alert_'+rowId).toggle();
                $('#'+rowId).find('input, textarea, button, select').attr('disabled','disabled');
			}else{
                $(elem).addClass('active');
				$(elem).html('<i class="fa fa-times"></i>');
				$(elem).toggleClass('btn-success btn-danger');
				$('#alert_'+rowId).toggle();
                $('#'+rowId).find('input, textarea, button, select').removeAttr('disabled');

			}
	}
</script>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		$('.disabled-form-inputs').each(function(){
			   	disabledRow(this);
          }, false);

		})

</script>

<script type="text/javascript">
	 function getAutoPrices(elem, data, edit = true){

	 	var item_type = $(elem).data('elem_type');

		var priceAdultInput = $(elem).closest('.general-row').find('.adult_price');
        var costAdultInput = $(elem).closest('.general-row').find('.adult_cost');

        var priceChildInput = $(elem).closest('.general-row').find('.child_price');
        var costChildInput = $(elem).closest('.general-row').find('.child_cost');

        var priceInfantInput = $(elem).closest('.general-row').find('.infant_price');
        var costInfantInput = $(elem).closest('.general-row').find('.infant_cost');

        var priceWeightInput = $(elem).closest('.general-row').find('.baggage_price');
        var costWeightInput = $(elem).closest('.general-row').find('.baggage_cost');


		    $.ajax({
            method: 'GET',
            data: $.param(data),
            url: '/erp/ajax/orders/'+item_type+'/get-all-auto-prices',
           
            success: function (result) {

              if(result.success){

              	if(result.is_classfy){

              	$(elem).closest('.general-row').find('.auto_adult_price').val(result.data.adult_price);
              	$(elem).closest('.general-row').find('.auto_adult_cost').val(result.data.adult_cost);

              	$(elem).closest('.general-row').find('.auto_child_price').val(result.data.child_price);
              	$(elem).closest('.general-row').find('.auto_child_cost').val(result.data.child_cost);

              	$(elem).closest('.general-row').find('.auto_infant_price').val(result.data.infant_price);
              	$(elem).closest('.general-row').find('.auto_infant_cost').val(result.data.infant_cost);

              	$(elem).closest('.general-row').find('.auto_baggage_price').val(result.data.baggage_price);
              	$(elem).closest('.general-row').find('.auto_baggage_cost').val(result.data.baggage_cost);


              	priceAdultInput.attr('readonly','readonly').val(result.data.adult_price);
              	costAdultInput.attr('readonly','readonly').val(result.data.adult_cost);

              	priceChildInput.attr('readonly','readonly').val(result.data.child_price);
              	costChildInput.attr('readonly','readonly').val(result.data.child_cost);

              	priceInfantInput.attr('readonly','readonly').val(result.data.infant_price);
              	costInfantInput.attr('readonly','readonly').val(result.data.infant_cost);

              	priceWeightInput.attr('readonly','readonly').val(result.data.weight_price);
              	costWeightInput.attr('readonly','readonly').val(result.data.weight_cost);

              	if(edit){

              	priceAdultInput.removeAttr('readonly');
              	costAdultInput.removeAttr('readonly');

              	priceChildInput.removeAttr('readonly');
              	costChildInput.removeAttr('readonly');

              	priceInfantInput.removeAttr('readonly');
              	costInfantInput.removeAttr('readonly');

              	priceWeightInput.removeAttr('readonly');
              	costWeightInput.removeAttr('readonly');

              }


              	}else{

              	$(elem).closest('.general-row').find('.auto_price').val(result.data.price);
              	$(elem).closest('.general-row').find('.auto_cost').val(result.data.cost);

              	var priceInput = $(elem).closest('.general-row').find('.price-input').attr('readonly','readonly');
              	var costInput = $(elem).closest('.general-row').find('.cost-input').attr('readonly','readonly');


              	priceInput.val(result.data.price);
              	costInput.val(result.data.cost);

              	if(edit){

              	priceInput.removeAttr('readonly');
              	costInput.removeAttr('readonly');

              }

              
              	}

             var currencySelect = $(elem).closest('.general-row').find('.get-currency-rate');

             currencySelect.val(result.data.currency_id).trigger('change');

			var currentCurrencyRate = $('option:selected', currencySelect).data('rate');

			var modRateInput = currencySelect.closest('.row').find('.mod-exchange-rate').val(currentCurrencyRate);

			var origRateInput = currencySelect.closest('.row').find('.orig-exchange-rate').val(currentCurrencyRate);
			
			var origCurrencyInput = currencySelect.closest('.row').find('.orig-exchange-id').val(result.data.currency_id);

              	calculateOrdersPrices(elem);
                 
               }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });

 	


 }


</script>

<script type="text/javascript">
	$('body').on('keyup', '.general_price_input_group', function(){



		calculateOrdersPrices(this);

	});
	
</script>

<script type="text/javascript">
	function calculateOrdersPrices(elem){

	var is_class_prices = $(elem).closest('.general-row').find('.classfy-prices').val();

		is_classfy = false;

		if(is_class_prices === 'true'){

			is_classfy = true;

		}

		if(is_classfy){

		var priceAdultInput = $(elem).closest('.general-row').find('.adult_price').val();
        var costAdultInput = $(elem).closest('.general-row').find('.adult_cost').val();
        var numberAdultInput = $(elem).closest('.general-row').find('.adult_numbers').val();

        var priceChildInput = $(elem).closest('.general-row').find('.child_price').val();
        var costChildInput = $(elem).closest('.general-row').find('.child_cost').val();
        var numberChildInput = $(elem).closest('.general-row').find('.child_numbers').val();

        var priceInfantInput = $(elem).closest('.general-row').find('.infant_price').val();
        var costInfantInput = $(elem).closest('.general-row').find('.infant_cost').val();
        var numberInfantInput = $(elem).closest('.general-row').find('.infant_numbers').val();

        var priceWeightInput = $(elem).closest('.general-row').find('.baggage_price').val();
        var costWeightInput = $(elem).closest('.general-row').find('.baggage_cost').val();
        var numberWeightInput = $(elem).closest('.general-row').find('.baggage_weight').val();

     var totalPrice = (getNumber(priceAdultInput) * getNumber(numberAdultInput)) + (getNumber(priceChildInput) * getNumber(numberChildInput)) + (getNumber(priceInfantInput) * getNumber(numberInfantInput)) + (getNumber(priceWeightInput) * getNumber(numberWeightInput));

     var totalCost = (getNumber(costAdultInput) * getNumber(numberAdultInput)) + (getNumber(costChildInput) * getNumber(numberChildInput)) + (getNumber(costInfantInput) * getNumber(numberInfantInput)) + (getNumber(costWeightInput) * getNumber(numberWeightInput));


		}else{

		var priceInput = $(elem).closest('.general-row').find('.price-input').val();
        var costInput = $(elem).closest('.general-row').find('.cost-input').val();
        var quantity = $(elem).closest('.general-row').find('.quantity').val();
        var quantity2 = $(elem).closest('.general-row').find('.quantity2').val();
        var totalPrice = getNumber(priceInput)* getNumber(quantity) * getNumber(quantity2);
        var totalCost =  getNumber(costInput) * getNumber(quantity)* getNumber(quantity2);

		}

		$(elem).closest('.general-row').find('.total-price').val(totalPrice);
        $(elem).closest('.general-row').find('.total-cost').val(totalCost);
	}
</script>



<script>

     $('body').on('click', '.get_general_auto_prices', function(){

	   var elem = $(this);
	   var item = elem.closest('.general-row').find('.selected-service').val();
	   var type = elem.data('elem_type');
	   var startDate = elem.closest('.general-row').find('.start-date-input').val();
	   var data = {};

	   if(type === 'flight' || type === 'ferry' ){

	   	data = {type: type, item: item, startDate: startDate, fromCity: elem.closest('.general-row').find('.cities-list_1').val(), toCity: elem.closest('.general-row').find('.to-cities-list_2').val()};

	   }else if(type === 'service' || type === 'activity'){

	   	data = {type: type, item: item, startDate: startDate, city: elem.closest('.general-row').find('.cities-list_1').val()};

	   }else if(type === 'transport'){

	   	data = {type: type, item: item,  startDate: startDate, source: elem.closest('.general-row').find('.source-places-list').val(), target: elem.closest('.general-row').find('.target-places-list').val()};
	   }

	   getAutoPrices(this, data, true);

	  
		});
	
</script>

<script type="text/javascript">
	

		$('body').on('click', '.new-general-row-btn', function(){

		var mainRowId = $(this).data('main_row_id');
		var mainRowClass = $(this).data('main_row_class');
		var mainRowPrefix = $(this).data('main_row_prefix');

		var lastRow = $('#'+mainRowId+' div.'+mainRowClass+':last');
		var newIndex = getNumber(lastRow.data('index'), 1) + 1;

		var html = '{!! base64_encode(html_entity_decode(view('ERP::orders.partials.displayeds.general_rows')->with(compact('providers', 'countries', 'currencies', 'main_currency', 'vehiclesTypes', 'drivers', 'airlines', 'ferries', 'buses'))))!!}';

		function b64DecodeUnicode(str) {

         return decodeURIComponent(atob(str).split('').map(function(c) {
          return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
          }
		
		var newHtml = b64DecodeUnicode(html);

		var elements = $(newHtml).filter('#get_'+mainRowId).html();


		 $('#'+mainRowId).append(elements.replace(/>[\n\t ]+</g, "><").replace(/r0099/gi, newIndex).replace(/with-select3/gi, 'with-select2'));
		  $('.with-select2').select2();
		 $('.datepicker').datetimepicker({
           format: 'YYYY-MM-DD',
         
           });
		      $('.timepicker').datetimepicker({
         format: 'LT'
    });

		 var newRow = $('#'+mainRowPrefix+newIndex);

		 var lastSelectedCountry_1 = lastRow.find('.countries-list_1');
		 
		 var newSelectedCountry_1 = newRow.find('.countries-list_1');
		 newSelectedCountry_1.val(lastSelectedCountry_1.val()).trigger('change');
		 newSelectedCountry_1.addClass('get_geo_lists');
		 var lastCitiesListId_1 = lastRow.find('.cities-list_1').attr('id');
		 var newCitiesList_1 = newRow.find('.cities-list_1');
		 var optionValues_1 = [];
		 $('#'+lastCitiesListId_1+' option').each(function() {

    var option_1 = {};
    option_1['id']  = $(this).val();
    option_1['text']  = $(this).text();

    optionValues_1.push(option_1);

    
});

 newCitiesList_1.html('').select2({data: optionValues_1});

 		 var lastSelectedCountry_2 = lastRow.find('.countries-list_2');
		 var newSelectedCountry_2 = newRow.find('.countries-list_2');
		 newSelectedCountry_2.val(lastSelectedCountry_2.val()).trigger('change');
		 newSelectedCountry_2.addClass('get_geo_lists');
		 var lastCitiesListId_2 = lastRow.find('.cities-list_2').attr('id');
		 var newCitiesList_2 = newRow.find('.cities-list_2');
		 var optionValues_2 = [];
		 $('#'+lastCitiesListId_2+' option').each(function() {

    var option_2 = {};
    option_2['id']  = $(this).val();
    option_2['text']  = $(this).text();

    optionValues_2.push(option_2);

    
});

 newCitiesList_2.html('').select2({data: optionValues_2});

		 
            
			var lastStartDate = lastRow.find('.start-date-input').val();
			
			var lastDay = lastRow.find('.general-day').val();
			var duration = getNumber(lastDay) + 1;
			var newStartDate = getModDate(lastStartDate, duration, true);
			var origDuration = $('#order_duration_value').val();

			if(origDuration < duration){
				newStartDate = lastStartDate;
				duration = lastDay;
			}

		
	        var selectOrderDays = newRow.find('.general-day');
            selectOrderDays.html('');
		    for (var i = 1; i <= origDuration; i++) {
		      selectOrderDays.append(new Option(i, i));	
		     } 
			newRow.find('.start-date-input').val(newStartDate);
			newRow.find('.general-day').val(duration).trigger('change');
			newRow.find('.hidden_day_val').val(duration);
		});

		
</script>

