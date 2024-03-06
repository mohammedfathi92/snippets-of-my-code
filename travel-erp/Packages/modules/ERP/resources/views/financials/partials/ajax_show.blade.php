                   
          <div class="box">
            <div class="box-header">
            </div>

            <div class="box-body" style="font-size: 16px;">
             {{-- <p id ="not_purchases_found" @if(countData($invoice->invoicables()))style="display: none;" @endif>No Purchases Found</p> --}}
 


           <div class="row">
             <div class="col-md-12">
              
            </div>
              
            </div>


              <div class="table-responsive no-padding">
  
              <table class="table table-hover" id="invoice-items-table"  >

                 <tr>
                  <td>
                    <strong>{{__('ERP::attributes.financials.label_type')}}</strong>
                  </td>
                  <td>
                    <span class="label label-primary">{{__('ERP::attributes.financials.types.'.$financial->type)}} </span>
                  </td>
                </tr>

                @if($financial->item_type)
                <tr>
                  <td>

                    <strong>{{__('ERP::attributes.financials.commission_type')}}</strong>
                    
                  </td>
                  <td>

                    {{__('ERP::attributes.financials.commission_types.'.$financial->item_type)}}
                    
                  </td>
                </tr>

                @endif

                @if($financial->item_numbers > 1)

               <tr>
                  <td>

                    <strong>{{__('ERP::attributes.financials.commission_items_number')}}</strong>
                    
                  </td>
                  <td>

                    {{$financial->item_numbers}}
                    
                  </td>
                </tr>

                @endif

  
              <tr>
                  <td>

                    <strong>{{__('ERP::attributes.financials.value')}}</strong>
                    
                  </td>
                  <td>

                    {{$financial->value}}
                    
                  </td>
                </tr>

                @if($financial->order)

               <tr>
                  <td>

                    <strong>{{__('ERP::attributes.financials.order_number')}}</strong>
                    
                  </td>
                  <td>
                    {{$financial->order?$financial->order->order_code:'--'}}

                  </td>
                </tr>

                @endif

                @if($financial->order)

               <tr>
                  <td>

                     <strong>{{__('ERP::attributes.financials.category')}}</strong>
                    
                  </td>
                  <td>
                    {{$financial->order?$financial->order->category_id:'--'}}
                    
                  </td>
                   
                </tr>

                @endif

                @if($financial->from_user)


            <tr>
                  <td>

                     <strong>{{__('ERP::attributes.financials.from_user')}}</strong>
                    
                  </td>
                  <td>

                    {{$financial->from_user?$financial->from_user->translated_name.'&nbsp;['.$financial->from_user->user_code.']':'--'}}
                    
                  </td>
                </tr>

                @endif

                @if($financial->to_user)

             <tr>
                  <td>

                     <strong>{{__('ERP::attributes.financials.to_user')}}</strong>
                    
                  </td>
                  <td>

                   {{$financial->to_user?$financial->to_user->translated_name.'&nbsp;['.$financial->to_user->user_code.']':'--'}}
                    
                  </td>
                </tr>

                @endif

                @if($financial->from_account)


              <tr>
                  <td>

                     <strong>{{__('ERP::attributes.financials.from_account')}}</strong>
                    
                  </td>
                  <td>

                    {{$financial->from_account?$financial->from_account->translated_name.'&nbsp;['.$financial->from_account->account_code.']':'--'}}
                    
                  </td>
                </tr>
                @endif

                @if($financial->to_account)

             <tr>
                  <td>

                     <strong>{{__('ERP::attributes.financials.to_account')}}</strong>
                    
                  </td>
                  <td>

                   {{$financial->to_account?$financial->to_account->translated_name.'&nbsp;['.$financial->to_account->account_code.']':'--'}}
                    
                  </td>
                </tr>

                @endif

               <tr>
                  <td>
                    <strong>{{__('ERP::attributes.financials.description')}}</strong>
                    
                  </td>
                  <td>
                    {{$financial->description?: '---'}}
                    
                  </td>
                </tr>

                <tr>
                  <td>
                    <strong>{{__('ERP::attributes.financials.notes')}}</strong>
                    
                  </td>
                  <td>
                    {{$financial->notes?: '---'}}
                    
                  </td>
                </tr>

               <tr>
                  <td>

                     <strong>{{__('ERP::attributes.financials.created_by')}}</strong>
                    
                  </td>
                  <td>

                    {{$financial->created_user?$financial->created_user->translated_name.'&nbsp;['.$financial->created_user->user_code.']': '---'}}
                    
                  </td>
                </tr>

                 <tr>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                </tr>

              </table>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
   