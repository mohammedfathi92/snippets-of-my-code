<?php /**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 9/7/16
 * Time: 5:15 PM
 */ ?>
@extends("backend.layouts.master")

@section('page_header')
    <h1 class="page-title">
        <i class="icon icon-lock"></i> {{trans("permissions.backend_create_page_header")}}
    </h1>
@stop

@section("content")
    <div class="page-content container-fluid">
        @include('flash::message')

        <div class="row">
            <div class="col-md-12 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['class'=>'form-horizontal']) !!}

                        <div class="col-md-12">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group {{$errors->has('name')?"has-error":''}}">
                                    <label for="name"
                                           class="col-sm-3 control-label">{{trans("permissions.label_name")}}
                                        <span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="name"
                                               placeholder="" value="{{old('name')}}">
                                        <span class="help-block">
                                        {{ trans("permissions.help_role_name") }}
                                        </span>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                               <div class="form-group {{$errors->has('permissions')?"has-error":''}}">
                                   <label for="permissions"
                                          class="col-md-3 control-label">{!! trans("permissions.label_permissions") !!}
                                       <strong
                                               class='text-danger'> *</strong></label>

                                   <div class="col-md-9">
                                       <select name="permissions[]" id="permissions" class="select2 form-control" multiple>
                                           @if($permissions)
                                               @foreach($permissions as $row)
                                                   <option value="{{$row->name}}" @if(in_array($row->name,old('permissions',[]))) selected @endif>{{$row->name}}</option>
                                               @endforeach
                                           @endif
                                       </select>
                                       @if ($errors->has('permissions'))
                                           <span class="help-block">
                                        <strong>{{ $errors->first('permissions') }}</strong>
                                    </span>
                                       @endif
                                   </div>
                               </div>
                            </div>

                        </div>

                        <div class="form-group margin-none">
                            <div class="pull-right col-sm-9">
                                <button type="submit"
                                        class="btn btn-primary">{{trans("main.btn_create")}}</button>
                            </div>
                        </div>

                    </div>


                </div>

            </div>


            {!! Form::close() !!}
        </div>
    </div>


    </div>

    </div>
    <!-- /st-content-inner -->

    </div>
    <!-- /st-content -->
@endsection
@section("footer-scripts")
    <script>
        $(".select2").select2();
    </script>

@endsection
