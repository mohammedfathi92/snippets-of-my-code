
                <div class="panel box box-success parent_section_row" id="sectionItemRow_{{$data->id}}">
                	
                  <div class="box-header with-border">

                  	<a data-toggle="collapse" data-parent="#course-items-list-group" href="#collapse_section_{{$data->id}}">
                  	<input type="hidden" name="sections[]" value="{{$data->id}}">
                    <h4 class="box-title" id="section_title_{{$data->id}}">
                      
                        <i class="fa fa-list grabbing handle" style="color:#111"></i>  {{$data->title}} 
                      
                    </h4>
                     </a>
 
                         <div class="btn-group pull-right">
                         
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;"
                        data-toggle="dropdown"
                        aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                            <a href="javascript:;" class="openEditSection" data-id="{{$data->id}}" data-type="section" data-url = "#"> <i class="fa fa-pen"></i> {{ __('LMS::attributes.main.edit')}} </a>
                         
                        </li>
                        <li>
                       <a href="javascript:;"  class="remove_course_item"  data-id="{{$data->id}}" data-type="section"><i class="fa fa-minus-circle"></i> {{ __('LMS::attributes.main.remove')}}</a>

                      </li>
                    
                </ul>
              </div>

                  </div>
                  
                  <div id="collapse_section_{{$data->id}}" class="panel-collapse collapse in">
                    <div class="box-body">
               <ul id="list-group-section_{{$data->id}}">



<div id="new_section_item_row_{{$data->id}}"></div>             
</ul>

  <hr>
                    
                    {{--  new item --}}

         <div class="display-flex">        
   <div class="input-group ajax_submit_inputs" style="width: 100%">
                <input type="text" class="form-control" placeholder="new section" name="course_item_title">
                <span class="input-group-btn">
                 <div class="btn-group">
                   
                  <a href="javascript:;" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:;" class="add_section_item" data-section-id="{{$data->id}}" data-item-type="lesson">{{ __('LMS::attributes.courses.add_lesson')}}</a></li>
                    <li><a href="javascript:;" class="add_section_item" data-section-id="{{$data->id}}" data-item-type="quiz">{{ __('LMS::attributes.courses.add_quiz')}}</a></li>
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
                    <li><a href="javascript:;" class="select_section_items" data-section-id="{{$data->id}}" data-item-type="lesson">{{ __('LMS::attributes.courses.select_lesson')}}</a></li>
                    <li><a href="javascript:;" class="select_section_items" data-section-id="{{$data->id}}" data-item-type="quiz">{{ __('LMS::attributes.courses.select_quiz')}}</a></li>
                  </ul>
                </div> 
             
            
           
        </div>

            {{-- end create new item --}} 
                    </div>
                  </div>
    </div>

    <script type="text/javascript">
    	
		 $( function() {
		    $( "#list-group-section_{{$data->id}}" ).sortable({ 
		        handle : '.handle', 
		    }); 
		});

    </script>           



