@extends('layouts.app')

@section('content')

<div class="intro-inner">
    <div class="about-intro" style="
         background:url({{asset('images/bg2.jpg')}}) no-repeat center;
         background-size:cover;">
        <div class="dtable hw100">
            <div class="dtable-cell hw100">
                <div class="container text-center">
                    <h1 class="intro-title animated fadeInDown"> {{ $pages->title }} </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-container inner-page">
    <div class="container">
        <div class="section-content">
            <div class="row ">
                <h1 class="text-center title-1"> What Makes Us Special </h1>
                <hr class="center-block small text-hr">
                <div class="col-sm-6">
                    <div class="text-content has-lead-para text-left">
                        {!! $pages->content !!}
                    </div>
                </div>
                <div class="col-sm-6"> <img src="{{asset('images/info.png')}}" alt="imfo" class="img-responsive"> </div>
            </div>
        </div>
    </div>
</div>

<div class="parallaxbox about-parallax-bottom">
    <div class="container">
        <div class="row text-center featuredbox">
            <div class="col-sm-4 xs-gap">
                <div class="inner">
                    <div class="icon-box-wrap"> <i class="icon-book-open ln-shadow-box shape-3"></i></div>
                    <h3 class="title-4">Customer service</h3>
                    <p>Ein herausragendes Beispiel fÃ¼r Story-Telling im modernen Webdesign. et suscipit sapien posuere quis. Maecenas ut iaculis nunc, eget efficitur ipsum. Nam vitae hendrerit tortor.</p>
                </div>
            </div>
            <div class="col-sm-4 xs-gap">
                <div class="inner">
                    <div class="icon-box-wrap"> <i class=" icon-lightbulb ln-shadow-box shape-6"></i></div>
                    <h3 class="title-4">Seller satisfaction</h3>
                    <p>Ein herausragendes Beispiel fÃ¼r Story-Telling im modernen Webdesign. et suscipit sapien posuere quis. Maecenas ut iaculis nunc, eget efficitur ipsum. Nam vitae hendrerit tortor. .</p>
                </div>
            </div>
            <div class="col-sm-4 xs-gap">
                <div class="inner">
                    <div class="icon-box-wrap"> <i class="icon-megaphone ln-shadow-box shape-5"></i></div>
                    <h3 class="title-4">Best Offers </h3>
                    <p>Ein herausragendes Beispiel fÃ¼r Story-Telling im modernen Webdesign. et suscipit sapien posuere quis. Maecenas ut iaculis nunc, eget efficitur ipsum. Nam vitae hendrerit tortor. </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
