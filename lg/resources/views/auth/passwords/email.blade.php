@extends('layouts.auth')

@section('content')
    <div class="brand">
        <img class="brand-img" src="/mmenu/assets//images/logo1.png" alt="...">
        <h2 class="brand-text">LG Digital Signature</h2>
        <p class="redtext">Reset Password</p>
    </div>


    {!! Form::open(['url'=>'/password/email','autocomplete'=>'off']) !!}

    <div class="form-group text-left {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="floating-label ">E-Mail Address</label>

        <input id="email" type="email" class="form-control empty" name="email"
               value="{{ old('email') }}">

        @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

    </div>

    <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40 waves-effect waves-light"> Send Password Reset Link</button>

    {!! Form::close() !!}
@endsection


<!-- Main Content -->
@section('contents')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
