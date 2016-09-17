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
	                <h3 class="box-title">Update Ad details</h3>
					@php
					   $premiumAd = $product->premium_ad()->pluck('name')->count();
					@endphp
					@if(!($premiumAd>0))
					   <a href="{{ url('admin/ad/premium/'.$product->id) }}" class="btn btn-info pull-right"><i class=" icon-plus"></i> Make This Ad Premium </a>
					@endif
	              </div>
	              {!! Form::model($product, array('url' => '/admin/ad/update', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true)) !!}
				  	{!! Form::hidden('id', null) !!}

					@php $imageError = false; @endphp
					@if($errors->count()>0)
								@if(preg_match('(picture|image)', $errors->first()))
									<?php $imageError = true; ?>
								@endif
					@endif

	                <div class="box-body">
						@include ('flash::message')
						<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
							{!! Form::label('type', 'Ad Type', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-8">
								<label class="radio-inline" for="radios-0">
									{!! Form::radio('type', 'Private', null, array('id' => 'radios-0')) !!}
									Private </label>
								<label class="radio-inline" for="radios-1">
									{!! Form::radio('type', 'Business', null, array('id' => 'radios-1')) !!}
									Business </label>

								@if ($errors->has('type'))
								<span class="help-block">
									<strong>{{ $errors->first('type') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							{!! Form::label('title', 'Ad Title', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-8">
								{!! Form::text('title', null, array('class' => 'form-control',  )) !!}
								<span class="help-block">A great title needs at least 60 characters. </span>

								@if ($errors->has('title'))
								<span class="help-block">
									<strong>{{ $errors->first('title') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
							{!! Form::label('subcategory_id', 'Category', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-md-8">
								{!! Form::select('subcategory_id', $categoryData, null, ['placeholder' => '--Select a Category--', 'class' => 'form-control']) !!}

								@if ($errors->has('subcategory_id'))
								<span class="help-block">
									<strong>{{ $errors->first('subcategory_id') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
							{!! Form::label('status', 'Ad Status', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-md-8">
								{!! Form::select('status', $status, null, ['placeholder' => '--Select Ad Status--', 'class' => 'form-control']) !!}

								@if ($errors->has('status'))
								<span class="help-block">
									<strong>{{ $errors->first('status') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
							{!! Form::label('price', 'Price', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-md-4">
								<div class="input-group"> <span class="input-group-addon">$</span>
									{!! Form::text('price', null, array('class' => 'form-control',  )) !!}
								</div>
								@if ($errors->has('price'))
								<span class="help-block">
									<strong>{{ $errors->first('price') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-4">
								<div class="checkbox">
									<label>
										{!! Form::checkbox('price_negotiable', 1, null) !!}
										Negotiable </label>
								</div>
							</div>
						</div>

						<div class="<?php echo ($imageError) ? 'form-group has-error' : 'form-group' ?>">
							<label class="col-md-3 control-label" for="textarea"> Picture </label>
							<div class="col-md-8">
								<div class="mb10">
									{!! Form::file('picture[]', [ 'id' => 'picture', 'multiple'=>true]) !!}
									<span class="help-block">You can upload multiple pictures, Please upload Min. 3 pictures. </span>
										@if($imageError)
											@foreach($errors->all() as $error)
												@if(preg_match('(picture|image)', $error))
													<span class="help-block"><strong>{{$error}}</strong></span>
												@endif
											@endforeach
										@endif
								</div>

							</div>
						</div>

						<div class="<?php echo ($imageError) ? 'form-group has-error' : 'form-group' ?>">
							<label class="col-md-3 control-label" for="textarea"> Current Pictures </label>
							<div class="col-md-8">
								<div class="mb10">
									@foreach($product->images as $image)
									<div class="col-sm-3 no-padding photobox">
										<div class="add-image">
											<span class="photo-count">
												<i class="fa fa-trash-o"></i> {!! Form::checkbox('old_image[]', $image->id, null, ['id'=>"old_image_$image->id"]) !!}
											</span>
											<a href="javascript:void(0)">
												{{ Html::image('upload/products/'.$image->thumbnail_image, "For Deleting this picture check the corner picture", ['class'=>'img-responsive thumbnail img no-margin','title'=>"For Deleting this picture checked the corner box"]) }}
												</a>

										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>

						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							{!! Form::label('description', 'Describe ad', array('class' => 'col-md-3 control-label')) !!}
							<div class="col-sm-8">
								{!! Form::textarea('description', null, array('class' => 'form-control','id' => 'description')) !!}
								@if ($errors->has('description'))
								<span class="help-block">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
							<label class="col-md-3 control-label">Terms</label>
							<div class="col-md-8">
								<label class="checkbox-inline" for="terms">
									{!! Form::checkbox('terms', 1, null, ['id'=>'terms']) !!}
									Agree with terms & conditions. </label>
								@if ($errors->has('terms'))
								<span class="help-block">
									<strong>{{ $errors->first('terms') }}</strong>
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
<script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection
