<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('app-assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('app-assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    {{--Font and icon--}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    {{--End--}}

    {{--Core Css--}}
    <link href="{{asset('css/vendor/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/vendor/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet"/>
    <link href="{{asset('css/vendor/demo.css')}}" rel="stylesheet"/>
    {{--End--}}

</head>

<body class="landing-page sidebar-collapse">

@include('layouts.shared.app-navbar')

<div class="wrapper">

    @include('layouts.shared.app-header')

    <div class="main">

        <div class="wrapper">
            @yield('body')
        </div>

    </div>

    @include('layouts.shared.app-footer')

</div>
</body>

{{--Core Js--}}
<script src="{{asset('js/vendor/core-landing/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/vendor/core-landing/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/vendor/core-landing/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/vendor/core-landing/now-ui-kit.js?v=1.1.0')}}" type="text/javascript"></script>
{{--End--}}

<script type="text/javascript">

    function scrollToDownload() {

        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }

</script>

</html>