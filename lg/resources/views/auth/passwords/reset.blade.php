@extends('layouts.auth')
@section('content')
    <div class="brand">
        <img class="brand-img" src="/mmenu/assets//images/logo1.png" alt="...">
        <h2 class="brand-text">LG Digital Signature</h2>
        <p class="redtext">Reset Password</p>
    </div>


    {!! Form::open(['url'=>'/password/reset','autocomplete'=>'off']) !!}

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
    <div class="form-group text-left{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="floating-label ">Password</label>

        <input id="password" type="password" class="form-control empty" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

    </div>

    <div class="form-group text-left{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="floating-label ">Confirm Password</label>

        <input id="password-confirm" type="password" class="form-control empty"
               name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif

    </div>

    <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40 waves-effect waves-light"> Reset
        Password
    </button>

    {!! Form::close() !!}
@endsection
