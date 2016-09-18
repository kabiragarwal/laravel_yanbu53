@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 login-box">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="logo-title"> Reset Password</h2>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            @include ('flash::message')
                            <form method="post" action="{{ url('/password_reset') }}" class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $userData->token }}">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="user-pass" class="control-label">Password:</label>
                                    <div class="input-icon"> <i class="icon-lock fa"></i>
                                        <input type="password" required name="password" class="form-control" placeholder="Password" id="user-pass">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="user-pass" class="control-label">Confirm Password:</label>
                                    <div class="input-icon"> <i class="icon-lock fa"></i>
                                        <input type="password" required name="password_confirmation" class="form-control" placeholder="Confirm Password" id="user-pass">
                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary  btn-block" id="inputPassword3" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <p class="text-center "> <a href="{{url('signin')}}"> Back to Login </a> </p>
                        <div style=" clear:both"></div>
                    </div>
                </div>
                <div class="login-box-btm text-center">
                    <p> Don't have an account? <br>
                        <a href="{{url('signup')}}"><strong>Sign Up !</strong> </a> </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
