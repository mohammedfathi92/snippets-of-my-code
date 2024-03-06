@extends('layouts.auth')

@section('title',trans('corals-admin::labels.auth.register'))
@section('css')
{{--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/flags.authy.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/form.authy.css"/> --}}
    <style type="text/css">
        .login-box, .register-box {
            width: 720px;
            margin: 6% auto;
        }

        @media (max-width: 470px) {
            .login-box, .register-box {
                width: 340px;
            }
        }

        #terms {
            color: black;
        }

        #terms-anchor {
            text-transform: uppercase;
        }

        .select2-results__options {
 
    color: #424242;
}
input[type=search]{
  
   color: #424242;
}
 </style>
@endsection
@section('content')
    <h4 class="login-box-msg">@lang('corals-admin::labels.auth.register_new_account')</h4>

    <form method="POST" action="{{ route('register') }}" class="ajax-form">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" name="name"
                           class="form-control" placeholder="@lang('User::attributes.user.name')"
                           value="{{ old('name') }}" autofocus/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                    @if ($errors->has('name'))
                        <div class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email"
                           class="form-control" placeholder="@lang('User::attributes.user.email')"
                           value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <div class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="@lang('User::attributes.user.password')"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <div class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="@lang('User::attributes.user.retype_password')"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password_confirmation'))
                        <div class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div id="country-div"
                     class="form-group has-feedback {{ $errors->has('country_id') ? ' has-error' : '' }}">
{{--                     <label for="authy-countries"
                           class="control-label hidden-xs">@lang('corals-admin::labels.auth.country')
                        :</label> --}}
                        @php
                        $countriesList = \Modules\Settings\Models\Country::pluck('name_ar', 'id')->toArray();
                        @endphp

                        {!! ModulesForm::select('country_id','corals-admin::labels.auth.country',$countriesList,false,null,[],'select2') !!}
{{--                     <select class="form-control" id="authy-countries" name="phone_country_code" data-value="+966" disabled="">
                        <option value="">@lang('corals-admin::labels.auth.country')</option>
                    </select> --}}
                    {{--<select class="form-control select2" name="mobile_number" >
                        <option value="">المملكة العربية السعودية +966</option>
                    </select>--}}
                    {{-- <input type="hidden" name="phone_country_code" value="+966"> --}}

                   
{{-- 
                    @if ($errors->has('phone_number'))
                        <div class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </div>
                    @endif --}}
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group has-feedback {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                    <label for="authy-cellphone"
                           class="control-label hidden-xs">@lang('corals-admin::labels.auth.cell_phone')
                        :</label>
                    <input class="form-control" id="authy-cellphone"
                           placeholder="@lang('User::attributes.user.cell_phone_number')" type="text"
                           value="{{ old('phone_number') }}"
                           name="phone_number"/>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>

                    @if ($errors->has('phone_number'))
                        <div class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8  col-xs-12">
                <div class="form-group has-feedback {{ $errors->has('terms') ? ' has-error' : '' }}">
                    <div class="checkbox icheck">
                        <label>
                            <input name="terms" value="1" type="checkbox" class="disable-icheck" />
                            <strong>@lang('corals-admin::labels.auth.agree')
                                <a href="#" data-toggle="modal" id="terms-anchor"
                                   data-target="#terms">@lang('corals-admin::labels.auth.terms')</a>
                            </strong>
                        </label>
                    </div>
                    @if ($errors->has('terms'))
                        <span class="help-block"><strong>@lang('corals-admin::labels.auth.accept_terms')</strong></span>
                    @endif
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit"
                        class="btn bg-olive btn-block">@lang('corals-admin::labels.auth.register')</button>
            </div>
        </div>
    </form>
    <br/>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <a class="" href="{{ route('login') }}">@lang('corals-admin::labels.auth.already_have_account')</a><br>
        </div>
    </div>
    @component('components.modal',['id'=>'terms','header'=>\Settings::get('site_name').' Terms and policy'])
        {!! \Settings::get('terms_and_policy') !!}
    @endcomponent
@endsection

@push('js')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/form.authy.js"></script>
    <script type="text/javascript">
        $('#country-div').bind("DOMSubtreeModified", function () {
            $(".countries-input").addClass('form-control');
        });
    </script>--}}
{{--     <script>
        $phoneNumber = $(".phone_number");
        if ($phoneNumber.length) {
            $phoneNumber.intlTelInput({
                separateDialCode: true,
                hiddenInput: "country_code",
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js",
                initialCountry: "auto",
                geoIpLookup: function (success, failure) { // determine the user country code
                    $.get("https://ipinfo.io", function () {
                    }, "jsonp").always(function (resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        success(countryCode);
                    });
                },
                preferredCountries: ['sa', 'eg']
            });
        }
    </script> --}}
@endpush
