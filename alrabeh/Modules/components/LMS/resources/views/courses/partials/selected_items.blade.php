


            <div class="panel box box-success parent_section_row" id="sectionItemRow_{{$section->id}}">
                	
                  <div class="box-header with-border">

                  	<a data-toggle="collapse" data-parent="#course-items-list-group" href="#collapse_section_{{$section->id}}">
                  	<input type="hidden" name="sections[]" value="{{$section->id}}">
                    <h4 class="box-title" id="section_title_{{$section->id}}">
                      
                        <i class="fa fa-list grabbing handle" style="color:#111"></i>  {{$section->title}} 
                      
                    </h4>
                     </a>

                         <div class="btn-group pull-right">
                         
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;"
                        data-toggle="dropdown"
                        aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <a href="javascript:;" class="openEditSection" data-id="{{$section->id}}" data-type="section" data-url = "#"> <i class="fa fa-pen"></i> {{ __('LMS::attributes.main.edit')}} </a>
                         
                        </li>
                        <li>
                       <a href="javascript:;"  class="remove_course_item"  data-id="{{$section->id}}" data-type="section"><i class="fa fa-minus-circle"></i> {{ __('LMS::attributes.main.remove')}}</a>

                      </li>
                    
                </ul>
              </div>

                  </div>
                  
                  <div id="collapse_section_{{$section->id}}" class="panel-collapse collapse">
                    <div class="box-body">
               <ul id="list-group-section_{{$section->id}}">

                @php
                $sectionItems = [];

            	if($section->lessons){

               		foreach($section->lessons as $less){

               			$order = $less->pivot->order;
               			

               			$sectionItems[] = ['type' => 'lesson', 'id' => $less->id, 'hashId' => $less->hashed_id,'title' => $less->title, 'order'=> $order, 'is_private' => $less->pivot->is_private];

                 }


               	}

               	if($section->quizzes){

               		foreach($section->quizzes as $q){

               			$order = $q->pivot->order;
               			

               		 $sectionItems[] = ['type' => 'quiz', 'id' => $q->id, 'hashId' => $q->hashed_id,'title' => $q->title, 'order'=> $order, 'is_private' => $q->pivot->is_private];


                 }


               	}

               //	array_reverse () desc

               	$sectionItemsSortable = array_values(collect($sectionItems)->sortBy('order')->toArray()); //asc

               	@endphp

               
               @foreach($sectionItemsSortable as $row)

               	<li id="lessonItemRow_{{$row['id']}}" class="list-group-item  sortable ajax_submit_inputs parent_item_row" style="display: flex;align-items:  center;"> 
                   <i class="fa fa-arrows-alt  grabbing handle"></i>  <input class="form-control course_item_title" name="course_item_title" type="text" placeholder="add new lesson" style="margin: 0 10px;" value="{{$row['title']}}">  <input name="sectionItems[{{$section->id}}][]" type="hidden" value="{{$row['type'].'_'.$row['id']}}">  
                     <input name="@if($row['type']  == 'lesson')lessons[] @else quizzes[] @endif" type="hidden" value="{{$row['id']}}"> 

                     <i class="fa @if($row['type']  == 'lesson')fa-book @else fa-clock-o @endif margin"> </i>
                  @if($row['type'] == 'lesson')
                      <a href="javascript:;" data-toggle="tooltip" data-placement="top" title="{{__('LMS::attributes.courses.tooltip_is_private_item')}}" class="btn_private_item" style="{{$row['is_private']?'color: #4caf50;':'color: #a2a7a2;'}}" data-item_id="{{$row['type'].'_'.$row['id']}}"><i class="fa fa-eye margin"></i><input  type="hidden" name="is_private_lesson[{{$row['id']}}]" type="hidden" id="{{$row['type'].'_'.$row['id']}}" value={{$row['is_private']?1:0}}></a>
                   @else

                    <a href="javascript:;" style="color: #4caf50;" ><i class="fa fa-eye margin"></i><input  type="hidden" name="is_private_quiz[{{$row['id']}}]" type="hidden"  value=1></a>

                   @endif
                     
                    
                    <div class="item-actions">

                      <div class="btn-group pull-right">
                         
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;"
                        data-toggle="dropdown"
                        aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button>
                          <ul class="dropdown-menu" role="menu">
                          <li>
                            <a href="@if($row['type']  == 'lesson') {{route('lessons.edit', $row['hashId'])}} @else {{route('quizzes.edit', $row['hashId'])}} @endif" class="update_course_item" data-id="{{$row['id']}}" data-type="{{$row['type']}}" target="_blank"> <i class="fa fa-pen"></i> {{ __('LMS::attributes.main.edit')}} </a>
                         
                        </li>
                        <li>
                       <a href="javascript:;"  class="remove_course_item"  data-id="{{$row['id']}}" data-type="{{$row['type']}}"><i class="fa fa-minus-circle"></i> {{ __('LMS::attributes.main.remove')}}</a>

                      </li>
                    
                </ul>
              </div>
            </div>
             
        </li> 

      



   

  @endforeach  

  <div id="new_section_item_row_{{$section->id}}"></div>        
</ul>

  <hr>

                    {{--  new item --}}

         <div  class="display-flex">        
   <div class="input-group ajax_submit_inputs" style="width: 100%">
                <input type="text" class="form-control" placeholder="{{ __('LMS::attributes.courses.new_lesson')}}" name="course_item_title">
                <span class="input-group-btn">
                 <div class="btn-group">
                   
                  <a href="javascript:;" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:;" class="add_section_item" data-section-id="{{$section->id}}" data-item-type="lesson">{{ __('LMS::attributes.courses.add_lesson')}}</a></li>
                    <li><a href="javascript:;" class="add_section_item" data-section-id="{{$section->id}}" data-item-type="quiz">{{ __('LMS::attributes.courses.add_quiz')}}</a></li>
                  </ul>
                </div> 
              </span>
            </div>

          
                 <div class="btn-group">
                   
                  <a href="javascript:;" class="btn btn-success dropdown-toggle" data-toggle="dropdown"> {{ __('LMS::attributes.main.select')}}
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:;" class="select_section_items" data-section-id="{{$section->id}}" data-item-type="lesson">{{ __('LMS::attributes.courses.select_lesson')}}</a></li>
                    <li><a href="javascript:;" class="select_section_items" data-section-id="{{$section->id}}" data-item-type="quiz">{{ __('LMS::attributes.courses.select_quiz')}}</a></li>
                  </ul>
                </div> 
             
            
           
        </div>

            {{-- end create new item --}} 
                    </div>
                  </div>
    </div>
  @push('new-custom-scripts')

    <script type="text/javascript">
    	
		 $( function() {
		    $( "#list-group-section_{{$section->id}}" ).sortable({ 
		        handle : '.handle', 
		    }); 
		});
     $('.box-body .panel-collapse.collapse:first-child').addClass('in');

    </script>    

  @endpush      



