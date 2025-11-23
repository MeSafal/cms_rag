<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content>
    <meta name="keywords" content>

    <title>{{ appName() }}</title>

    <link rel="icon" type="image/x-icon" href="{{ favicon() }}">

    <link rel="stylesheet" href="{{ asset('assets/nepaldela/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/nepaldela/assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/nepaldela/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/nepaldela/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/nepaldela/assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/nepaldela/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/nepaldela/assets/css/style.css') }}">

</head>

<body>

    {{-- <div class="preloader">
        <div class="loader">
            <div class="loader-box-1"></div>
            <div class="loader-box-2"></div>
        </div>
    </div> --}}

    @php

        use App\Helpers\CMS_FMS;

        $cms = new CMS_FMS();

        $navMenus = $cms->getMenuItemsByLocation(1);
        // dd($navMenus[1]->childrenItem[0]->url);
    @endphp

    <header class="header">
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                        <img style="max-height: 90px; width:auto;" src="{{ favicon() }}" alt="logo"
                            style="margin-left:50px">
                    </a>
                    <div class="mobile-menu-right">
                        <a href="#" class="mobile-search-btn search-box-outer"><i class="far fa-search"></i></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="far fa-stream"></i></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav ms-auto">
                            @foreach ($navMenus as $nav)
                                @if ($nav->childrenItem->isNotEmpty())
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                            data-bs-toggle="dropdown">
                                            {{ $nav->title }}
                                        </a>
                                        <ul class="dropdown-menu fade-up">
                                            @foreach ($nav->childrenItem as $child)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ $child->url }}">{{ $child->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ $nav->url }}">{{ $nav->title }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Test
                                    Preparation</a>
                                <ul class="dropdown-menu fade-up">
                                    <li><a class="dropdown-item" href="ielts.php">IELTS</a></li>
                                    <li><a class="dropdown-item" href="toefl.php">TOEFL</a></li>
                                    <li><a class="dropdown-item" href="pte.php">PTE</a></li>
                                    <li><a class="dropdown-item" href="cae.php">CAE</a></li>
                                    <li><a class="dropdown-item" href="gre.php">SAT</a></li>
                                    <li><a class="dropdown-item" href="gre.php">GRE</a></li>
                                    <li><a class="dropdown-item" href="gmat.php">GMAT</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Country</a>
                                <ul class="dropdown-menu fade-up">
                                    <li><a class="dropdown-item" href="us.php">United States</a></li>
                                    <li><a class="dropdown-item" href="uk.php">United Kingdom</a></li>
                                    <li><a class="dropdown-item" href="australia.php">Australia</a></li>
                                    <li><a class="dropdown-item" href="newzealand.php">New Zealand</a></li>
                                    <li><a class="dropdown-item" href="japan.php">Japan</a></li>
                                    <li><a class="dropdown-item" href="canada.php">Canada</a></li>
                                    <li><a class="dropdown-item" href="ireland.php">Ireland</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Language</a>
                                <ul class="dropdown-menu fade-up">
                                    <li><a class="dropdown-item" href="english.php">English</a></li>
                                    <li><a class="dropdown-item" href="japnese.php">Japanese</a></li>
                                    <li><a class="dropdown-item" href="german.php">German</a></li>
                                    <li><a class="dropdown-item" href="french.php">French</a></li>
                                    <li><a class="dropdown-item" href="korean.php">Korean</a></li>
                                    <!-- <li><a class="dropdown-item" href="transit.php">Chinese</a></li> Optional
                                    <li><a class="dropdown-item" href="migrate.php">Spanish</a></li> Optional
                                    <li><a class="dropdown-item" href="diplomatic.php">Arabic</a></li> Optional -->
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li> --}}
                        </ul>
                        <div class="header-nav-right">
                            <div class="header-btn">
                                <a href="contact.php" class="theme-btn">Contact Us<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>


    <main class="main">
