@extends('layouts.master')

@section('css')

<!--Datatables-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
 {!! Theme::css('css/pages.css') !!}

@endsection

@section('content')	

	@include('partials.banner')
	<section class="page-content">
		<div class="container">
			<div class="row">
@include('partials.profile_sidebar')
				<div class="col-lg-9 col-md-8 ">
					<div class="mtb-15">
						<a href="#" onClick="history.go(-1);return true;">
							@lang('developnet-lms::labels.links.link_back')
							<i class="fa fa-angle-double-left" aria-hidden="true"></i>

						</a>
					</div>
					

					<div class="page-side-title normal">
						<h4>
							@lang('developnet-lms::labels.headings.text_invoices')									
						</h4>
					</div>
					<div class="with-datatable">
									      	
				        <table id="example" class="table table-striped table-bordered" style="width:100%">
					        <thead>
					            <tr>
					                <th>
					                	@lang('developnet-lms::labels.headings.invoice_code')
					                </th>
					               {{--  <th>
					                	@lang('developnet-lms::labels.headings.invoice_user')
					                </th> --}}
					                <th>
					                	@lang('developnet-lms::labels.headings.invoice_price')
					                </th>
					                <th>
					                	@lang('LMS::attributes.main.created_at')
					                </th>
					                <th>
					                	حالة الدفع
					                </th>
					                <th>
					                	@lang('developnet-lms::labels.spans.span_options')
					                </th>
					            </tr>
					        </thead>
					        <tbody>
					        @foreach($userInvoices as $invoice)
					            <tr>
					                <td>{{$invoice->code}}</td>
					               {{--  <td>{{$userLMS->name}}</td> --}}
					                <td>{{$invoice->total_price}}</td>
					                <td>{!! \Carbon\Carbon::instance($invoice->created_at)->diffForHumans() !!}</td>
					                @if($invoice->status == 'paid')
					                <td><span class="badge badge-success">مدفوع </span></td>
					                @elseif($invoice->status == 'cancelled')
					                <td><span class="badge badge-danger">ملغي </span></td>
					                @else
					                <td><span class="badge badge-warning"> معلق </span></td>
					                @endif
					                <td>
					                	<button class="btn btn-primary small"  onclick="openInvoiceModal('{{$invoice->hashed_id}}')">
					                	@lang('developnet-lms::labels.spans.span_show')
					               		 </button>
                                      @if($invoice->status == 'paid')

                                       <button class="btn btn-default small" disabled="">
					                	كود الدفع
					               		 </button>

                                       @else 
					               		 <button class="btn btn-dark small"  onclick="newPaymentCode('{{$invoice->hashed_id}}')">
					                	كود الدفع
					               		 </button>
					               		 @endif
					            	</td>
					            </tr>
					            @endforeach
					           
					        </tbody>
					        <tfoot>
					            <tr>
					                <th>
					                	@lang('developnet-lms::labels.headings.invoice_code')

					                </th>
					               {{--  <th>
					                	@lang('developnet-lms::labels.headings.invoice_user')
					                </th> --}}
					                <th>
					                	@lang('developnet-lms::labels.headings.invoice_price')
					                </th>
					                <th>
					                	@lang('LMS::attributes.main.created_at')
					                </th>
					                <th>
					                	حالة الدفع
					                </th>
					                <th>
					                	@lang('developnet-lms::labels.spans.span_options')
					                </th>
					            </tr>
					        </tfoot>
					    </table>
				    </div>
				</div>
			</div>
		</div>
	</section>

@endsection

@section('after_content')
	<div class="modal fade bill-modal print-modal" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <div class="get-certificate">
	        	{{-- <div >
	        		<a href="#"><i class="fa fa-download" aria-hidden="true"></i>
	        		<span>@lang('developnet-lms::labels.spans.download')</span></a>
	        	</div> --}}
	        	{{-- <div class="print-element">
	        		<a href="#">
	        			<i class="fa fa-print" aria-hidden="true"></i>
	        		<span>@lang('developnet-lms::labels.spans.print')</span>
	        		</a>
	        	</div> --}}
	        </div>
	      </div> 
	      <div class="modal-body">
	        
	      </div>
	    </div>
	  </div>
	</div>

  <!-- Modal -->

<div class="modal fade" id="newPaymentCodeModal" tabindex="-1" role="dialog" aria-labelledby="newPaymentCodeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #fff">

       {{--  <div class="modal-body" dir="rtl">

          </div>
          <div class="modal-footer border-top-0" style="padding-right: 30px">
            <a href="javascript:;" class="btn btn-danger submit_ask_teacher" data-dismiss="modal"><i class="fa fa-paper-plane"></i> تفعيل </a>
            <a href="javascript:;"  class="btn btn-secondary" data-dismiss="modal">@lang('LMS::attributes.main.label_cancel')</a>
          </div> --}}


   
    </div>
  </div>
</div>


{{-- payment code --}}	

<div class="modal fade" id="invoiceChangeStatusModal" tabindex="-1" role="dialog" aria-labelledby="invoiceChangeStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background: #fff">

    </div>
  </div>
</div>	

@endsection 


@section('js')
<!-- Data tabless-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
{!! Theme::js('js/circles.min.js"') !!}  
	<script>
		Circles.create({
			id:           'circles-1',
			value:        85,
			radius:       60,
			width:        8,
			duration:     1,
			colors:       ['#d1e4d6', '#28a745 ']
		});
	</script>	


	{{-- print pill --}}
	<script type="text/javascript">
		
		function printData()
		{
		   var divToPrint=document.getElementById("printable");
		   newWin= window.open("");
		   newWin.document.write(divToPrint.outerHTML);
		   newWin.print();
		   newWin.close();
		}

		$('.print-element').on('click',function(){
			printData();
		})
	</script>

		 <script>
        function openInvoiceModal(id) {
            $('#invoiceModal').modal('show').find('.modal-body').load('/subscriptions/ajax/user/{{$userBase->hashed_id}}/invoice/'+id+'/ajax_show');
        }
    </script>

    <script>
        function changeStatus(id) {
            $('#invoiceChangeStatusModal').modal('show').find('.modal-body').load('/subscriptions/ajax/user/{{$userBase->hashed_id}}/invoice/'+id+'/ajax_show');
        }
    </script>

        <script>
        function newPaymentCode(invoice) {
            $('#newPaymentCodeModal').modal('show').find('.modal-content').load('/subscriptions/ajax/'+invoice+'/get-pay-code-form');
        }
    </script>

@endsection 

