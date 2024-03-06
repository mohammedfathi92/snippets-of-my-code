@section('content')
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">عناصر الالفاتورة</h3>
            </div>

            <div class="box-body">
              <p id ="not_purchases_found" @if(countData($invoice->invoicables()))style="display: none;" @endif>لا توجد مشتريات.</p>
              <div class="table-responsive no-padding">
  
              <table class="table table-hover" id="invoice-items-table" @if(!countData($invoice->invoicables()))style="display: none;" @endif>
               
                <tr>
                 
                  <th>النوع</th>
                  <th>الاسم</th>
                  <th>السعر</th>
                 

                 
                </tr>
                @php
                $total_price = [];
                @endphp
                @foreach($invoice->invoicables()->get() as $row)
                @php
                 $item = \LMS::getModuleData($row->lms_invoicable_type, $row->lms_invoicable_id);
                @endphp
                <tr>
                  <td><span class="label label-success">{{__('LMS::attributes.main.elements_singular.'.$row->lms_invoicable_type)}}</span></td>
                  <td>{{$item?$item->title: '--'}}</td>
                  <td>{{$row->price}}</td>
                 
                </tr>
                @php
                $total_price[] = $row->price;
                @endphp
                @endforeach
           
                 <tr class="last_tr"></tr>
                 <tr>
                  
                  <td></td>
                  <td></td>
                  <td><strong>اجمالي السعر : </strong> <span id="total_price_value"> {{!empty($total_price)?array_sum($total_price):0}}</span> </td>
                </tr>
              </table>
              </div>
        
            <br>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    <div class="row">
        <div class="col-md-12">

        @php

                  $status_options = [
                    'paid' => __('LMS::attributes.invoices.paid'),
                    'pending' => __('LMS::attributes.invoices.pending'),
                    'cancelled' => __('LMS::attributes.invoices.cancelled'),
                  ];
        @endphp
            @component('components.box')
                {!! Form::model($invoice, ['url' => route('invoices.update_status', $invoice->hashed_id),'method'=>'PUT','files'=>false]) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! ModulesForm::select('status','LMS::attributes.main.status',  $status_options ,true) !!}
                        

                        {!! ModulesForm::formButtons(trans('LMS::attributes.main.edit',['title' => $title_singular]), [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
