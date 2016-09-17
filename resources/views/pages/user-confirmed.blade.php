@extends('layouts.app')

@section('content')
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="login-box">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h2 class="">Your Account has been successfully verified, Please <a href="{{ url('/signin') }}">login here</a></h2>
                    </div>
                    <div class="panel-body">
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection