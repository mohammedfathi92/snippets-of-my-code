@extends('layouts.master')

@section('css')

 {!! Theme::css('css/pages.css') !!}

@endsection





@section('content')	

	@include('partials.banner')
	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 ">
					<h5 class="page-side-title">
						<span>@lang('developnet-lms::labels.spans.status')</span>
						<span class="badge badge-success">
							@lang('developnet-lms::labels.spans.sured')
						</span>
						<span class="badge badge-warning">
							@lang('developnet-lms::labels.spans.under_review')
						</span>
						<span class="badge badge-danger">
							@lang('developnet-lms::labels.spans.cancelled')
						</span>
					</h5>
					<br>
					<div class="page-side-title"> 
						<h4>@lang('developnet-lms::labels.headings.text_invoice')</h4>
					</div>
					<table class="table table-bordered inv-table">
					    <thead class="thead-dark">
					      <tr>
					        <th>@lang('developnet-lms::labels.headings.text_num')</th>
					        <th>@lang('developnet-lms::labels.headings.text_element')</th>
					        <th>@lang('developnet-lms::labels.headings.text_price')</th>
					        <th>@lang('developnet-lms::labels.headings.text_note')</th>
					      </tr>
					    </thead>
					    <tbody>

					      <tr>
					        <td>1</td>
					        <td><a href="#">اختبار في اللغه العربيه</a></td>
					        <td>Doe</td>
					        <td>john@example.com</td>
					      </tr>
					      <tr>
					        <td>2</td>
					        <td>Moe</td>
					        <td>Doe</td>
					        <td>mary@example.com</td>
					      </tr>
					      <tr>
					        <td>3</td>
					        <td>Dooley</td>
					        <td>Doe</td>
					        <td>july@example.com</td>
					      </tr>
					      <tr>
					        <td>4</td>
					        <td>Dooley</td>
					        <td>Doe</td>
					        <td>july@example.com</td>
					      </tr>
					    </tbody>
					    <tfoot class="tfoot-dark">
					    	<tr>
					    		<th class="table-active">@lang('developnet-lms::labels.headings.text_total')</th>
					    		<th class="text-danger">120$</th>

					    	</tr>
					    </tfoot>
					</table>
				</div>
			</div>
		</div>
	</section>

@endsection

