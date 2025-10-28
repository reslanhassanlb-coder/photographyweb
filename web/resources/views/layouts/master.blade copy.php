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

        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "Photographer",
        "name": "Hassan Reslan Photography",
        "image": "{{ asset('images/home-cover.jpg') }}",
        "url": "https://hassanreslanphotography.com/",
         "telephone": "+96170837485",
        "address": {
            "@type": "PostalAddress",
             "streetAddress": "Zefta main street",
                "addressLocality": "Nabatieh",
                "addressCountry": "LB"
        },
        "openingHours": "Mo,Tu,We,Th,Fr 09:00-20:00",
        "sameAs": [
    "https://www.instagram.com/hassanreslanphotography/",
    "https://www.facebook.com/profile.php?id=100078667700822"
    ],
        "description": "Creative wedding, engagement and family photography based in Nabatieh, Lebanon."
        }
        </script>

        <!--<meta content="" name="Weprokit - Digital Marketing Agency & Business Services">
        <meta content="" name="Weprokit">-->

        <!-- Favicons -->
        <link href="{{asset('assets/images/favicon.ico')}}" rel="icon">


        <!-- Favicons -->
        <link href="{{asset('assets/images/favicon.ico')}}" rel="icon">

        <!-- Vendor CSS Files -->
       <!-- Bootstrap CSS -->
        <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- LightGallery CSS -->
        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />-->
        <link rel="stylesheet" href="{{asset('assets/vendor/lightgallery-2.9.0/package/css/lightgallery-bundle.min.css')}} "/>
        <!-- Google Fonts -->

        <link href=" {{asset('assets/vendor/fontawesome-6.7.2/css/all.min.css')}}" rel="stylesheet" >
        <!-- Main CSS File -->
        <link href="{{asset('assets/stylesheets/styles.css')}}" rel="stylesheet" >

        <!-- Bootstrap JS Bundle -->
        <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" deffer></script>
        <!-- LightGallery JS -->
        <script src="{{asset('assets/vendor/lightgallery-2.9.0/package/lightgallery.umd.min.js')}} " deffer></script>

        <script src="{{ asset('assets/javascripts/main.js') }}" deffer></script>
        <script src="{{ asset('js/visitor-tracker.js') }}"></script>
        <script src="{{ asset('js/social_login.js') }}"></script>
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
