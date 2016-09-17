@extends('layouts.admin-app')

@section('headerWithSidebar')
		@include('partials.admin-header')

		@include('partials.admin-sidebar')
@endsection

@section('customCss')
	<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>All Cities
	  <small>{{html::link(url('admin/city/create'),'Add New City',['class'=>'text-underline'])}}</small></h1>
      <ol class="breadcrumb">
		<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">City</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">


          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				@include ('flash::message')
              <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th>S.N.</th>
				  <th>Country</th>
				  <th>State</th>
                  <th>Name</th>
                  <th>slug</th>
				  <th>Add Date</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php $i=1; ?>
				@foreach($cities as $city)
                <tr>
                  <td>{{$i}}</td>
				  <td>{{$city->state->country->name}}</td>
				  <td>{{$city->state->name}}</td>
                  <td>{{$city->name}}</td>
                  <td>{{$city->slug}}</td>
				  <td>{{$city->created_at->diffForHumans()}}</td>
				  <td>
					  	<a href="{{url('admin/city/edit/'.$city->id)}}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> Edit </a>
  						<a href="{{url('admin/city/view/'.$city->id)}}" class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> View </a>
						<a href="{{url('admin/city/delete/'.$city->id)}}" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Delete </a>
				  </td>
                </tr>
				<?php $i++; ?>
				@endforeach
                </tbody>
                <tfoot>
                <tr>
					<th>S.N.</th>
					<th>Country</th>
					<th>State</th>
                    <th>Name</th>
                    <th>slug</th>
  				  	<th>Add Date</th>
  				  	<th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
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
	<!-- DataTables -->
	<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

	<!-- page script -->
	<script>
	  $(function () {
		$("#example1").DataTable();
	  });
	</script>
@endsection
