                           
<div class="post-comment block">
                           <div class="travelo-box">
                                   {!! Form::open(["url"=> $locale."/hotels/".$data->id."/comments/create"]) !!}
            
                                       
                                        <div class="form-group">
                                            <label>{{trans('main.label_your_comment')}} *</label>
                                            <textarea rows="6" name="content" class="input-text full-width" placeholder="{{trans('main.write_comment')}}"></textarea>
                                        </div>

                                         <input type="hidden" name="local" value="{{$locale}}">
                                        
                                        <button type="submit" class="btn-large full-width">{{trans('main.btn_send_comment')}}</button>
                                   {!! Form::close() !!}
                                </div>
                            </div>