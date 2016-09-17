@extends('layouts.app')

@section('custom_css')
<!-- include libraries(jQuery, bootstrap) -->
<!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet"> -->



<!-- include summernote css/js-->
<!-- <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet"> -->

@endsection


@section('content')

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-9 page-content">
                <div class="inner-box category-content">
                    <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> Post a Free Classified Ad</strong> </h2>
                    <div class="row">
                        <div class="col-sm-12">
                            @include ('flash::message')
                            {!! Form::model(new App\Product, array('url' => '/post-ads', 'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) !!}
                            <?php $imageError = false; ?>
                            @if($errors->count()>0)
                                        @if(preg_match('(picture|image)', $errors->first()))
                                            <?php $imageError = true; ?>
                                        @endif
                            @endif


                            <fieldset>

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

                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                    {!! Form::label('type', 'Add Type', array('class' => 'col-md-3 control-label')) !!}
                                    <div class="col-sm-8">
                                        <?php /* {!! Form::text('type', null, array('class' => 'form-control',  )) !!} */ ?>
                                        <label class="radio-inline" for="radios-0">
                                            <input name="type" id="radios-0" value="Private" checked="checked" type="radio">
                                            Private </label>
                                        <label class="radio-inline" for="radios-1">
                                            <input name="type" id="radios-1" value="Business" type="radio">
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
                                                                    <label class="col-md-3 control-label"></label>
                                                                    <div class="col-md-8">
                                                                        <input type="submit" class="btn btn-primary" id="inputPassword3" value="Submit">
                                                                    </div>
                                                                </div>
                            </fieldset>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 reg-sidebar">
                <div class="reg-sidebar-inner text-center">
                    <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
                        <h3><strong>Post a Free Classified</strong></h3>
                        <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    </div>
                    <div class="panel sidebar-panel">
                        <div class="panel-heading uppercase"><small><strong>How to sell quickly?</strong></small></div>
                        <div class="panel-content">
                            <div class="panel-body text-left">
                                <ul class="list-check">
                                    <li> Use a brief title and description of the item </li>
                                    <li> Make sure you post in the correct category</li>
                                    <li> Add nice photos to your ad</li>
                                    <li> Put a reasonable price</li>
                                    <li> Check the item before publish</li>
                                </ul>
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
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection
