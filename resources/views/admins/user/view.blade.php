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
        <li class="active">View</li>
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
						<div class="form-group">
							{!! Form::label('', 'User Type', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->user_type}}</p>
							</div>
						</div>


						<div class="form-group">
							{!! Form::label('', 'First Name', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->first_name}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Last name', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->last_name}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Email', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->email}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Phone', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->phone}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Gender', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->gender}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Address', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->address}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Zip code', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$userData->zip_code}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Country', array('for' => 'country_id', 'class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($userData->country_id)?$userData->country->name:'-'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'State', array('for' => 'state_id','class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($userData->state_id)?$userData->state->name:'-'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'City', array('for' => 'city_id', 'class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($userData->city_id)?$userData->city->name:'-'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Total Ads', array('for' => 'city_id', 'class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($userData->product)?$userData->product->count():'-'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Image', array('class' => 'col-md-3 control-label')) !!}

							<div class="col-sm-9">
							  <p class="form-control-static">
								  @if($userData->image)
  								<div class="col-sm-3 no-padding photobox">
  									<div class="add-image">
  										<a href="javascript:void(0)">
  											{{ Html::image('upload/users/'.$userData->image, "For Deleting this picture check the corner picture", ['class'=>'img-responsive thumbnail img no-margin','title'=>"For Deleting this picture checked the corner box"]) }}
  											</a>
  									</div>
  								</div>
  								@else
  								-
  								@endif
							  </p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Newsletter', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($userData->newsletter==1)?'Yes':'No'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Suggestions', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($userData->suggestions==1)?'Yes':'No'}}</p>
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
