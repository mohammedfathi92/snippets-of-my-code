@extends('layouts.auth')
@section('content')
    <div class="brand">
        <img class="brand-img" src="mmenu/assets//images/logo1.png" alt="...">
        <h2 class="brand-text">LG Partners Club</h2>
        <p class="redtext">Register your Account</p>
    </div>


    {!! Form::open(['autocomplete'=>'off']) !!}

    <div class="form-group required text-left{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="floating-label">Name</label>

        <input id="name" type="text" class="form-control empty" name="name" value="{{ old('name') }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

    </div>
    <div class="form-group required text-left {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="floating-label ">E-Mail Address</label>

        <input id="email" type="email" class="form-control empty" name="email"
               value="{{ old('email') }}">

        @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

    </div>
    <div class="form-group required text-left{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="floating-label ">Password</label>

        <input id="password" type="password" class="form-control empty" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

    </div>
    <div class="form-group required text-left{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="floating-label ">Confirm Password</label>

        <input id="password-confirm" type="password" class="form-control empty"
               name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif

    </div>
    <div class="form-group text-left{{ $errors->has('company') ? ' has-error' : '' }}">
        <label class="floating-label " for="company">Company Name</label>
        <input type="text" class="form-control empty" id="company" name="company" value="{{old("company")}}">

    </div>
    <div class="form-group required text-left{{ $errors->has('type') ? ' has-error' : '' }}">
        <label class="floating-label " for="type">{{trans("users.label_account_type")}}</label>
        <select name="type" id="type" class="form-control">
            <option value="" disabled>{{trans("users.select_account_type")}}</option>
            <option value="b2b" {{old("type")=="b2b"?"selected":""}}>{{trans("products.option_type_b2b")}}</option>
            <option value="b2c" {{old("type")=="b2c"?"selected":""}}>{{trans("products.option_type_b2c")}}</option>
        </select>

    </div>
    <div class="form-group text-left{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="floating-label" for="address">Address</label>
        <input type="text" class="form-control empty" id="address" name="address" value="{{old("address")}}">

    </div>
    <div class="form-group required text-left{{ $errors->has('annual_sales') ? ' has-error' : '' }}">
        <label class="floating-label" for="annual_sales">Annual sales</label>
        <input type="text" class="form-control empty" id="annual_sales" name="annual_sales"
               value="{{old("annual_sales")}}">

    </div>
    <div class="form-group clearfix">
        <div class="checkbox-custom checkbox-inline checkbox-primary pull-left">
            <input type="checkbox" id="agreeCheckbox" name="agree" required {{old("agree")==1?"checked":""}}>
            <label for="agreeCheckbox">I agree with the data protection policy. <a
                        href="http://www.lg.com/eg_en/privacy" target="_blank">Read Policy</a></label>
        </div>

    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40 waves-effect waves-light">Register
    </button>

    {!! Form::close() !!}
    <p>You already have account? Please go to <a href="/login">Login</a></p>
@endsection
