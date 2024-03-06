 @extends('voyager::master')

@section('page_title', __('title.investor.create'))

@section('page_header')
    <h1><i class="fa fa-user"></i>قوالب السندادت المالية</h1>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
        	@foreach($data as $row)
        	 {!! Form::open(['url'=> route('prints.update',['temp_id'=>$row->id]),'method'=>'post']) !!}
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary box-solid">
                     
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans_choice('main.prints_title', $row->type) }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <h4>اكواد المتغيرات</h4>
              <!-- contracts -->

              @if($row->type == 'contract_1' || $row->type == 'contract_2')
            <p>
              			<span>اسم المستثمر <code> dn_investor_name </code> </span>
              			<span>اسم العميل <code> dn_client_name </code> </span>
              			<span>اسم الكفيل الأول <code> dn_kafil_name_1 </code> </span>
              	</p><p>
              			<span>اسم الكفيل الثاني <code> dn_kafil_name_2 </code> </span>
              			<span>رقم العقد <code> dn_contract_no </code> </span>
              			<span>عدد الأقساط <code> dn_aqsat_no </code> </span>

              	</p>

              	 <p>
              			<span>تاريخ بداية العقد (ميلادي) <code> dn_contract_start_date_mi </code> </span>
              			<span>تاريخ كتابة العقد  <code> dn_contract_write_date </code> </span>
              			<span>تاريخ بداية العقد (هجري) <code> dn_contract_start_date_hj </code> </span>
              			</p>
              		<!-- 	<p>
              				
              			<span>تاريخ كتابة العقد (هجري) <code> dn_contract_write_date_hj </code> </span>
              			
              			
              	</p --> <p>
              			<span>العمولة على المستثمر <code> dn_commission </code> </span>
              			<span>رسوم العقد <code> dn_contract_fees </code> </span>
              			<span>صندوق ايداع الدفعة المقدمة <code> dn_account_box </code> </span>
              	</p><p>
              			<span>اجمالي قيمة العقد <code> dn_contract_price </code> </span>	
              			<span>قيمة القسط الواحد<code> dn_one_qest_price </code> </span>
              			<span>قيمة القسط الأخير<code> dn_last_qest_price </code> </span>

              			
              	</p><p>
              		<span>قيمة مدفوعة مقدماً <code> dn_first_pay </code> </span>
              		<!-- <span>نوع العقد<code> dn_contract_type </code> </span> -->
              		
              	</p>
              	<p>
              		<!-- <span> تاريخ طباعة السند (هجري) <code> dn_print_date_hij </code> </span> -->
                    <span> تاريخ طباعة السند <!-- (ميلادي) --> <code> dn_print_date_mi </code> </span>
                    <span>رقم السند <code> dn_sanad_no </code> </span>
              	</p>
                @endif
              	@if($row->type == 'qest')

              	<!-- Aqsat -->
                <p>
              		<span>رقم العقد <code> dn_contract_no </code> </span>
              		<span>رقم القسط <code> dn_qest_no </code> </span>
              		<span>اسم المستثمر <code> dn_investor_name </code> </span>
              		
              		
              	</p><p>
              		<span>اسم العميل <code> dn_client_name </code> </span>
              		<span>اسم الكفيل الأول <code> dn_kafil_name_1 </code> </span>
              		<span>اسم الكفيل الثاني <code> dn_kafil_name_2 </code> </span>
              		
              	</p><p>
              		<span>تاريخ استحقاق القسط (ميلادي)<code> dn_qest_date_mi </code> </span>
              		<span>تاريخ استحقاق القسط (هجري) <code> dn_qest_date_hj </code> </span>
              		<span>صندوق الايداع <code> dn_account_box </code> </span>
              		
              	</p><p>
              		<span>القيمة المدفوعة <code> dn_amount_pay </code> </span>
              		<span>المتبقي من قيمة القسط <code> dn_qest_remain </code> </span>
              		<span>المتبقي من قيمة العقد <code> dn_contract_remain </code> </span>          		
              	</p>

              	<p>
              		<!-- <span> تاريخ طباعة السند (هجري) <code> dn_print_date_hij </code> </span> -->
                    <span> تاريخ طباعة السند (ميلادي) <code> dn_print_date_mi </code> </span>
                    <span>رقم السند <code> dn_sanad_no </code> </span>
              	</p>
                @endif
  <!-- transfer -->
              {{-- 	@elseif($row->type == 'transfer')
              
                <p>
              		<span> المستخدم المحول منه<code> dn_transfer_from_user </code> </span>
              		<span> المستخدم المحول اليه<code> dn_transfer_to_user </code> </span>
              		<span> الصندوق المحول منه<code> dn_transfer_from_box </code> </span>
              		       		
              	</p>

              	 <p>
              		<span> الصندوق المحول اليه<code> dn_transfer_to_box </code> </span>
              		<span> قيمة المبلغ المحول<code> dn_transfer_amount </code> </span>
              		       		
              	</p>

              	<p>
              		<!-- <span> تاريخ طباعة السند (هجري) <code> dn_print_date_hij </code> </span> -->
                    <span> تاريخ طباعة السند (ميلادي) <code> dn_print_date_mi </code> </span>
              	</p>

              	@else

              	<!-- others -->

              	<p>
              		<span> اسم المستخدم <code> dn_user_name </code> </span>
              		<span> اسم الصندوق <code> dn_box_name </code> </span>
              		<span> قيمة المبلغ<code> dn_amount </code> </span>
              		       		
              	</p>

              	<p>
              		<!-- <span> تاريخ طباعة السند (هجري) <code> dn_print_date_hij </code> </span> -->
                    <span> تاريخ طباعة السند (ميلادي) <code> dn_print_date_mi </code> </span>
                    <span>رقم السند <code> dn_sanad_no </code> </span>
              	</p>
 --}}

              	

              	<input type="hidden" name="type" value="{{ $row->type }}">

                 <textarea class="ckeditor" name="content" rows="10" cols="80">
                                            {!! $row->content !!}
                    </textarea>
                    <hr>
               <button type="submit" class="btn bg-olive margin">حفظ التعديلات</button>

            </div>
            <!-- /.box-body -->
          </div>
               
              
            </div> <!-- end col-12 -->
            {!! Form::close() !!}
            @endforeach
        </div> <!-- end row -->
    </section>


@endsection

@section('javascript')
@endsection