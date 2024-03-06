	<table class="table table-bordered custom-table table-responsive">
				    <thead class="thead-dark ">
				      <tr> 
				        <th>@lang('developnet-lms::labels.headings.text_code')</th>
				        
				        <th>@lang('developnet-lms::labels.headings.text_element')</th>
				        <th>@lang('developnet-lms::labels.headings.text_type')</th>
				        <th>@lang('developnet-lms::labels.headings.text_price')</th>
				        <th>@lang('developnet-lms::labels.headings.text_note')</th>
				      </tr>
				    </thead>
				    <tbody>
				    				    	
                @foreach($invoicables as $item)
                @php

                $itemModule = \LMS::getModuleData($item->lms_invoicable_type , $item->lms_invoicable_id); 
              // if($item->lms_invoicable_type == 'course'){
              // 	 $route = route('courses.show', ['id' => $itemModule->hashed_id]);


              // }
               

                @endphp
				      <tr>
				        <td>{{$item->code}}</td>
				        <td>{{-- <a href=""></a> --}}{{$itemModule->title}}</td>
				        <td>@lang('developnet-lms::labels.headings.module_types_options.'.$item->lms_invoicable_type)</td>
				        <td>{{$item->price}}</td>
				        <td>----</td>
				      </tr>
				      @endforeach
				
				    </tbody>
				    <tfoot class="tfoot-dark">
				    	<tr>
				    		<th class="table-active">@lang('developnet-lms::labels.headings.text_total')</th>
				    		<th class="text-danger">{{$invoice->total_price}} @lang('LMS::attributes.main.currency_rs')</th>

				    	</tr>
				    </tfoot>
				</table>

