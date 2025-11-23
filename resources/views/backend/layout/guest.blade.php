<!doctype html>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Sign In | Visobotics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Visobotics - Sign In" />
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">


    <!-- Layout config Js -->
    <script src="{{ asset('backend/js/layout.js') }}"></script>

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('backend/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Optional custom overrides -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- particles (optional) -->
    <link rel="stylesheet" href="{{ asset('backend/libs/swiper/swiper-bundle.min.css') }}" />


</head>

<body>

    @yield('mainSection')


    <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>

    <script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('backend/libs/feather-icons/feather.min.js') }}"></script>

    <script src="{{ asset('backend/js/plugins.js') }}"></script>

    <!-- particles js (optional visual from theme) -->

    <script src="{{ asset('backend/libs/particles.js/particles.js') }}"></script>

    <script src="{{ asset('backend/js/pages/particles.app.js') }}"></script>

</body>

</html>
