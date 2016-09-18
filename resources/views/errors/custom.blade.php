@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 login-box">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="logo-title"> Error Page Custom</h2>
                    </div>
                    <div class="panel-body">
                        this is a Custom error page.
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
