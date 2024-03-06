@extends('layouts.auth')
@section('content')
    <div class="brand">
        <img class="brand-img" src="mmenu/assets//images/logo1.png" alt="...">
        <h2 class="brand-text">LG Partners Club</h2>
    </div>


    {!! Form::open(['autocomplete'=>'off']) !!}

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
        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
    </div>





    <div class="form-group clearfix">
        <div class="checkbox-custom checkbox-inline checkbox-primary pull-left">
            <input type="checkbox" id="rememberCheckbox" name="remember" >
            <label for="rememberCheckbox">Remember my login</label>
        </div>

    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40 waves-effect waves-light">Sign in</button>

    {!! Form::close() !!}
    <p>Still no account? Please go to <a href="register">Register</a></p>
@endsection

