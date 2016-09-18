@extends('layouts.app')

@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            @include('dashboard.profile_sidebar')

            <div class="col-sm-9 page-content">
                <div class="inner-box">
                    <div class="row">
                        <div class="col-md-5 col-xs-4 col-xxs-12">
                            <h3 class="no-padding text-center-480 useradmin"> 

                                <a href="#"> {{Html::image(asset('upload/users/'.(($user->image)?$user->image:'default.jpg')), null, ['class'=>"userImg"])}} {{$user->first_name. ' '.$user->last_name}} </a> </h3>
                        </div>
                        <div class="col-md-7 col-xs-8 col-xxs-12">
                            <div class="header-data text-center-xs">

                                <div class="hdata">
                                    <div class="mcol-left">

                                        <i class="fa fa-eye ln-shadow"></i> </div>
                                    <div class="mcol-right">

                                        <p><a href="#">{{$user->product->sum('visitors')}}</a> <em>visits</em></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="hdata">
                                    <div class="mcol-left">

                                        <i class="icon-th-thumb ln-shadow"></i> </div>
                                    <div class="mcol-right">

                                        <p><a href="#">{{$user->product->count()}}</a><em>Ads</em></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="hdata">
                                    <div class="mcol-left">

                                        <i class="fa fa-user ln-shadow"></i> </div>
                                    <div class="mcol-right">

                                        <p><a href="#">{{$user->favourites->count()}}</a> <em>Favorites </em></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inner-box">
                    <div id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> My details </a> </h4>
                            </div>
                            <div class="panel-collapse collapse in" id="collapseB1">
                                <div class="panel-body">
                                    @include ('flash::message')
                                    {!! Form::model($user, array('url' => '/profile', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true)) !!}

                                    <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                        {!! Form::label('user_type', 'User Type', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            <label class="radio-inline" for="radios-0">
                                                {!! Form::radio('user_type', 'Professional', null, ['id'=>'radios-0']) !!}
                                                Private </label>
                                            <label class="radio-inline" for="radios-1">
                                                {!! Form::radio('user_type', 'Individual', null, ['id'=>'radios-1'] ) !!}
                                                Business </label>
                                            @if ($errors->has('user_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('user_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        {!! Form::label('first_name', 'First Name', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('first_name', null, array('class' => 'form-control',  )) !!}

                                            @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        {!! Form::label('last_name', 'Last name', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('last_name', null, array('class' => 'form-control',  )) !!}

                                            @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {!! Form::label('email', 'Email', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('email', null, array('class' => 'form-control',  )) !!}

                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        {!! Form::label('phone', 'Phone', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('phone', null, array('class' => 'form-control',  )) !!}

                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                            <div class="checkbox">
                                                {!! Form::label('hide_phone', ' Hide the phone number on the published ads.' ) !!}

                                                {!! Form::checkbox('hide_phone', 1, null) !!}</div>

                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                        {!! Form::label('gender', 'Gender', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            <label class="radio-inline" for="Male">
                                                {!! Form::radio('gender', 'Male', null, ['id'=>'Male']) !!}
                                                Male </label>
                                            <label class="radio-inline" for="Female">
                                                {!! Form::radio('gender', 'Female', null, ['id'=>'Female']) !!}
                                                Female </label>


                                            @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        {!! Form::label('address', 'Address', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('address', null, array('class' => 'form-control',  )) !!}

                                            @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                        {!! Form::label('zip_code', 'Zip code', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('zip_code', null, array('class' => 'form-control',  )) !!}

                                            @if ($errors->has('zip_code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                        {!! Form::label('country_id', 'Country', array('for' => 'country_id', 'class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('country_id', $countryList, null, ['id' => 'country_id', 'placeholder' => 'Select Country', 'class' => 'form-control',  ]); !!}

                                            @if ($errors->has('country_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('country_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
                                        {!! Form::label('state_id', 'State', array('for' => 'state_id','class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('state_id', $stateList, null, ['id' => 'state_id', 'placeholder' => 'Select State', 'class' => 'form-control',  ]); !!}

                                            @if ($errors->has('state_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('state_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                        {!! Form::label('city_id', 'City', array('for' => 'city_id', 'class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::select('city_id', $cityList, null, ['id' => 'city_id', 'placeholder' => 'Select City', 'class' => 'form-control',  ]); !!}

                                            @if ($errors->has('city_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('city_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                        {!! Form::label('image', 'Image', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::file('image') !!}

                                            @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group{{ $errors->has('newsletter') ? ' has-error' : '' }}">
                                        {!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::checkbox('newsletter', 1, null, ['id'=>'newsletter'] ) !!}
                                            {!! Form::label('newsletter', ' I want to receive newsletter.', ['for'=>'newsletter']  ) !!}

                                            @if ($errors->has('newsletter'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('newsletter') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('suggestions') ? ' has-error' : '' }}">
                                        {!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
                                        <div class="col-sm-9">
                                            {!! Form::checkbox('suggestions', 1, null, ['id'=>'suggestions']) !!}
                                            {!! Form::label('suggestions', ' I want to receive advice on buying and selling.',['for'=>'suggestions'] ) !!}

                                            @if ($errors->has('suggestions'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('suggestions') }}</strong>
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

@section('custom_js')
    <script>
        $(document).ready(function(){
            $("#country_id").on('change', function(){
                var $state = $("#state_id");
                //alert($(this).val());
                $.ajax({
                    'url': "{{url('allStatesByCountryId')}}",
                    'data': {'countryId':$(this).val(), '_token':'{{csrf_token()}}'},
                    'type': 'post',
                    complete:function(response){
                        $state.empty(); // remove old options
                        $.each(JSON.parse(response.responseText), function(key,value) {
                            console.log(key+'-'+value);
                          $state.append($("<option></option>")
                             .attr("value", key).text(value));
                        });
                    }
                })
            });

            $("#state_id").on('change', function(){
                var $city = $("#city_id");
                //alert($(this).val());
                $.ajax({
                    'url': "{{url('allCitiesByStateId')}}",
                    'data': {'stateId':$(this).val(), '_token':'{{csrf_token()}}'},
                    'type': 'post',
                    complete:function(response){
                        $city.empty(); // remove old options
                        $.each(JSON.parse(response.responseText), function(key,value) {
                            console.log(key+'-'+value);
                          $city.append($("<option></option>")
                             .attr("value", key).text(value));
                        });
                    }
                })
            });
        })
    </script>
@endsection
