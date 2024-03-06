  <div  class="display-flex">        
   <div class="input-group ajax_submit_inputs">
                <input type="text" class="form-control" placeholder="new section" name="course_item_title" value="{{$section->title}}">
                <span class="input-group-btn">
                 <div class="btn-group">
                   
                  <a href="javascript:;" class="btn btn-warning update_course_item" data-type="section" data-id="{{$section->id}}">{{ __('LMS::attributes.courses.edit_unit')}}</a>
                    
            </div>

             </span>
            
           
        </div>
      </div>
