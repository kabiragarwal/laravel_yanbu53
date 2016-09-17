@extends('layouts.app')

@section('content')

@section('sidebar')
    @include('partials.sidebar')
@endsection

    <div class="intro">
        <div class="dtable hw100">
            <div class="dtable-cell hw100">
                <div class="container text-center">
                    <h1 class="intro-title animated fadeInDown"> Find Classified Ads </h1>
                    <p class="sub animateme fittext3 animated fadeIn"> Find local classified ads on bootclassified in Minutes </p>
                    <div class="row search-row animated fadeInUp">
                        {!! Form::model(new App\Product, array('url' => url("/filter"), 'method' => 'post', 'class' => '')) !!}
                            <div class="col-lg-4 col-sm-4 search-col relative locationicon">
                                <i class="icon-location-2 icon-append"></i>
                                {!! Form::text('city', null, array('id'=>"autocomplete-ajax",'class' => 'form-control locinput input-rel searchtag-input has-icon', 'placeholder' => 'City' )) !!}

                            </div>
                            <div class="col-lg-4 col-sm-4 search-col relative"> <i class="icon-docs icon-append"></i>
                                {!! Form::text('search_term', null, array('class' => 'form-control has-icon', 'placeholder' => "I'm looking for a ..." )) !!}

                            </div>
                            <div class="col-lg-4 col-sm-4 search-col">
                                {!! Form::button('<i class="icon-search"></i><strong>Find</strong>', ['class'=>'btn btn-primary btn-search btn-block', 'type'=>"submit"]) !!}
                                <!-- <button class="btn btn-primary btn-search btn-block"><i class="icon-search"></i><strong>Find</strong></button> -->
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 page-content col-thin-right">
                    <div class="inner-box category-content">
                        <h2 class="title-2">Find Classified Ads World Wide </h2>
                        <div class="row">
                            @php $i=1; @endphp

                                @foreach($category as $cat)
                                    @if(is_int(($i+2)/3))
                                        <div class="col-md-4 col-sm-4">
                                    @endif
                                            <div class="cat-list">
                                                <h3 class="cat-title">
                                                    <a href="{{ url("filter?category=$cat->slug") }}">
                                                        <i class="{{$cat->icon}} ln-shadow"></i> {{ $cat->name}}
                                                        <span class="count">{{ $cat->product_count}}</span>
                                                    </a>
                                                    <span data-target=".cat-id-1" data-toggle="collapse" class="btn-cat-collapsed collapsed"> <span class=" icon-down-open-big"></span> </span>
                                                </h3>
                                                <ul class="cat-collapse collapse in cat-id-1">
                                                    @foreach($cat->subCategory as $sub)
                                                        <li> <a href="{{ url("filter?subcategory=$sub->slug") }}">
                                                            {{ $sub->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @if(is_int($i/3))
                                        </div>
                                    @endif
                                    @php $i++; @endphp
                                @endforeach
                            </div>

                    </div>
                    <div class="inner-box relative">
                        <h2 class="title-2">Featured Listings
                            <a id="nextItem" class="link  pull-right carousel-nav"> <i class="icon-right-open-big"></i></a>
                            <a id="prevItem" class="link pull-right carousel-nav"> <i class="icon-left-open-big"></i> </a>
                        </h2>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="no-margin item-carousel owl-carousel owl-theme">
                                    @foreach($product as $prod)
                                    <div class="item"> <a href="{{ url("filter?featured=$prod->slug") }}">
                                            <span class="item-carousel-thumb">
                                                {{ Html::image('upload/products/'.$prod->FirstImage->thumbnail_image, "img",['class'=>"img-responsive" ]) }}
                                            </span>
                                            <span class="item-name"> {{$prod->title}}</span>
                                            <span class="price"> $ {{$prod->price}} </span>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inner-box relative">
                        <div class="row">
                            <div class="col-md-5">
                                <div>
                                    <h3 class="title-2"> <i class="icon-location-2"></i> Popular locations </h3>
                                    <div class="row">
                                            @php $i=1; $totalCity = $cityList->count(); @endphp
                                            <ul class="cat-list col-xs-6">
                                            @foreach($cityList as $city)
                                                    <li>
                                                        <a href='{{url("filter?popular-location=$city->slug")}}'>
                                                            {{$city->name}}
                                                        </a>
                                                    </li>
                                                    @if($i==ceil($totalCity/2)|| is_int($i/$totalCity))
                                                        </ul><ul class="cat-list col-xs-6">
                                                    @endif
                                                @php $i++; @endphp
                                            @endforeach
                                            </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 ">
                                <h3 class="title-2"> <i class="icon-search-1"></i> Popular Makes </h3>
                                <div class="row">
                                    <ul class="cat-list col-md-4 col-xs-4 col-xxs-6">
                                        <li> <a href='{{url("filter?key-word=free")}}'>free </a></li>
                                        <li> <a href='{{url("filter?key-word=furniture")}}'>furniture </a></li>
                                        <li> <a href='{{url("filter?key-word=general")}}'>general </a></li>
                                        <li> <a href='{{url("filter?key-word=household")}}'>household </a></li>
                                        <li> <a href='{{url("filter?key-word=jewelry")}}'>jewelry </a></li>
                                        <li> <a href='{{url("filter?key-word=materials")}}'>materials </a></li>
                                        <li> <a href='{{url("filter?key-word=sporting")}}'>sporting </a></li>
                                        <li> <a href='{{url("filter?key-word=tickets")}}'>tickets </a></li>
                                    </ul>
                                    <ul class="cat-list col-md-4 col-xs-4 col-xxs-6">
                                        <li> <a href='{{url("filter?key-word=tools")}}'>tools </a></li>
                                        <li> <a href='{{url("filter?key-word=wanted")}}'>wanted </a></li>
                                        <li> <a href='{{url("filter?key-word=cell-phones")}}'>cell phones </a></li>
                                        <li> <a href='{{url("filter?key-word=clothes-acc")}}'>clothes+acc </a></li>
                                        <li> <a href='{{url("filter?key-word=collectibles")}}'>collectibles </a></li>
                                        <li> <a href='{{url("filter?key-word=electronics")}}'>electronics </a></li>
                                        <li> <a href='{{url("filter?key-word=farm+garden")}}'>farm+garden </a></li>
                                        <li> <a href='{{url("filter?key-word=garage-sale")}}'>garage sale </a></li>
                                    </ul>
                                    <ul class="cat-list col-md-4 col-xs-4 col-xxs-6">
                                        <li> <a href='{{url("filter?key-word=heavy-equip")}}'>heavy equip </a></li>
                                        <li> <a href='{{url("filter?key-word=motorcycles")}}'>motorcycles </a></li>
                                        <li> <a href='{{url("filter?key-word=music-instr")}}'>music instr </a></li>
                                        <li> <a href='{{url("filter?key-word=photo-video")}}'>photo+video </a></li>
                                        <li> <a href='{{url("filter?key-word=appliances")}}'>appliances </a></li>
                                        <li> <a href='{{url("filter?key-word=land")}}'>Land </a></li>
                                        <li> <a href='{{url("filter?key-word=arts-crafts")}}'>arts+crafts </a></li>
                                        <li> <a href='{{url("filter?key-word=auto-parts")}}'>auto parts </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 page-sidebar col-thin-left">
                    <aside>
                        <div class="inner-box no-padding">
                            <div class="inner-box-content"> <a href="#"><img class="img-responsive" src="{{asset('images/site/app.jpg')}}" alt="tv"></a> </div>
                        </div>
                        <div class="inner-box">
                            <h2 class="title-2">Popular Categories </h2>
                            <div class="inner-box-content">
                                <ul class="cat-list arrow">
                                    @foreach($category as $cat)
                                    <li>
                                        <a href='{{ url("filter?popular-categories=$cat->slug") }}'>
                                            {{ $cat->name}} ({{ $cat->product_count}})
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="inner-box no-padding"> <img class="img-responsive" src="{{asset('images/add2.jpg')}}" alt=""> </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <div class="page-info" style="background: url({{asset('images/bg.jpg')}}); background-size:cover">
        <div class="container text-center section-promo">
            <div class="row">
                <div class="col-sm-3 col-xs-6 col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon  icon-group"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span>2200</span> </h5>
                                <div class="iconbox-wrap-text">Trusted Seller</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon  icon-th-large-1"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span>100</span> </h5>
                                <div class="iconbox-wrap-text">Categories</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-3 col-xs-6  col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon  icon-map"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span>700</span> </h5>
                                <div class="iconbox-wrap-text">Location</div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-xxs-12">
                    <div class="iconbox-wrap">
                        <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                                <i class="icon icon-facebook"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                                <h5><span>50,000</span> </h5>
                                <div class="iconbox-wrap-text"> Facebook Fans</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-bottom-info">
        <div class="page-bottom-info-inner">
            <div class="page-bottom-info-content text-center">
                <h1>If you have any questions, comments or concerns, please call the Classified Advertising department at (000) 555-5555</h1>
                <a class="btn  btn-lg btn-primary-dark" href="tel:+000000000">
                    <i class="icon-mobile"></i> <span class="hide-xs color50">Call Now:</span> (000) 555-5555 </a>
            </div>
        </div>
    </div>

@endsection
