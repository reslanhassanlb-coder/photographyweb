<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
        {!! Twitter::generate() !!}
        {!! JsonLd::generate() !!}

        <!--<meta content="" name="Weprokit - Digital Marketing Agency & Business Services">
        <meta content="" name="Weprokit">-->

        <!-- Favicons -->
        <link href="{{asset('assets/images/favicon.ico')}}" rel="icon">

        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />-->
        <link rel="stylesheet" href="{{asset('assets/vendor/lightgallery-2.9.0/package/css/lightgallery-bundle.min.css')}} "/>
        <!-- Google Fonts -->
        <link href=" {{asset('assets/vendor/fontawesome-6.7.2/css/all.min.css')}}" rel="stylesheet" >
        <!-- Main CSS File -->
        <link href="{{asset('assets/stylesheets/styles.css')}}" rel="stylesheet" >

        <!-- LightGallery JS -->
        <script src="{{asset('assets/vendor/lightgallery-2.9.0/package/lightgallery.umd.min.js')}} " deffer></script>
        <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
        <script src="{{ asset('js/visitor-tracker.js') }}"></script>
        <script src="{{ asset('js/social_login.js') }}"></script>
        <script src="{{ asset('assets/javascripts/javascript.js') }}"></script>

    </head>

<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
    <div class="camera-loader">
        <div class="camera-body">
        <div class="camera-lens"></div>
        <div class="camera-flash"></div>
        </div>
    </div>
    </div>
    @include('layouts.header')
     @yield('content')
    @include('layouts.footer')
</body>
</html>
