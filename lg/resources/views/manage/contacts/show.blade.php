@extends("layouts.app")
@section("content")

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li><a href="{{url("/manage/contacts")}}">{{trans("main.link_contact_us")}}</a></li>
                    <li class="active">{{ str_limit($data->subject,20) }}</li>

                </ol>
            </div>
            <div class="panel-body ">
                {!! Form::open(['url'=>"manage/contacts/$data->id/reply","class"=>"form-horizontal labelbold"]) !!}
                <div class="form-group">
                    <label  class="control-label col-md-3">{{trans("contacts.from")}}</label>
                    <div class="col-md-9">
                        <p>{!! Html::link("profile/{$data->sender->id}",$data->sender->name) !!}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3">{{trans("contacts.sent_at")}}</label>
                    <div class="col-md-9">
                        <p>{{$data->created_at}} <strong class="label label-default">{{\Carbon\Carbon::instance($data->created_at)->diffForHumans()}}</strong>  </p>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-md-3"></label>
                    <div class="col-md-9">
                        <p>{{$data->subject}}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label col-md-3"></label>
                    <div class="col-md-9">
                        <pre>{{$data->message}}</pre>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- End Panel -->
    </div>
@endsection