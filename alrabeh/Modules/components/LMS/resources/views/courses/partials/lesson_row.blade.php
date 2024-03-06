<li id="lessonItemRow_{{$data->id}}" class="list-group-item  sortable ajax_submit_inputs parent_item_row" style="display: flex;align-items:  center;"> 
                   <i class="fa fa-arrows-alt  grabbing handle"></i>  <input class="form-control course_item_title" name="course_item_title" type="text" placeholder="add new lesson" style="margin: 0 10px;" value="{{$data->title}}">  <input name="sectionItems[{{$section_id}}][]" type="hidden" value="lesson_{{$data->id}}">  
                   <input name="lessons[]" type="hidden" value="{{$data->id}}"> 
                     <i class="fa fa-book margin"> </i>  
                     <a href="javascript:;" data-toggle="tooltip" data-placement="top" title="{{__('LMS::attributes.courses.tooltip_is_private_item')}}" class="btn_private_item" style="color: #a2a7a2;" data-item_id="{{'lesson_'.$data->id}}"><i class="fa fa-eye margin"></i><input  type="hidden" name="is_private_lesson[{{$data->id}}]" type="hidden" id="{{'lesson_'.$data->id}}" value=0></a>
                    
                    <div class="item-actions">

                      <div class="btn-group pull-right">
                         
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;"
                        data-toggle="dropdown"
                        aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button>
                          <ul class="dropdown-menu" role="menu">
                          <li>
                            <a href="{{route('lessons.edit', $data->hashed_id)}}" class="update_course_item" data-id="{{$data->id}}" data-type="lesson" target="_blank"> <i class="fa fa-pen"></i> {{ __('LMS::attributes.main.edit')}} </a>
                         
                        </li>
                        <li>
                       <a href="javascript:;"  class="remove_course_item"  data-id="{{$data->id}}" data-type="lesson"><i class="fa fa-minus-circle"></i> {{ __('LMS::attributes.main.remove')}}</a>

                      </li>
                    
                </ul>
              </div>
            </div>
             
        </li> 