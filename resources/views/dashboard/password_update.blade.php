@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')

            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <h2 class="title-2"><i class="icon-cog "></i> Settings  </h2>
                    <div id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> Update Password </a> </h4>
                            </div>
                            <div class="panel-collapse collapse in" id="collapseB1">
                                <div class="panel-body">
                                    @include ('flash::message') 
                                    {!! Form::model(new App\User, array('url' => '/password_update', 'method' => 'post', 'class' => 'form-horizontal')) !!}
									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        {!! Form::label('password', 'Password', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::input('Password', 'password', null, ['class' => 'form-control','type' => 'password']) !!}

                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        {!! Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control','type' => 'password']) !!}

                                            @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary btn-default">Update</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
					
					
                </div> 
            </div>

        </div>

    </div>

</div>

@endsection