@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 login-box">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="logo-title"> Forgot Password </h2>
                    </div>
                    <div class="panel-body"><div class="panel-body">
                            @include ('flash::message') 
                        <form method="post" action="{{ url('/forgot_password') }}" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="sender-email" class="control-label">Email:</label>
                                    <div class="input-icon"> <i class="icon-mail fa"></i>
                                        <input id="sender-email" required name="email" type="text" placeholder="email" class="form-control email">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Send me my password</button>
                            </div>
                        </form>
                    </div></div>
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