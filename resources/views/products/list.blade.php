@extends('layouts.app')

@section('custom_css')
{!! Html::style(asset('css/custom.css')) !!}

@endsection

@section('content')
<div class="search-row-wrapper">
    <div class="container ">
        @include('partials.search')
    </div>
</div>

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 page-sidebar">
                <aside>
                    <div class="inner-box">
                        {!! Form::model(new App\Product, array('url' => url("/filter"), 'method' => 'post', 'class' => '')) !!}

                        <div class="categories-list  list-filter">
                            <h5 class="list-title"><strong><a href="#">All Categories</a></strong></h5>
                            <ul class=" list-unstyled">
                                @foreach($categoryLists as $category)
                                    <li>
                                        <label>
                                            {!! Form::radio('category_id', $category->id, null,['id'=>$category->slug]) !!}
                                            <span class="title">{{$category->name}}</span>
                                            <span class="count">&nbsp;({{$category->product->count()}})</span> </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="locations-list  list-filter">
                            <h5 class="list-title"><strong><a href="#">Location</a></strong></h5>
                            <ul class="browse-list list-unstyled long-list">
                                @foreach($cities as $city)
                                    <li>
                                        <label>
                                            {!! Form::radio('city_id', $city->id, null,['id'=>$city->slug]) !!}
                                            <span class="title">{{$city->name}}</span> </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="locations-list  list-filter">
                            <h5 class="list-title"><strong><a href="#">Price range</a></strong></h5>

                            <div class="form-group col-sm-4 no-padding">
                                {!! Form::text('min_price', null, array('class' => 'form-control', 'placeholder' => '$ 2000' )) !!}

                            </div>
                            <div class="form-group col-sm-1 no-padding text-center"> - </div>
                            <div class="form-group col-sm-4 no-padding">
                                {!! Form::text('max_price', null, array('class' => 'form-control', 'placeholder' => '$ 3000')) !!}
                            </div>

                            <div style="clear:both"></div>
                        </div>

                        <div class="locations-list  list-filter">
                            <h5 class="list-title"><strong><a href="#">Seller</a></strong></h5>
                            <ul class="browse-list list-unstyled long-list">
                                <li>
                                    <label>
                                        {!! Form::radio('seller_type', 'all', null,['id'=>$city->slug]) !!}
                                        All <span class="count">({{$productLists->count()}})</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                            {!! Form::radio('seller_type', 'Business', null,['id'=>$city->slug]) !!}
                                            Business <span class="count">({{$productLists->where('type','Business')->count()}})</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                            {!! Form::radio('seller_type', 'Private', null,['id'=>$city->slug]) !!}
                                            Private <span class="count">({{$privateType}})</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <h5 class="list-title"><strong></h5>
                            {!! Form::submit('Find', ['class'=>'btn btn-primary btn-block']) !!}
                            </div>

                        <!-- <div class="locations-list  list-filter">
                            <h5 class="list-title"><strong><a href="#">Condition</a></strong></h5>
                            <ul class="browse-list list-unstyled long-list">
                                <li> <a href="sub-category-sub-location.html">New <span class="count">228,705</span></a></li>
                                <li> <a href="sub-category-sub-location.html">Used <span class="count">28,705</span></a></li>
                                <li> <a href="sub-category-sub-location.html">None </a></li>
                            </ul>
                        </div> -->

                        <div style="clear:both"></div>
                        {!! Form::close() !!}
                    </div>

                </aside>
            </div>

            <div class="col-sm-9 page-content col-thin-left">
                <div class="category-list">
                    <div class="tab-box ">

                        <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                            <li class="active"><a href="#allAds" role="tab" data-toggle="tab">All Ads <span class="badge">{{$productArr->total()}}</span></a></li>
                            <!-- <li><a href="#businessAds" data-url="ajax/2.html" role="tab" data-toggle="tab">Business <span class="badge">{{$productArr->where('type','Business')->count()}}</span></a></li>
                            <li><a href="#personalAds" data-url="ajax/3.html" role="tab" data-toggle="tab">Private <span class="badge">{{$productArr->where('type','Private')->count()}}</span></a></li> -->
                        </ul>
                        <div class="tab-filter">
                            @php  $paginateQuerypara = array(); @endphp
                            {!! Form::model(new App\Product, array('url' => url("/filter"), 'method' => 'post', 'class' => '')) !!}
                                @if(isset($requestData))
                                    @foreach($requestData as $key=>$value)
                                        @if(!empty($value) && $key!='_token')
                                            @php $paginateQuerypara[trim($key)]=trim($value) @endphp
                                            {!! Form::hidden($key, $value,['para'=>'new', 'class'=>'searchParameter']) !!}
                                        @endif
                                    @endforeach
                                @endif
                                {!! Form::select('sort', ['price_asc'=>'Price: Low to High','price_desc'=>'Price: High to Low'], null, ['placeholder' => '--Short by--', 'class' => 'selectpicker', 'onchange'=>"this.form.submit()"]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>



                    <div class="listing-filter">
                        <div class="pull-left col-xs-6">
                            @if(isset($searchParameter) && count($searchParameter)>0)
                                <div class="filters" style="display: block;">
                                    <div class="filter-list">
                                        <div class="text">Filters:</div>
                                        <ul class="group" data-heading="Price">
                                            @foreach($searchParameter as $key=>$value)

                                                    <li class="heading"><span>{{$key}}</span></li>
                                                    <li><span>{{$value}}</span></li>

                                            @endforeach
                                            </ul>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            @endif
                                <!-- <a href="#" class="current"> <span>All ads</span></a> in New York -->
                                <!-- <a href="#selectRegion" id="dropdownMenu1" data-toggle="modal"> <span class="caret"></span> </a> -->

                        </div>
                        <div class="pull-right col-xs-6 text-right listing-view-action">
                            <span class="list-view active"><i class="  icon-th"></i></span>
                            <span class="compact-view"><i class=" icon-th-list  "></i></span>
                            <span class="grid-view "><i class=" icon-th-large "></i></span>
                        </div>
                        <div style="clear:both"></div>
                    </div>

                    <div class="adds-wrapper">
                        <div class="tab-content">
                            <div class="tab-pane active" id="allAds">
                                @if(count($productArr)>0)
                                @foreach($productArr as $product)
                                    <div class="item-list">
                                        <?php
                                           $premiumAd = $product->premium_ad()->pluck('name')->count();
                                           $premiumAdSlug =($premiumAd>0)?$product->premium_ad->pluck('slug')->toArray()[0]:'dash';
                                           $premiumTitle =($premiumAd>0)?$product->premium_ad->pluck('title')->toArray()[0]:'dash';

                                        ?>
                                        @if(($premiumAd>0) && ($premiumAdSlug=='top'))
                                            <div class="cornerRibbons topAds">
                                                <a href="#"> Top Ads</a>
                                            </div>
                                        @elseif(($premiumAd>0) && ($premiumAdSlug=='featured'))
                                             <div class="cornerRibbons featuredAds">
                                                 <a href="#"> Featured Ads</a>
                                             </div>
                                        @elseif(($premiumAd>0) && ($premiumAdSlug=='urgent'))
                                                 <div class="cornerRibbons urgentAds">
                                                     <a href="#"> Urgent</a>
                                                 </div>
                                        @elseif(($premiumAd>0) && ($premiumAdSlug=='top_urgent'))
                                             <div class="cornerRibbons urgentAds">
                                                 <a href="#"> Top + Urgent </a>
                                             </div>
                                        @endif
                                        <div class="col-sm-2 no-padding photobox">
                                            <div class="add-image"> <span class="photo-count"><i class="fa fa-camera"></i> {{$product->images->count()}} </span>
                                                <a href="{{ url('ad/view/'.$product->id) }}">{{ Html::image('/upload/products/'.$product->images->first()->thumbnail_image, "img", ['class'=>"thumbnail no-margin"]) }}</a>

                                            </div>
                                        </div>

                                        <div class="col-sm-7 add-desc-box">
                                            <div class="add-details">
                                                <h5 class="add-title">
                                                    {{ Html::link('ad/view/'.$product->id, $product->title, $attributes = array(), $secure = null) }}

                                                </h5>
                                                    <span class="info-row">
                                                        <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{ ($product->type=='Private')?'Private':'Business'}} Ads">{{ ($product->type=='Private')?'P':'B'}} </span>
                                                        <span class="date"><i class=" icon-clock"> </i> {{$product->created_at->diffForHumans()}} </span>
                                                         - <span class="category">{{ $product->subcategory->category->name}} </span>
                                                         - <span class="item-location"><i class="fa fa-map-marker"></i> {{ ($product->user->city_id!=0)?$product->user->city->name:'-'}}  </span> </span>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 text-right  price-box">
                                            <h2 class="item-price"> $ {{$product->price}} </h2>
                                            @if($premiumAd>0)
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm make-favorite"> <i class="fa fa-certificate"></i> <span>{{$premiumTitle}}</span> </a>
                                            @endif
                                            @if(Auth::check())
                                            <?php $class1 = ($product->favourites()->pluck('id')->count()==0)?'hide':'';
                                                  $class2 = ($class1=='hide')?'':'hide';
                                                ?>
                                            <a class="btn btn-default  btn-sm make-favorite {{$class1}}" id='{{"saved-ad-".$product->id}}' onclick="favourite('2','{{$product->id}}')"> <i class="fa fa-heart"></i> <span>Favourite (Remove)</span> </a>
                                            <a class="btn btn-default  btn-sm make-favorite {{$class2}}" id='{{"save-ad-".$product->id}}' onClick="favourite('1','{{$product->id}}')"> <i class="fa fa-heart-o"></i><span>Favourite</span> </a>
                                            @endif
                                        </div>

                                    </div>
                                @endforeach
                                @else
                                    <div class="item-list text-center">Sorry, No Records Found</div>
                                @endif
                                </div>
                        </div>
                    </div>
                    <div class="tab-box  save-search-bar text-center">
                        <a href="javascript:void(0)" id="save" onclick="saveAllSearch(1, this.id)"> <i class=" icon-star-empty"></i> Save Search </a>
                    </div>
                </div>
                <div class="pagination-bar text-center">
                    {!! $productArr->appends($paginateQuerypara)->links() !!}
                </div>
                <div class="post-promo text-center">
                    <h2> Do you get anything for sell ? </h2>
                    <h5>Sell your products online FOR FREE. It's easier than you think !</h5>
                    <a href="{{url('ad/post')}}" class="btn btn-lg btn-border btn-post btn-danger">Post a Free Ad </a></div>

            </div>
        </div>
    </div>
</div>

@endsection


@section('custom_js')

<script type="text/javascript">
function favourite($type,$product_id,$linkId){
    var userId = {{ (Auth::check()?(Auth::id()):0) }}
    if(userId == 0){
        alert('you are not signed in');
    }else{
        $.ajax({
            url: "{{ url('favourite')}}",
            type: "post",
            data: { 'user_id': userId, 'type': $type, 'product_id': $product_id, '_token': '{{csrf_token()}}' },
            dataType: 'json',
            complete: function(response){
                if(response.status == 200) {
                    if($type==1){
                        $("#save-ad-"+$product_id).addClass("hide");
                        $("#saved-ad-"+$product_id).removeClass("hide");
                    }else{
                        $("#saved-ad-"+$product_id).addClass("hide");
                        $("#save-ad-"+$product_id).removeClass("hide");
                    }
                }else{
                    alert('There is something is wrong, contact admin.');
                }
            }
        })
    }
};

    function saveAllSearch($type, $id){
        var userId = {{ (Auth::check()?(Auth::id()):0) }}
        if(userId == 0){
            alert('you are not signed in');
        }
        if($id=='saved'){
            alert('Your search is already saved');
            return false;
        }
        var searchParameterJson = {};
        $parameterExists = false;
        $(".searchParameter").each(function(){
            $parameterExists = true;
            searchParameterJson[this.name] = this.value;
        });
        searchParameterJson['_token'] = '{{csrf_token()}}';
        console.log(searchParameterJson);
        if($parameterExists == true){
            $.ajax({
                url: "{{ url('saveAllSearches')}}",
                type: "post",
                data: searchParameterJson,
                dataType: 'json',
                complete: function(response){
                    if(response.status == 200) {
                        $("#"+$id).html(' <i class="icon-star"></i> Search saved');
                        $("#"+$id).attr('id','saved');
                    }else{
                        alert('There is something is wrong, contact admin.');
                    }
                }
            })
        }
    }
</script>

@endsection
