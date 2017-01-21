@extends('layouts.auth')

@section('styles')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Password</h3>
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form class="" role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input class="form-control" id="email" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Send Password Reset Link
                                        </button>
                                    </div>
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
@endsection
