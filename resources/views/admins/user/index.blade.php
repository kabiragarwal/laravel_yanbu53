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
      <h1>
        All Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
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
                  <th>Name</th>
                  <th>Email Id</th>
                  <th>City</th>
				  <th>Account Created</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php $i=1; ?>
				@foreach($users as $user)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$user->first_name .' '. $user->last_name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{($user->city_id!=0)?$user->city->name:'-'}}</td>
				  <td>{{$user->created_at->diffForHumans()}}</td>
				  <td>
					  	<a href="{{url('admin/user/edit/'.$user->id)}}" class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> Edit </a>
  						<a href="{{url('admin/user/view/'.$user->id)}}" class="btn btn-info btn-xs"> <i class="fa fa-mail-forward"></i> View </a>
						<a href="{{url('admin/user/delete/'.$user->id)}}" class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Delete </a>
				  </td>
                </tr>
				<?php $i++; ?>
				@endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>S.N.</th>
                  <th>Name</th>
                  <th>Email Id</th>
                  <th>City</th>
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
