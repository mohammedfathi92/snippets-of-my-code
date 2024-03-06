<div class="row nomargin-bottom">

<div class="col-md-6 col-sm-6 margin-bottom-15">

  <center><h3>{{trans('bookings.choose_user_list')}}</h3></center>

        <br>

   <label for="houseID">{{trans("bookings.label_users")}} <span
                                                  style="color:#F00;">*</span></label>
                                      <select class="form-control select2" id="user"
                                              name="user">
                                          <option selected="selected"
                                                  value="">{{trans("main.select_option")}}</option>

                                             @foreach($data as $row)     
                                          <option value="{{$row->id}}">
                                            {{$row->name}}
                                          </option>
                                          @endforeach
                                         
                                      </select>     
                
            </div>

          </div>

              <link rel="stylesheet" type="text/css" href="/backend/lib/css/select2.min.css">


    <script type="text/javascript" src="/backend/lib/js/select2.full.min.js"></script>