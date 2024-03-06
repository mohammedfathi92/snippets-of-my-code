
@if($customer_code)
  	 {!! PackagesForm::select('customer_code','ERP::attributes.order.customer_code', \ERP::getCustomersList(),true,$customer_code) !!}	
@endif