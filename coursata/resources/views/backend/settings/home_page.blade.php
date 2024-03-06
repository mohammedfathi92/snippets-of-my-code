@extends('backend.layouts.master')

@section('css')
    <style>
        .panel-actions .icon-trash {
            cursor: pointer;
        }

        .panel-actions .icon-trash:hover {
            color: #e94542;
        }

        .panel hr {
            margin-bottom: 10px;
        }

        .panel {
            padding-bottom: 15px;
        }

        .sort-icons {
            font-size: 21px;
            color: #ccc;
            position: relative;
            cursor: pointer;
        }

        .sort-icons:hover {
            color: #37474F;
        }

        .icon-sort-desc {
            margin-right: 10px;
        }

        .icon-sort-asc {
            top: 10px;
        }

        .page-title {
            margin-bottom: 0px;
        }

        .panel-title code {
            border-radius: 30px;
            padding: 5px 10px;
            font-size: 11px;
            border: 0px;
            position: relative;
            top: -2px;
        }

        .new-setting {
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }

        .new-setting .panel-title {
            margin: 0px auto;
            display: inline-block;
            color: #999fac;
            font-weight: lighter;
            font-size: 13px;
            background: #fff;
            width: auto;
            height: auto;
            position: relative;
            padding-right: 15px;
        }

        .new-setting hr {
            margin-bottom: 0px;
            position: absolute;
            top: 7px;
            width: 96%;
            margin-left: 2%;
        }

        .new-setting .panel-title i {
            position: relative;
            top: 2px;
        }

        .new-settings-options {
            display: none;
            padding-bottom: 10px;
        }

        .new-settings-options label {
            margin-top: 13px;
        }

        .new-settings-options .alert {
            margin-bottom: 0px;
        }

        #toggle_options {
            clear: both;
            float: right;
            font-size: 12px;
            position: relative;
            margin-top: 15px;
            margin-right: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            z-index: 9;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .new-setting-btn {
            margin-right: 15px;
            position: relative;
            margin-bottom: 0px;
            top: 5px;
        }

        .new-setting-btn i {
            position: relative;
            top: 2px;
        }

        .img_settings_container {
            width: 200px;
            height: auto;
            position: relative;
        }

        .img_settings_container > a {
            position: absolute;
            right: -10px;
            top: -10px;
            display: block;
            padding: 5px;
            background: #F94F3B;
            color: #fff;
            border-radius: 13px;
            width: 25px;
            height: 25px;
            font-size: 15px;
            line-height: 19px;
        }

        .img_settings_container > a:hover, .img_settings_container > a:focus, .img_settings_container > a:active {
            text-decoration: none;
        }

        textarea {
            min-height: 120px;
        }
    </style>
@stop

@section('head')
    <script type="text/javascript" src="/backend/lib/js/jsonarea/jsonarea.min.js"></script>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="icon-settings"></i> Settings
    </h1>
@stop

