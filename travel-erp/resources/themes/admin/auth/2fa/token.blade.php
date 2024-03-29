@extends('layouts.auth')

@section('title','Login')

@section('content')
    <div class="register-logo">
    </div>

    <div class="register-box-body">
        <p>{{trans('Packages-admin::labels.auth.token_has_been_sent',['name' => $user->phone])}}</p>
        <p>@lang('Packages-admin::labels.auth.verify_login_here')</p>
        <form method="POST" action="{{url('auth/token')}}">
            {!! csrf_field() !!}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group has-feedback">
                <input type="text" name="token" class="form-control" placeholder="@lang('User::attributes.user.password')">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success btn-block">@lang('Packages-admin::labels.auth.verify_token')</button>
                    <br/>
                    <a class="" href="{{ url('auth/token') }}">@lang('Packages-admin::labels.auth.send_token')</a><br>
                </div><!-- /.col -->
            </div>
        </form>
    </div><!-- /.form-box -->
@endsection

@section('js')
@endsection