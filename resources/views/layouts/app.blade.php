<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('ico/apple-touch-icon-57-precomposed.html')}}">
        <link rel="shortcut icon" href="{{asset('ico/favicon.png')}}">
        <title>Yanbu</title>

        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <link href="{{asset('css/style.css')}}" rel="stylesheet">

        <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">
        <link href="{{asset('css/owl.theme.css')}}" rel="stylesheet">
        @yield('custom_css')

        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script>
            paceOptions = {
                elements: true
            };
        </script>
        <script src="{{asset('js/pace.min.js')}}"></script>
        <style>.themeControll{background:#2d3e50;height:auto;width:170px;position:fixed;left:0;padding:20px 0;top:100px;z-index:999999;-webkit-transform:translateX(0);-moz-transform:translateX(0);-o-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0);opacity:1;-ms-filter:none;filter:none;-webkit-transition:opacity .5s linear,-webkit-transform .7s cubic-bezier(.56,.48,0,.99);-moz-transition:opacity .5s linear,-moz-transform .7s cubic-bezier(.56,.48,0,.99);-o-transition:opacity .5s linear,-o-transform .7s cubic-bezier(.56,.48,0,.99);-ms-transition:opacity .5s linear,-ms-transform .7s cubic-bezier(.56,.48,0,.99);transition:opacity .5s linear,transform .7s cubic-bezier(.56,.48,0,.99);}.themeControll.active{display:block;-webkit-transform:translateX(-170px);-moz-transform:translateX(-170px);-o-transform:translateX(-170px);-ms-transform:translateX(-170px);transform:translateX(-170px);-webkit-transition:opacity .5s linear,-webkit-transform .7s cubic-bezier(.56,.48,0,.99);-moz-transition:opacity .5s linear,-moz-transform .7s cubic-bezier(.56,.48,0,.99);-o-transition:opacity .5s linear,-o-transform .7s cubic-bezier(.56,.48,0,.99);-ms-transition:opacity .5s linear,-ms-transform .7s cubic-bezier(.56,.48,0,.99);transition:opacity .5s linear,transform .7s cubic-bezier(.56,.48,0,.99);}.themeControll a{border-bottom:1px solid rgba(255,255,255,0.1);border-radius:0;clear:both;color:#fff;display:block;height:auto;line-height:16px;margin-bottom:5px;padding-bottom:8px;text-transform:capitalize;width:auto;}.tbtn{background:#2D3E50;color:#FFFFFF!important;font-size:30px;height:auto;padding:10px;position:absolute;right:-40px;top:0;width:40px;cursor:pointer;}.linkinner{display:block;height:400px;}.linkScroll .scroller-bar{width:17px;}.linkScroll .scroller-bar,.linkScroll .scroller-track{background:#1d2e40!important;border-color:#1d2e40!important;}@media (max-width: 780px) {.themeControll{display:none;}}</style>
    </head>
    <body>

        @yield('sidebar')
        <div id="wrapper">
            @include('partials.header')

            @yield('content')

            @include('partials.footer')
        </div>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

        <script src="{{asset('js/owl.carousel.min.js')}}"></script>

        <script src="{{asset('js/jquery.matchHeight-min.js')}}"></script>

        <script src="{{asset('js/hideMaxListItem.js')}}"></script>

        <script src="{{asset('plugins/jquery.fs.scroller/jquery.fs.scroller.js')}}"></script>
        <script src="{{asset('plugins/jquery.fs.selecter/jquery.fs.selecter.js')}}"></script>

        <script src="{{asset('js/script.js')}}"></script>

        <!-- <script type="text/javascript" src="{{asset('plugins/autocomplete/jquery.mockjax.js')}}"></script> -->
        <!-- <script type="text/javascript" src="{{asset('plugins/autocomplete/jquery.autocomplete.js')}}"></script>
        <script type="text/javascript" src="{{asset('plugins/autocomplete/usastates.js')}}"></script>
        <script type="text/javascript" src="{{asset('plugins/autocomplete/autocomplete-demo.js')}}"></script> -->
        @yield('custom_js')
    </body>
</html>
