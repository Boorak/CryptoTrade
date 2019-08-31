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

    {{--Font and Icons--}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    {{--End--}}

    {{--Core Css--}}
    <link href="{{asset('css/vendor/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/vendor/now-ui-kit.css?v=1.1.0')}}" rel="stylesheet"/>
    <link href="{{asset('css/vendor/demo.css')}}" rel="stylesheet"/>
{{--End--}}

<body class="login-page sidebar-collapse">

<!-- Header -->
<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
        <div class="navbar-translate">
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation"
             data-nav-image="../assets/img/blurred-image-1.jpg">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">صفحه اصلی</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Header -->

<div class="page-header" filter-color="orange">
    <div class="page-header-image" style="background-image:url({{asset('images/landing/bg.jpg')}})"></div>
    <div class="container">
        <div class="col-md-4 content-center">
            <div class="card card-login card-plain">
                @yield('body')
            </div>
        </div>
    </div>
</div>
</body>

{{--Core Js--}}
<script src="{{asset('js/vendor/core-landing/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/vendor/core-landing/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/vendor/core-landing/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/vendor/core-landing/now-ui-kit.js?v=1.1.0')}}" type="text/javascript"></script>
{{--End--}}

</html>