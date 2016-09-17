@extends('layouts.admin-app')


@section('content')
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 login-box admin-login-box">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="logo-title"> Admin Panel </h2>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            @include ('flash::message') 
                            <form method="post" action="{{ url('admin/admin_login') }}" class="form-horizontal">
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
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary  btn-block" id="inputPassword3" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="1" name="remember" id="remember">
                            Keep me logged in </label>
                        <!--<p class="text-center pull-right"> <a href="{{url('forgot_password')}}"> Lost your password? </a> </p> -->
                        <div style=" clear:both"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

