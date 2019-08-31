<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>Trade</title>

    <!--App Core Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--/App Core Styles -->

    <!-- Theme Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('css/vendor/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/vendor/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/vendor/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/vendor/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/vendor/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /Theme global stylesheets -->

    <!--App Custom Css -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
    <!--/App Custom Css -->

    {{--WebSocket--}}
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>

    <script>
        window.App = {!!
         json_encode([
                'signedIn' => \Illuminate\Support\Facades\Auth::check(),
                'user' => \Illuminate\Support\Facades\Auth::user(),
         ])
         !!};
    </script>

</head>
<body>


<div id="app">

    <!-- Main Navbar -->
@include('layouts.shared.trading-navbar')
<!-- /Main Navbar -->

    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">
                    @yield('body')
                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
</div>

<!-- App Core Js -->
<script src="{{asset('js/app.js')}}"></script>
<!-- /App Core Js -->

<!-- Chart -->
<script type="text/javascript" src="{{asset('chart/charting_library/charting_library.min.js')}}"></script>
<script type="text/javascript" src="{{asset('chart/datafeeds/udf/dist/polyfills.js')}}"></script>
<script type="text/javascript" src="{{asset('chart/datafeeds/udf/dist/bundle.js')}}"></script>

<script type="text/javascript">

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    TradingView.onready(function () {
        var widget = window.tvWidget = new TradingView.widget({
            debug: false, // uncomment this line to see Library errors and warnings in the console
            fullscreen: false,
            symbol: 'BTCUSD',
            interval: '1',
            container_id: "tv_chart_container",
            //	BEWARE: no trailing slash is expected in feed URL
            datafeed: new Datafeeds.UDFCompatibleDatafeed("/api/v1/udf"),
            library_path: "chart/charting_library/",
            locale: getParameterByName('lang') || "en",
            //	Regression Trend-related functionality is not implemented yet, so it's hidden for a while
            drawings_access: {type: 'black', tools: [{name: "Regression Trend"}]},
            disabled_features: ["use_localstorage_for_settings"],
            enabled_features: ["study_templates"],
            charts_storage_url: 'http://saveload.tradingview.com',
            charts_storage_api_version: "1.1",
            client_id: 'tradingview.com',
            user_id: 'public_user_id',
            toolbar_bg: '#263238',
            width: '100%',
            height: 600,
            custom_css_url: "{{asset('css/custom.css')}}",
            // disabled_features: ["header_widget"],
            overrides: {
                "paneProperties.background": "#263238",
                "paneProperties.vertGridProperties.color": "#454545",
                "paneProperties.horzGridProperties.color": "#454545",
                "symbolWatermarkProperties.transparency": 90,
                "scalesProperties.textColor": "#AAA",
            }

        });
    })
    ;

</script>


<!-- /Chart -->

<!-- ThemeCore JS files -->
<script type="text/javascript" src="{{asset('js/vendor/core-trading/libraries/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vendor/core-trading/libraries/bootstrap.min.js')}}"></script>
<!-- /Theme core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="{{asset('js/vendor/core-trading/app.js')}}"></script>
<!-- /theme JS files -->

<script src="https://cdn.jsdelivr.net/npm/vue2-filters/dist/vue2-filters.min.js"></script>
</body>
</html>
