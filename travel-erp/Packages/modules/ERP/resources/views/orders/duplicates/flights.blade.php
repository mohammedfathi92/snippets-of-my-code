
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.order.customer_data')])
                {!! Form::model($order, ['url' => url('erp/orders/duplicates/flights/'.$order->hashed_id),'method'=>'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- provider provider fields here-->

                    <div class="row">
                        <div class="col-md-6">
                            {!! PackagesForm::text('order_code','ERP::attributes.order.order_code',true,null) !!}
                        </div>
                        <div class="col-md-6" id="customer_code">
                            {!! PackagesForm::select('customer_code','ERP::attributes.order.customer_code', \ERP::getCustomersList(),true,null,['class'=>'select2']) !!}
                        </div>
                       
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            {!! PackagesForm::select('order_type','ERP::attributes.order.order_type',\ERP::getOrderTypesList(),true,null) !!}
                           
                             
                         </div>                        
                         <div class="col-md-6">
                            {!! PackagesForm::number('adult_numbers','ERP::attributes.order.adult_numbers',false) !!}
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-6">
                           {!! PackagesForm::number('chlid_numbers','ERP::attributes.order.chlid_numbers',false) !!}
                         </div>
                         <div class="col-md-6 ">
                           {!! PackagesForm::number('infant_numbers','ERP::attributes.order.infant_numbers',false) !!}
                         </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            {!! PackagesForm::select('agent_id','ERP::attributes.order.agent',\ERP::getAgentsList(),true,null) !!}
                            
                        </div>
                         <div class="col-md-6">
                            {!! PackagesForm::date('order_date','ERP::attributes.order.order_date',true) !!}
                             
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-6">
                           {!! PackagesForm::date('arrive_date','ERP::attributes.order.arrive_date',true) !!}
                             
                         </div>
                         <div class="col-md-6" > 
                             {!! PackagesForm::select('order_status','ERP::attributes.order.order_status',[
                                'Demand' => trans('ERP::attributes.order_status.Demand'),
                                'Move to implementation' => trans('ERP::attributes.order_status.move_implementation'),
                                'In progress'=>trans('ERP::attributes.order_status.in_progress'),
                                'Confirmed' => trans('ERP::attributes.order_status.Confirmed'),
                                'Finished' => trans('ERP::attributes.order_status.Finished'),
                                'Closed' => trans('ERP::attributes.order_status.Closed'),
                                
                                 ],true,null) !!}
                         </div>
                         
                      </div>
                      <div class="row">
                           {!! PackagesForm::text('notes','ERP::attributes.main.note',false) !!}
                      </div>


            @component('components.box',['box_title'=>trans('ERP::attributes.order.orders')])

                <div class="row">
                    <div class="form-group col-md-12">
                        {!! PackagesForm::date('dates[flight_date]','ERP::attributes.order.flight_date',false) !!}
                    </div>
                </div>
                <div class="row">
                
                    <div class="form-group col-md-6">
                        {!! PackagesForm::text('dates[leave_time]','ERP::attributes.order.leave_time',false) !!}
                    </div>
                     <div class="form-group col-md-6">
                        {!! PackagesForm::text('dates[arrive_time]','ERP::attributes.order.arrive_time',false) !!}
                    </div>
                </div>




                       {!! PackagesForm::customFields($order) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}


            @endcomponent
            @endcomponent
        </div>
    </div>
