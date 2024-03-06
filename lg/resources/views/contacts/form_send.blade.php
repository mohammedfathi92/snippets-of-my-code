@extends("layouts.app")
@section("content")
    <div class="panel">
        <div class="panel-heading">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>

                    <li class="active">{{trans("contacts.link_contact_us")}}</li>
                </ol>
            </div>
        </div>
        <div class="panel-body container-fluid">


            <div class="row row-lg">

                <form action="" method="post" class="form-horizontal labelbold" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- Example Input Sizing -->
                    <div class="example-wrap">
                        <div class="col-sm-8">


                            <div class="form-group  form-group form-material-lg {{$errors->has('subject')?'has-error':''}}">

                                <label class="col-sm-3 control-label" for="subject">
                                    {{trans("contacts.label_subject")}} *
                                </label>

                                <div class="col-sm-9">
                                    {!! Form::text("subject",old("subject"),['class'=>'form-control','id'=>'subject']) !!}
                                    @if ($errors->has('subject'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group  form-group form-material-lg {{$errors->has('message')?'has-error':''}}">

                                <label class="col-sm-3 control-label" for="message">
                                    {{trans("contacts.label_message")}} *
                                </label>

                                <div class="col-sm-9">
                                    {!! Form::textarea("message",old("message"),['class'=>'form-control','id'=>'message']) !!}
                                    @if ($errors->has('subject'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('message') }}</strong>
                                                </span>
                                    @endif
                                </div>

                            </div>

                            <!-- End Example Input Sizing -->
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit">
                                {{trans('contacts.btn_send')}}
                            </button>

                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection