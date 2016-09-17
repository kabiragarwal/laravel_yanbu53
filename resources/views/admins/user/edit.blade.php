@extends('layouts.admin-app')

@section('headerWithSidebar')
		@include('partials.admin-header')

		@include('partials.admin-sidebar')
@endsection

@section('customCss')
@endsection

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
		  <a href="{{ url()->previous() }}" class='btn btn-danger btn-xs'> <i class="fa fa-arrow-left"></i> Back </a>
        </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i> Users</a></li>
        <li class="active">Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">


            <!-- /.box-header -->
				<div class="box box-info">
	              <div class="box-header with-border">
	                <h3 class="box-title">Update User details</h3>
	              </div>
	              <!-- /.box-header -->
	              <!-- form start -->
	              {!! Form::model($userData, array('url' => '/admin/user_update', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true)) !!}
				  {!! Form::hidden('id', $userData->id) !!}
	                <div class="box-body">
						@include ('flash::message')
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
								{!! Form::text('first_name', null, array('class' => 'form-control', 'required')) !!}

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
								{!! Form::text('last_name', null, array('class' => 'form-control', 'required')) !!}

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
								{!! Form::text('email', null, array('class' => 'form-control', 'required'  )) !!}

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
								{!! Form::text('phone', null, array('class' => 'form-control', 'required'  )) !!}

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
								{!! Form::text('address', null, array('class' => 'form-control', 'required'  )) !!}

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
								{!! Form::text('zip_code', null, array('class' => 'form-control', 'required'  )) !!}

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
								{!! Form::select('country_id', $countryList, null, ['id' => 'country_id', 'placeholder' => 'Select Country', 'class' => 'form-control',  'required' ]); !!}

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
								{!! Form::select('state_id', $stateList, null, ['id' => 'state_id', 'placeholder' => 'Select State', 'class' => 'form-control', 'required'  ]); !!}

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
								{!! Form::select('city_id', $cityList, null, ['id' => 'city_id', 'placeholder' => 'Select City', 'class' => 'form-control',  'required' ]); !!}

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

						<div class="form-group ">
							{!! Form::label('image', 'Current Image', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-md-8">
								<div class="mb10">
									<div class="col-sm-3 no-padding photobox">
										<div class="add-image">
											<span class="photo-count">
												<i class="fa fa-trash-o"></i> {!! Form::checkbox('old_image', $userData->id, null, ['id'=>"$userData->id"]) !!}
											</span>
											<a href="javascript:void(0)">
												{{ Html::image('upload/users/'.$userData->image, "For Deleting this picture check the corner picture", ['class'=>'img-responsive thumbnail img no-margin','title'=>"For Deleting this picture checked the corner box"]) }}
												</a>
										</div>
									</div>
								</div>
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
							  <button type="submit" class="btn btn-info pull-left">Update</button>
						  </div>
					  </div>

	                </div>
	             {!! Form::close() !!}
	            </div>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('partials.page_footer')



@endsection



@section('customJs')
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
