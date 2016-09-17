@extends('layouts.app')

@section('custom_css')
    <link href="{{asset('plugins/bxslider/jquery.bxslider.css')}}" rel="stylesheet"/>
@endsection

@section('content')
<div class="main-container">

         <div class="container">
             <ol class="breadcrumb pull-left">
                 <li><a href="{{url('home')}}"><i class="icon-home fa"></i></a></li>
                 <li><a href="{{url('ad/all')}}">All Ads</a></li>
                 <li><a href="{{url('ad/all?category='.$product->subcategory->category->slug)}}">{{ $product->subcategory->category->name}} </a></li>
                 <li class="active">{{ $product->subcategory->name}}</li>
             </ol>
             <div class="pull-right backtolist"><a href="{{ url()->previous() }}"> <i class="fa fa-angle-double-left"></i> Back to Results</a></div>
         </div>
         <div class="container">
             <div class="row">
                 <div class="col-sm-9 page-content col-thin-right">

                     <div class="inner inner-box ads-details-wrapper">
                         @include ('flash::message')
                         <h2> {{ $product->title}} <small class="label label-default adlistingtype">{{ $product->type}} ad</small> </h2>
                         <span class="info-row"> <span class="date"><i class=" icon-clock"> </i> {{ $product->created_at->diffForHumans()}} </span> -
                             <span class="category">{{ $product->subcategory->category->name}} </span>-
                             <span class="item-location"><i class="fa fa-map-marker"></i> {{ ($product->user->city_id!=0)?$product->user->city->name:'-'}}  </span>
                         </span>
                         <div class="ads-image">
                             <h1 class="pricetag"> ${{ $product->price}}</h1>

                             <ul class="bxslider">
                                 @foreach($product->images as $image)
                                     <li>
                                        {!! Html::image('upload/products/'.$image->image, "img") !!}
                                         </li>
                                 @endforeach
                             </ul>
                             <div id="bx-pager">
                                 @php $num=0; @endphp
                                 @foreach($product->images as $image)
                                 <a class="thumb-item-link" data-slide-index={{"$num"}} href="#">
                                     {{ Html::image('upload/products/'.$image->thumbnail_image, "img") }}</a>
                                     @php $num++; @endphp
                                 @endforeach
                                     </div>
                         </div>

                         <div class="Ads-Details">
                             <h5 class="list-title"><strong>Ads Detsils</strong></h5>
                             <div class="row">
                                 <div class="ads-details-info col-md-8">{!! $product->description !!}</div>
                                 <div class="col-md-4">
                                     <aside class="panel panel-body panel-details">
                                         <ul>
                                             <li>
                                                 <p class=" no-margin "><strong>Price:</strong> $ {{ $product->price}}</p>
                                             </li>
                                             <li>
                                                 <p class="no-margin"><strong>Type:</strong> {{ $product->subcategory->name}}</p>
                                             </li>
                                             <li>
                                                 <p class="no-margin"><strong>Location:</strong> {{ ($product->user->city_id!=0)?$product->user->city->name:'-'}} </p>
                                             </li>
                                         </ul>
                                     </aside>
                                     <div class="ads-action">
                                         <ul class="list-border">
                                             <li><a href="{{url('ad/all?user='.$product->user->id)}}"> <i class="fa fa-user"></i> More ads by User </a> </li>
                                                <li id="saved-ad" class="{{$class1}}"><a href="javascript:void(0)" id='saveAd' onclick="favourite('2')"> <i class="  fa fa-heart"></i> Favourite ad(Remove) </a> </li>
                                                <li id="save-ad" class="{{$class2}}"><a href="javascript:void(0)" id='saveAd' onClick="favourite('1')"> <i class="  fa fa-heart-o"></i> Favourite ad </a> </li>
                                             <li><a href="#"> <i class="fa fa-share-alt"></i> Share ad </a> </li>
                                             <li><a href="#reportAdvertiser" data-toggle="modal"> <i class="fa icon-info-circled-alt"></i> Report abuse </a> </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                             <div class="content-footer text-left"> <a class="btn btn-primary" data-toggle="modal" href="#contactAdvertiser"><i class=" icon-mail-2"></i> Send a message </a>
                                 @if(! $product->user->hide_phone)
                                 <a class="btn  btn-info"><i class=" icon-phone-1"></i> {{ $product->user->phone}}</a>
                                 @endif
                             </div>
                         </div>
                     </div>

                 </div>

                 <div class="col-sm-3  page-sidebar-right">
                     <aside>
                        @can('own-product', $product)
                         <div class="panel sidebar-panel panel-contact-seller">
                             <div class="panel-heading">Ad Settings</div>
                             <div class="panel-content user-info">
                                 <div class="panel-body text-center">
                                     <div class="user-ads-action">
                                         <a href="{{ url('ad/edit/'.$product->id) }}" data-toggle="modal" class="btn btn-primary btn-block">
                                             <i class=" icon-pencil"></i> Edit Ad
                                         </a>
                                         @php
                                            $premiumAd = $product->premium_ad()->pluck('name')->count();
                                            $premiumAdSlug =($premiumAd>0)?$product->premium_ad->pluck('slug')->toArray()[0]:'dash';
                                         @endphp
                                         @if(!($premiumAd>0))
                                            <a href="{{ url('ad/premium/'.$product->id) }}" class="btn btn-info btn-block"><i class=" icon-plus"></i> Make Your Ad Premium: </a>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endcan
                         <div class="panel sidebar-panel panel-contact-seller">
                             <div class="panel-heading">Contact Seller</div>
                             <div class="panel-content user-info">
                                 <div class="panel-body text-center">
                                     <div class="seller-info">
                                         <h3 class="no-margin">{{ $product->user->first_name.' '.$product->user->last_name}}</h3>
                                         <p>Location: <strong>{{ ($product->user->city_id!=0)?$product->user->city->name:'-'}}</strong></p>
                                         <p> Joined: <strong>{{ $product->user->created_at->diffForHumans()}}</strong></p>
                                     </div>
                                     <div class="user-ads-action"> <a href="#contactAdvertiser" data-toggle="modal" class="btn btn-primary btn-block"><i class=" icon-mail-2"></i> Send a message </a>
                                         @if(! $product->user->hide_phone)
                                         <a class="btn  btn-info btn-block"><i class=" icon-phone-1"></i> {{ $product->user->phone}} </a>
                                         @endif
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="panel sidebar-panel">
                             <div class="panel-heading">Safety Tips for Buyers</div>
                             <div class="panel-content">
                                 <div class="panel-body text-left">
                                     <ul class="list-check">
                                         <li> Meet seller at a public place </li>
                                         <li> Check the item before you buy</li>
                                         <li> Pay only after collecting the item</li>
                                     </ul>
                                     <p><a class="pull-right" href="#"> Know more <i class="fa fa-angle-double-right"></i> </a></p>
                                 </div>
                             </div>
                         </div>

                     </aside>
                 </div>

             </div>
         </div>

         <div class="modal fade" id="reportAdvertiser" tabindex="-1" role="dialog">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                         <h4 class="modal-title"><i class="fa icon-info-circled-alt"></i> There's something wrong with this ads? </h4>
                     </div>
                     {{ Form::open(array('method'=>'post', 'url'=>'/productAbuse', 'id'=>'report_submit')) }}

                        {{ Form::hidden('product_id', $product->id)}}

                         <div class="modal-body">
                             <div id="reportSubmitError" class='form-group has-error'></div>
                                 <div class="form-group">
                                     {!! Form::label('product_report_reason_id', 'Reason:', array('class' => 'control-label')) !!}
                                     {!! Form::select('product_report_reason_id', $reportlist, null, array('placeholder' => '--Select a Reason--', 'class' => 'form-control')) !!}
                                 </div>
                                 <div class="form-group">
                                     {!! Form::label('email', 'Your E-mail:', array('class' => 'control-label')) !!}
                                     {!! Form::text('email', (Auth::check() && Auth::user()->email)?Auth::user()->email:'', array('class' => 'form-control')) !!}
                                 </div>
                                 <div class="form-group">
                                     {!! Form::label('message', 'Message (300):', array('class' => 'control-label', 'escape'=>true)) !!}
                                     {!! Form::textarea('message', null, array('class' => 'form-control')) !!}
                                 </div>
                         </div>
                         <div class="modal-footer">
                             {!! Form::button('Cancel', array('class' => 'btn btn-default', 'data-dismiss'=>"modal")) !!}
                             {!! Form::button('Send Report', array('class' => 'btn btn-primary', 'id'=>'sendReport')) !!}
                         </div>
                     {!! Form::close() !!}
                 </div>
             </div>
         </div>


         <div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                         <h4 class="modal-title"><i class=" icon-mail-2"></i> Contact advertiser </h4>
                     </div>
                     <div class="modal-body">
                         <div id="sendMessageBox" class='form-group has-error'></div>
                         {{ Form::open(array('method'=>'post', 'url'=>'/send_message', 'id'=>'sendMessageForm')) }}
                            {{ Form::hidden('product_id', $product->id)}}
                             <div class="form-group">
                                 {!! Form::label('name', 'Name:', array('class' => 'control-label')) !!}
                                 {!! Form::text('name', (Auth::check() && Auth::user()->first_name)?Auth::user()->first_name.' '.Auth::user()->last_name:'', array('class' => 'form-control', 'placeholder'=>"Your name")) !!}
                            </div>
                             <div class="form-group">
                                 {!! Form::label('email', 'Email:', array('class' => 'control-label')) !!}
                                 {!! Form::text('email', (Auth::check() && Auth::user()->email)?Auth::user()->email:'', array('class' => 'form-control', 'placeholder'=>"Your email")) !!}
                            </div>
                             <div class="form-group">
                                 {!! Form::label('phone', 'Phone Number', array('class' => 'control-label')) !!}
                                 {!! Form::text('phone', (Auth::check() && Auth::user()->email)?Auth::user()->phone:'', array('class' => 'form-control', 'placeholder'=>"Your phone")) !!}
                            </div>
                             <div class="form-group">
                                 {!! Form::label('message', 'Message:', array('class' => 'control-label')) !!}
                                 {!! Form::textarea('message', null, array('class' => 'form-control', 'rows'=>'5', 'cols'=>'25',  'resize'=>'none', 'placeholder'=>"Your message here..")) !!}
                             </div>
                             <div class="form-group">
                                 <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
                             </div>

                     </div>
                     <div class="modal-footer">
                         {!! Form::button('Cancel', array('class' => 'btn btn-default', 'data-dismiss'=>"modal")) !!}
                         {!! Form::button('Send message!', array('class' => 'btn btn-primary', 'id'=>'sendMessagebutton')) !!}
                     </div>
                     {!! Form::close() !!}
                 </div>
             </div>
         </div>

     </div>


