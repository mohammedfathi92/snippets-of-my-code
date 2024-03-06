@extends("layouts.app")
@section("content")

    <div class="row">

        <!-- Panel -->
        <div class="panel">
            <div class="panel">
                <ol class="breadcrumb">
                    <li><a href="{{url("/")}}">{{trans("main.link_home")}}</a></li>
                    <li><a href="{{url("/manage")}}">{{trans("main.link_management")}}</a></li>
                    <li class="active">{{trans("contacts.link_contact_us")}}</li>

                </ol>
            </div>
            <div class="panel-body ">

                <div class="">
                    <table class="tablesaw table-striped table-bordered" data-tablesaw-mode="swipe"
                           data-tablesaw-mode-switch data-tablesaw-minimap data-tablesaw-mode-exclude="columntoggle">
                        <thead>
                        <tr>
                            <th>{{trans('contacts.from')}}</th>
                            <th>{{trans('contacts.subject')}}</th>
                            <th>{{trans('contacts.message')}}</th>
                            <th>{{trans('contacts.sent_at')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data and count($data))
                            @foreach($data as $row)
                                <tr class="{{!$row->opened?"alert alert-danger":""}}" style="{{!$row->opened?"background-color:rgba(255,205,210,.8)":""}}">
                                    <td>
                                        @if($row->opened)
                                           <span> {{$row->sender->name}}</span>
                                            @else
                                            <strong>{{$row->sender->name}}</strong>
                                        @endif
                                    </td>
                                    <td>{!! Html::link("manage/contacts/$row->id/message",str_limit($row->subject,100)) !!}</td>
                                    <td>{{str_limit($row->message,150)}}</td>
                                    <td>{{\Carbon\Carbon::instance($row->created_at)->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">

                                        <p class="alert alert-warning text-center">
                                            {{trans('contacts.no_messages')}}

                                        </p>

                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class=" align-left">
                    {!! $data->links() !!}
                </div>


            </div>
        </div>
        <!-- End Panel -->
    </div>
@endsection