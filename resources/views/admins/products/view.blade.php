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
    		<li><a href="{{ url('admin/ads') }}"><i class="fa fa-th"></i> Ads</a></li>
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
	                <h3 class="box-title">View Ad details</h3>
	              </div>
	              <!-- /.box-header -->
	              <!-- form start -->
	              {!! Form::model($product, array('url' => '/admin/user_update', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true)) !!}
				  {!! Form::hidden('id', $user->id) !!}
	                <div class="box-body">
						@include ('flash::message')
						<div class="form-group">
							{!! Form::label('', 'Ad Type', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$product->type}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Ad Title', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$product->title}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Sub Category', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$product->subcategory->name}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Category', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{$product->category->name}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Ad owner', array('class' => 'col-md-3 control-label')) !!}
								<div class="col-sm-9">
								  <p class="form-control-static">{!! Html::link(url('admin/user/view/'.$product->user_id), $product->user->first_name.' '.$product->user->last_name) !!}</p>
								</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Ad Status', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($product->product_status->count()>0)?($product->product_status->status):'-'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Price', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">${{$product->price}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Price Negotiable', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($product->price_negotiable==1)?'Yes':'No'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Ad favourite', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($product->favourites->count()>0)?($product->favourites->count()):'-'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Premium Ad', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($product->premium_ad->count()>0)?($product->premium_ad[0]->name):'-'}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Abuse Report', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{{($product->abuses->count()>0)?($product->abuses->count()):0}}</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Images', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">
								  @if($product->images->count()>0)
  									@foreach($product->images as $image)
  									<div class="col-sm-3 no-padding photobox">
  										<div class="add-image">
  											<a href="javascript:void(0)">
  												{{ Html::image('upload/products/'.$image->thumbnail_image, "For Deleting this picture check the corner picture",
  												 ['class'=>'img-responsive thumbnail img no-margin','title'=>"For Deleting this picture checked the corner box"]) }}
  												</a>
  										</div>
  									</div>
  									@endforeach
  								@else
  								-
  								@endif
							  </p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('', 'Ad Description', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-9">
							  <p class="form-control-static">{!! $product->description !!}</p>
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