@endsection


@section('custom_js')
    <script src="{{asset('plugins/bxslider/jquery.bxslider.min.js')}}"></script>
    <script type="text/javascript">
    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });

    adVisitIncrement();
    function adVisitIncrement(){
        $.post( "{{ url('adVisitIncrement') }}", { id: "{{$product->id}}", '_token': '{{csrf_token()}}' });
    }

    function favourite($type){
        var userId = {{ (Auth::check()?(Auth::id()):0) }}
        if(userId == 0){
            alert('you are not signed in');
        }else{
            $.ajax({
                url: "{{ url('favourite')}}",
                type: "post",
                data: { 'user_id': userId, 'type': $type, 'product_id': '{{$product->id}}', '_token': '{{csrf_token()}}' },
                dataType: 'json',
                complete: function(response){
                    if(response.status == 200) {
                        if($type==1){
                            $("#save-ad").removeClass("show").addClass("hide");
                            $("#saved-ad").removeClass("hide").addClass("show");
                        }else{
                            $("#saved-ad").removeClass("show").addClass("hide");
                            $("#save-ad").removeClass("hide").addClass("show");
                        }
                        //alert(response.responseText);
                    }else{
                        alert('There is something is wrong, contact admin.');
                    }
                }
            })
        }
    };

    $(document).ready(function(){


      $('#sendReport').on('click',function(e){
        e.preventDefault(e);
        $.ajax({
          url: "{{ url('productAbuse')}}",
          type: "post",
          data: $("#report_submit").serialize(),
          dataType: 'json',
          complete: function(response){
              ajaxCompleteBlock(response, '#reportSubmitError', '#report_submit');
             },
        });
      });

      $('#sendMessagebutton').on('click',function(e){
        e.preventDefault(e);
        $.ajax({
          url: "{{ url('send_message')}}",
          type: "post",
          data: $("#sendMessageForm").serialize(),
          dataType: 'json',
          complete: function(response){
              ajaxCompleteBlock(response, '#sendMessageBox', '#sendMessageForm');
            },
        });
      });

      function ajaxCompleteBlock($response, $errorBox, $formId){
          ResponseShown ='';
          if($response.status == 422) {
                $.each( JSON.parse($response.responseText), function( key, value ) {
                    ResponseShown += '<span class="help-block"><strong>' + value[0] + '</strong></span>';
                });
            }
            else if($response.status == 200) {
                ResponseShown += '<span class="alert-success"><strong>' + $response.responseText + '</strong></span>';
                $($errorBox).html('');
            }
            $($errorBox).html(ResponseShown);
            $($formId).find('select, textarea').val('');
      }
    });
    </script>
    <script src="{{asset('plugins/jquery.fs.scroller/jquery.fs.scroller.js')}}"></script>
    <script src="{{asset('plugins/jquery.fs.selecter/jquery.fs.selecter.js')}}"></script>
@endsection