@section('content')

    <div class="page-content container-fluid">

         {!! Form::open(['route'=> 'app.settings','name'=>'homepage_settings_form','novalidate','method'=>'put']) !!}
            <div class="panel">
                @foreach($settings as $setting)
                    <div class="panel-heading">
                        <h3 class="panel-title"> {{ $setting->display_name }} </h3>
                        <div class="panel-actions">
                            <a href="/{{Settings::get('backend_uri')}}/settings/move_up/{{ $setting->id }}"><i
                                        class="sort-icons icon-sort-asc"></i></a>
                            <a href="/{{Settings::get('backend_uri')}}/settings/move_down/{{ $setting->id }}"><i
                                        class="sort-icons icon-sort-desc"></i></a>
                           {{-- @if(!in_array($setting->key ,$core_settings))
                                <i class="icon-trash" data-id="{{ $setting->id }}"
                                   data-display="{{ $setting->display_name }}"></i>
                            @endif--}}
                        </div>
                    </div>
                    <div class="panel-body">

                        @if($setting->type == "text")
                            <input type="text" class="form-control" name="{{ $setting->key }}"
                                   value="{{ $setting->value }}">
                        @elseif($setting->type == "text_area")
                            <textarea class="form-control"
                                      name="{{ $setting->key }}">@if(isset($setting->value)){{ $setting->value }}@endif</textarea>
                        @elseif($setting->type == "rich_text_box")
                            <textarea class="form-control richTextBox"
                                      name="{{ $setting->key }}">@if(isset($setting->value)){{ $setting->value }}@endif</textarea>
                        @elseif($setting->type == "image")
                            
                          <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("photo")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="settings_"
                    >

                        <div class="">
                            <div class="">
                               @if($setting->value && Storage::disk('public')->exists(config('settings.upload_dir')."/".$setting->value))
                                 
                                    <div class="thumbnail" id="file-{{$setting->value}}" data-ng-if="!photo">
                                        <img src="{{url("files/small/{$setting->value}")}}" alt=""
                                             class="responsive-img img-thumbnail">
                                        <input type="hidden" name="{{$setting->key}}" value="{{$setting->value}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{$setting->value}}')">{{trans("main.btn_delete")}}</a>
                                    </div>
                                @endif
                                <div ng-repeat="f in photos">
                                    <div class="thumbnail">
                                        <img ng-show="form.photo.$valid" ngf-thumbnail="f"
                                             class=" img-thumbnail"  width="320" height="240">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removePhoto($index)"
                                           ng-show="photo">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 10M</i>
                                        <input type="hidden" name="{{$setting->key}}" value="<%f.result.file%>"
                                               ng-if="f && f.progress==100">
                                        <div class="progress  active" ng-show="f.progress >= 0"
                                             ng-hide="f.progress==100"
                                             ng-if="f">
                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                 role="progressbar" aria-valuenow="<%f.progress%>"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100" style="width: <%f.progress%>%">
                                                <span class="sr-only"><% f.progress %> % Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <a id="photo"
                               class="btn btn btn-default"
                               ngf-select="uploadPhoto($files, $invalidFiles)"
                               ng-model="photo"
                               ngf-pattern="'image/*'"
                               ngf-accept="'image/*'"
                               ngf-max-size="10MB">
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>

                            @if ($errors->has('photo'))
                                <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>


                </div>

                          
        @elseif($setting->type == "video")
                             <!--video -->
                <div class="card">
                

                <div class="card-body">
                    <div class="card-block">
                  <div class="panel-body">
                    <div class="form-group text-center {{$errors->has("videos")?"has-error":''}}"
                         data-ng-controller="backendUploaderCtrl"
                         data-upload-url="{{url("$locale/$backend_uri/upload")}}"
                         data-resize="200,150"
                         data-prefix="settings_"
                    >
                        <div class="">
                            <a id="gallery"
                               class="btn btn btn-default"
                               ngf-select="uploadVideo($files, $invalidFiles)"
                               ng-model="video"
                               ngf-pattern="'video/*'"
                               ngf-accept="'video/*'"
                               ngf-max-size="10000MB"
                               style="height: 20px, width:70px"
                               
                            >
                                <i class="fa fa-upload"></i> {{trans("main.btn_upload")}}
                            </a>
                            @if ($errors->has('videos'))
                                <span class="help-block">
                                <strong>{{ $errors->first('videos') }}</strong>
                            </span>
                            @endif
                            <div class="clearfix"></div>
                            <div class="">
                                @if($setting->value && Storage::disk('public')->exists(config('settings.upload_dir')."/".$setting->value))
                                 
                                    <div class="" id="file-{{$setting->value}}" data-ng-if="!video">
                                        <video width="320" height="240" controls>
                                        <source src='{{url("video/{$setting->value}")}}' type="video/mp4">
                                Your browser does not support the video tag.
                                  </video>
                            
                                        <input type="hidden" name="{{$setting->key}}" value="{{$setting->value}}">
                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeByName('{{$setting->value}}')">{{trans("main.btn_delete")}}</a>
                                    </div>
                                @endif

                                <div ng-repeat="f in videos">
                                    <div class="thumbnail">
                                        <video  ngf-src="'/video/'+f.result.file" ng-show="f.result.file" 
                                            id="my-player"
                                           class="video-js"
                                           controls
                                           preload="auto"
                                           data-setup='{}' width="320" height="240">
                                        </video>

                                        <a href="javascript:;" class="btn btn-danger"
                                           ng-click="removeVideo($index)"
                                           ng-show="gallery">{{trans("main.btn_delete")}}</a>
                                        <br>
                                        <i ng-show="f.$error.required">*required</i>
                                        <i ng-show="f.$error.maxSize">File too large
                                            <%errorFile.size / 1000000|number:1%>MB: max 1000M</i>
                                        <input type="hidden" name="{{ $setting->key }}" value="<%f.result.file%>">
                                              
                                        <div class="progress  active" ng-show="f.progress >= 0"
                                             ng-hide="f.progress==100"
                                             ng-if="f">
                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                 role="progressbar" aria-valuenow="<%f.progress%>"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100" style="width: <%f.progress%>%">
                                                <span class="sr-only"><% f.progress %> % Complete</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
            
            <!-- End videos -->
                        @elseif($setting->type == "select_dropdown")
                            <?php $options = json_decode($setting->details); ?>
                            <?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
                            <select class="form-control" name="{{ $setting->key }}">
                                <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                                @if(isset($options->options))
                                    @foreach($options->options as $index => $option)
                                        <option value="{{ $index }}" @if($default == $index && $selected_value === NULL){{ 'selected="selected"' }}@endif @if($selected_value == $index){{ 'selected="selected"' }}@endif>{{ $option }}</option>
                                    @endforeach
                                @endif
                            </select>

                        @elseif($setting->type == "radio_btn")
                            <?php $options = json_decode($setting->details); ?>
                            <?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
                            <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                            <ul class="radio">
                                @if(isset($options->options))
                                    @foreach($options->options as $index => $option)
                                        <li>
                                            <input type="radio" id="option-{{ $index }}" name="{{ $setting->key }}"
                                                   value="{{ $index }}" @if($default == $index && $selected_value === NULL){{ 'checked' }}@endif @if($selected_value == $index){{ 'checked' }}@endif>
                                            <label for="option-{{ $index }}">{{ $option }}</label>
                                            <div class="check"></div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

                        @elseif($setting->type == "checkbox")

                            <?php $options = json_decode($setting->details); ?>
                            <?php $checked = (isset($setting->value) && $setting->value == 1) ? true : false; ?>
                            @if(isset($options->on) && isset($options->off))
                                <input type="checkbox" name="{{ $setting->key }}" class="toggleswitch"
                                       @if($checked) checked @endif data-on="{{ $options->on }}"
                                       data-off="{{ $options->off }}">
                            @else
                                <input type="checkbox" name="{{ $setting->key }}" @if($checked) checked
                                       @endif class="toggleswitch">
                            @endif


                        @endif

                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach
            </div><!-- .panel -->
            <button type="submit" class="btn btn-primary pull-right">Save Settings</button>
         {!! Form::close() !!}

        <div class="clearfix"></div>

        <!-- Close this blow div -->

        <div class="panel" style="margin-top:10px;">
            <div class="panel-heading new-setting">
                <hr>
                <h3 class="panel-title"><i class="icon-plus"></i> New Setting</h3>
            </div>
            <div class="panel-body">

                <form action="/{{$locale."/".$backend_uri}}/settings/create" method="POST">

                    <div class="col-md-4">
                        <label for="display_name">Name</label>
                        <input type="text" class="form-control" name="display_name">
                    </div>

                    <div class="col-md-4">
                        <label for="key">Key</label>
                        <input type="text" class="form-control" name="key">
                    </div>

                    <div class="col-md-4">
                        <label for="asdf">Type</label>
                        <select name="type" class="form-control">
                            <option value="text">Text Box</option>
                            <option value="text_area">Text Area</option>
                            <option value="rich_text_box">Rich Textbox</option>
                            <option value="checkbox">Check Box</option>
                            <option value="radio_btn">Radio Button</option>
                            <option value="select_dropdown">Select Dropdown</option>
                            <option value="file">File</option>
                            <option value="image">Image</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <a id="toggle_options"><i class="icon-double-down"></i> OPTIONS</a>
                        <div class="new-settings-options">
                            <label for="options">Options
                                <small>(optional, only applies to certain types like dropdown box or radio button)
                                </small>
                            </label>
                            <textarea name="details" id="options_textarea" class="form-control"></textarea>
                            <div id="valid_options" class="alert-success alert" style="display:none">Valid Json</div>
                            <div id="invalid_options" class="alert-danger alert" style="display:none">Invalid Json</div>
                        </div>
                    </div>
                    <script>
                        // do the deal
                        var myJSONArea = JSONArea(document.getElementById('options_textarea'), {
                            sourceObjects: [] // optional array of objects for JSONArea to inherit from
                        });

                        valid_json = false;

                        // then here's how you use JSONArea's update event
                        myJSONArea.getElement().addEventListener('update', function (e) {
                            if (e.target.value != "") {
                                if (e.detail.isJSON) {
                                    valid_json = true;
                                } else {
                                    valid_json = false;
                                }
                            }
                        });

                        myJSONArea.getElement().addEventListener('focusout', function (e) {
                            if (valid_json) {
                                $('#valid_options').show();
                                $('#invalid_options').hide();
                                var ugly = e.target.value
                                var obj = JSON.parse(ugly);
                                var pretty = JSON.stringify(obj, undefined, 4);
                                document.getElementById('options_textarea').value = pretty;
                            } else {
                                $('#valid_options').hide();
                                $('#invalid_options').show();
                            }
                        });
                    </script>
                    <script>
                        $('document').ready(function () {
                            $('#toggle_options').click(function () {
                                $('.new-settings-options').toggle();
                                if ($('#toggle_options .icon-double-down').length) {
                                    $('#toggle_options .icon-double-down').removeClass('icon-double-down').addClass('icon-double-up');
                                } else {
                                    $('#toggle_options .icon-double-up').removeClass('icon-double-up').addClass('icon-double-down');
                                }
                            });
                        });
                    </script>

                    <div style="clear:both"></div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary pull-right new-setting-btn"><i class="icon-plus"></i>
                        Add New Setting
                    </button>
                    <div style="clear:both"></div>
                </form>

            </div>
        </div>

    </div>

    {{--<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-trash-o"></i> Are you sure you want to delete the <span
                                id="delete_setting_title"></span> Setting?</h4>
                </div>
                <div class="modal-footer">
                    <form action="/{{$locale}}/{{$backend_uri}}/settings/" id="delete_form" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Yes, Delete This Setting">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->--}}

    <script>
        $('document').ready(function () {
            $('.icon-trash').click(function () {
                id = $(this).data('id');
                display = $(this).data('display');
                $('#delete_setting_title').text(display);
                $('#delete_form').attr('action', '/{{$locale}}/{{$backend_uri}}/settings/' + id);
                $('#delete_modal').modal('show');
            });

            $('.toggleswitch').bootstrapToggle();

        });
    </script>

@stop

@section('javascript')

    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="my_form" action="/{{$locale}}/{{$backend_uri}}/upload" target="form_target" method="POST"
          enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
        <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
        <input type="hidden" name="type_slug" id="type_slug" value="settings">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>{{--

    <script src="/backend/lib/js/tinymce/tinymce.min.js"></script>
    <script src="/backend/js/developnet_tinymce.js"></script>--}}
@stop