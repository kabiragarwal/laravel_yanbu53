@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')
            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    @include ('flash::message')
                    {{ Form::open(array('url'=>'/account-close', 'method'=>'post'))}}
                    <h2 class="title-2"><i class="icon-cancel-circled "></i> Close account </h2>
                    <p>You are sure you want to close your account?</p>
                    <div> <label class="radio-inline" for="radios-0">
                        {{ Form::radio('close', 1, null, array('id'=>"radios-0")) }} Yes
                        </label>
                        <label class="radio-inline" for="radios-1">
                            {{ Form::radio('close', 0, null, array('id'=>"radios-1")) }} No
                        </label></div>
                    <br>
                     {{ Form::submit('Submit', ['class'=>"btn btn-primary"]) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@section('custom_js')
@endsection
</div>

@endsection
