@extends('layouts.auth')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/intltelinput/css/intlTelInput.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/intltelinput/css/demo.css')}}" type="text/css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body">
                        <form class="" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input class="form-control" id="name" type="text" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input class="form-control" id="email" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif </div>
                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <div><input id="mobile" placeholder="mobile" value="{{ old('mobile') }}" class="form-control" name="mobile" type="tel" required>
                                    </div>
                                    <input id="country_code" class="form-control" value="{{ old('country_code') }}" name="country_code" type="hidden" required>
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('country_code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('country_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" class="form-control" placeholder="Password" name="password" type="password" value="">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif </div>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input class="form-control" id="password-confirm" type="password" placeholder="Confirm Password"
                                           name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            SignUp
                                        </button>
                                    </div>

                                    <a class="btn" href="{{ url('/login') }}">
                                        Already have account
                                    </a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('vendor/intltelinput/js/intlTelInput.js') }}"></script>

    <script>
        $(document).ready(function () {
            var mobile = $('#mobile');
            mobile.intlTelInput({
                autoHideDialCode: false,
                autoPlaceholder: "on",
                dropdownContainer: "body",
                formatOnDisplay: true,
                geoIpLookup: function (callback) {
                    $.get("http://ipinfo.io", function () {
                    }, "jsonp").always(function (resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                    });
                },
                nationalMode: true,
                placeholderNumberType: "MOBILE",
                preferredCountries: [],
                separateDialCode: true
            });
            $(function(){
                $('#country_code').val($('.selected-dial-code').text());
            });

            $('#mobile').select (function() {
                $('#country_code').val($('.selected-dial-code').text());
            });
        });

    </script>
@endsection
