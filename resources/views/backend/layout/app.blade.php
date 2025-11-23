@php
    use App\Models\Setting;
    $switchState = Setting::where('createdby', Auth::id())->value('switch_state');
    $mode = 'light';
    if ($switchState == 'off') {
        $mode = 'dark';
    }
@endphp
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-bs-theme={{ $mode }} data-body-image="none" data-preloader="disable">


<!-- Mirrored from themesbrand.com/velzon/html/galaxy/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Feb 2025 14:01:04 GMT -->

<head>

    <meta charset="utf-8">
    <title>{{ env('App_name') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link href="{{ asset('backend/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Swiper slider css -->
    <link href="{{ asset('backend/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('backend/js/layout.js') }}"></script>

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Css -->
    <link href="{{ asset('backend/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- usage -->

</head>

<body>
    <div id="layout-wrapper">
        @include('backend.layout.cssSetting')
        @include('backend.layout.header')
        @include('backend.layout.sidebar')
        <div class="main-content">
            <div class="page-content">
                @yield('mainSection')
            </div>

            @include('backend.layout.success')
            @include('backend.layout.footer')
        </div>
    </div>
    <button onclick="topFunction()" class="btn btn-primary btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</body>

</html>
