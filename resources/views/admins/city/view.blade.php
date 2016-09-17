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
    	  <li><a href="{{ url('admin/cities') }}"><i class="fa fa-th"></i> City</a></li>
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
	                <h3 class="box-title">View City details</h3>
	              </div>
	              <!-- /.box-header -->
	              <!-- form start -->
	              {!! Form::model($city, array('url' => '/admin/user_update', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true)) !!}

	                <div class="box-body">
						@include ('flash::message')

						<div class="form-group">
							{!! Form::label('', 'Country', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
								<p class="form-control-static">{{$city->state->country->name}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'State', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
								<p class="form-control-static">{{$city->state->name}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Name', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
								<p class="form-control-static">{{$city->name}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Slug', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
								<p class="form-control-static">{{$city->slug}}</p>
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
