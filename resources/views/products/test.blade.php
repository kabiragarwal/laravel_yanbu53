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
                            {!! Form::model($product, array('url' => '/post-ads', 'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) !!}
                            <?php $imageError = false; ?>
                            @if($errors->count()>0)
                                        @if(preg_match('(picture|image)', $errors->first()))
                                            <?php $imageError = true; ?>
                                        @endif
                                {{print_r($errors->all())}}
                            @endif


                            <fieldset>

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

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        <input type="submit" class="btn btn-primary" id="inputPassword3" value="Submit">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        {{ $product->description }}
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
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#description').summernote({
              height:300,
            });
        });
    </script> -->

    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection
