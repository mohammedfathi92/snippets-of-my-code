                   
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
                    <strong>{{__('ERP::attributes.expenses.label_type')}}</strong>
                  </td>
                  <td>
                    <span class="label label-primary">{{__('ERP::attributes.expenses.types.'.$expense->type)}} </span>
                  </td>
                </tr>

                @if($expense->item_type)
                <tr>
                  <td>

                    <strong>{{__('ERP::attributes.expenses.commission_type')}}</strong>
                    
                  </td>
                  <td>

                    {{__('ERP::attributes.expenses.commission_types.'.$expense->item_type)}}
                    
                  </td>
                </tr>

                @endif

                @if($expense->item_numbers > 1)

               <tr>
                  <td>

                    <strong>{{__('ERP::attributes.expenses.commission_items_number')}}</strong>
                    
                  </td>
                  <td>

                    {{$expense->item_numbers}}
                    
                  </td>
                </tr>

                @endif

  
              <tr>
                  <td>

                    <strong>{{__('ERP::attributes.expenses.value')}}</strong>
                    
                  </td>
                  <td>

                    {{$expense->value}}
                    
                  </td>
                </tr>

                @if($expense->order)

               <tr>
                  <td>

                    <strong>{{__('ERP::attributes.expenses.order_number')}}</strong>
                    
                  </td>
                  <td>
                    {{$expense->order?$expense->order->order_code:'--'}}

                  </td>
                </tr>

                @endif

                @if($expense->order)

               <tr>
                  <td>

                     <strong>{{__('ERP::attributes.expenses.category')}}</strong>
                    
                  </td>
                  <td>
                    {{$expense->order?$expense->order->category_id:'--'}}
                    
                  </td>
                   
                </tr>

                @endif

                @if($expense->from_user)


            <tr>
                  <td>

                     <strong>{{__('ERP::attributes.expenses.from_user')}}</strong>
                    
                  </td>
                  <td>

                    {{$expense->from_user?$expense->from_user->translated_name.'&nbsp;['.$expense->from_user->user_code.']':'--'}}
                    
                  </td>
                </tr>

                @endif

                @if($expense->to_user)

             <tr>
                  <td>

                     <strong>{{__('ERP::attributes.expenses.to_user')}}</strong>
                    
                  </td>
                  <td>

                   {{$expense->to_user?$expense->to_user->translated_name.'&nbsp;['.$expense->to_user->user_code.']':'--'}}
                    
                  </td>
                </tr>

                @endif

                @if($expense->from_account)


              <tr>
                  <td>

                     <strong>{{__('ERP::attributes.expenses.from_account')}}</strong>
                    
                  </td>
                  <td>

                    {{$expense->from_account?$expense->from_account->translated_name.'&nbsp;['.$expense->from_account->account_code.']':'--'}}
                    
                  </td>
                </tr>
                @endif

                @if($expense->to_account)

             <tr>
                  <td>

                     <strong>{{__('ERP::attributes.expenses.to_account')}}</strong>
                    
                  </td>
                  <td>

                   {{$expense->to_account?$expense->to_account->translated_name.'&nbsp;['.$expense->to_account->account_code.']':'--'}}
                    
                  </td>
                </tr>

                @endif

               <tr>
                  <td>
                    <strong>{{__('ERP::attributes.expenses.description')}}</strong>
                    
                  </td>
                  <td>
                    {{$expense->description?: '---'}}
                    
                  </td>
                </tr>

                <tr>
                  <td>
                    <strong>{{__('ERP::attributes.expenses.notes')}}</strong>
                    
                  </td>
                  <td>
                    {{$expense->notes?: '---'}}
                    
                  </td>
                </tr>

               <tr>
                  <td>

                     <strong>{{__('ERP::attributes.expenses.created_by')}}</strong>
                    
                  </td>
                  <td>

                    {{$expense->created_user?$expense->created_user->translated_name.'&nbsp;['.$expense->created_user->user_code.']': '---'}}
                    
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
   