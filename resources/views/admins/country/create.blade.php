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
  		<li><a href="{{ url('admin/counties') }}"><i class="fa fa-th"></i> Country</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
				<div class="box box-info">
	              <div class="box-header with-border">
	                <h3 class="box-title">Add New Country</h3>
	              </div>
	              {!! Form::open(array('url' => '/admin/country/store', 'method' => 'post', 'class' => 'form-horizontal')) !!}
				  	{!! Form::hidden('id', null) !!}

	                <div class="box-body">
						@include ('flash::message')

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							{!! Form::label('name', 'Name', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-8">
								{!! Form::text('name', null, array('class' => 'form-control', 'required' )) !!}

								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
							{!! Form::label('slug', 'Slug', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-md-8">
								{!! Form::text('slug', null, array('class' => 'form-control', 'required' )) !!}

								@if ($errors->has('slug'))
								<span class="help-block">
									<strong>{{ $errors->first('slug') }}</strong>
								</span>
								@endif
							</div>
						</div>

					  <div class="form-group">
						  <div class="col-sm-offset-3 col-sm-9">
							  <button type="submit" class="btn btn-info pull-left">Add</button>
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
@endsection
