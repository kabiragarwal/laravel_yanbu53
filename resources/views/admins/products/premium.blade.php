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
        <li class="active">Premium</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">


            <!-- /.box-header -->
				<div class="box box-info">
					<div class="row"><div class="box-body">
						@include ('flash::message')
   					 <div class="col-sm-12">
   						 <div class="well">
   							 <h3><i class=" icon-certificate icon-color-1"></i> Make your Ad Premium </h3>
   							 <p>Premium ads help sellers promote their product or service by getting their ads more visibility with more
   								 buyers and sell what they want faster. </p>
   							 <div class="form-group">

   								 {{ Form::open(array('method'=>'post', 'url'=>'/admin/ad/premium_confirm','id'=>'premium_form', 'class' => 'form-horizontal'))}}
   								 <?php $i=0;?>
   								 <table class="table table-hover checkboxtable">
   									 @foreach($premiumAdCategory as $category)
   										 <tr>
   											 <td>
   												 <div class="radio form-group{{ $errors->has('premiumadcategory_id') ? ' has-error' : '' }}">
   													 <label>
   														 {{Form::radio('premiumadcategory_id', $category->id, ($i==3)?'Checked':null, ['class'=>'premiumadcategory_id','id'=>$i]  )}}
   														 <strong>{{$category->name}} </strong> </label>
   														 @if ($errors->has('premiumadcategory_id'))
   															 <span class="help-block">
   																 <strong>{{ $errors->first('premiumadcategory_id') }}</strong>
   															 </span>
   														 @endif
   												 </div>
   											 </td>
   											 <td>$<span id={{'catAmount_'.$i}}>{{$category->amount}}</span></td>
   										 </tr>
   										 <?php $i++; ?>
   									 @endforeach

   									 <tr>
   										 <td><div class="form-group{{ $errors->has('payment_method') ? ' has-error' : '' }}">
   												 <div class="col-md-8">
   													 {{Form::select('payment_method', ['Card'=>'Credit / Debit Card','Paypal'=>'Paypal'], null, array('class'=>'form-control', 'id'=>'payment_method', 'placeholder'=>'Select Payment Method') )}}
   													 @if ($errors->has('payment_method'))
   														 <span class="help-block">
   															 <strong>{{ $errors->first('payment_method') }}</strong>
   														 </span>
   													 @endif
   												 </div>
   											 </div></td>
   										 <td>
   											 <p> <strong>Payable Amount : $<span id='total_amount'>40.00</span></strong></p>
   											 <p> <strong>Discount Amount : $<span id='total_discount'>00.00</span></strong></p>
   											 <p> <strong>Net Amount : $<span id='net_amount'>40.00</span></strong></p>
   										 </td>
   									 </tr>
   									 <tr>
   										 <td>
   											 <div class="form-group"><div class="col-md-8">
   												 {{Form::text('code', null, array('class'=>'form-control', 'placeholder'=>'Coupon Code:', 'id'=>'coupon_code') )}}

   											 </div>
   											 <div class="col-md-4">
   												 {{Form::hidden('couponCodeApply', 0, ['id'=>'couponCodeApply'])}}
   												 {{Form::button('Apply', ['class'=>'btn btn-primary', 'id'=>'coupon_apply'])}}
   											 </div>
   									 </div></td>
   										 <td>
   											 {{Form::hidden('product_id', base64_encode($product->id))}}
   											 {{Form::Submit('Submit', ['class'=>'btn btn-primary','id'=>'formSubmit'])}}</td>
   									 </tr>
   									 <tr>

   										 <td colspan='2'>
   											 {{ Html::link( url('admin/ad/view/'.$product->id), 'Skip this step', $attributes = array(), $secure = null)}}
   										 </td>
   									 </tr>
   								 </table>
   								 {{ Form::close()}}
   							 </div>
   						 </div>

   					 </div></div>
   				 	</div>
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
		$(".premiumadcategory_id").on('click', function(){
			$category = $(this).val();
			$catId = $(this).attr('id');
			$catgoryAmount = $("#catAmount_"+$catId).html();
			$("#total_amount").html($catgoryAmount);
			$("#total_discount").html('00.00');
			$("#net_amount").html($catgoryAmount);
			$("#couponCodeApply").val(0);
			console.log($category);
			console.log($catgoryAmount);
		});

		$("#coupon_apply").on('click', function(){
			$couponCode =$("#coupon_code").val().trim();
			if($couponCode!=''){

				$.ajax({
					url: '{{ url('coupon_code_apply') }}',
					data: {'code':$couponCode, '_token':'{{csrf_token()}}'},
					type: 'post',
					complete:function(response){
						if(response.status == 200){
							$totalAmount = $("#total_amount").html();
							$discountPercentage = response.responseText;
							$totalDiscount = parseFloat(($totalAmount * $discountPercentage)/100).toFixed(2);
							$net_amount = parseFloat($totalAmount-$totalDiscount).toFixed(2);
							$("#total_discount").html($totalDiscount);
							$("#net_amount").html($net_amount);
							$("#couponCodeApply").val(1);
						}else{
							alert(response.responseText);
						}
						console.log(response);
					}
				})
			}else{
				alert('Please Provide the coupon code value');
			}
		});


	})

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
    </script>
@endsection
