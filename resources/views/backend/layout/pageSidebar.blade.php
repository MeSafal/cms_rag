@php
    use App\Models\Setting;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Template;
    // Get current user setting and parent pages.
    $setting = Setting::where('createdby', Auth::id())->first();
    if (!$setting) {
        $setting = Setting::create([
            'switch_state' => 'on',
            'custom_color' => '#000000',
            'selected_color' => '#530d82',
            'status' => 1,
            'display_order' => 1,
            'createdby' => Auth::id(),
            'updatedby' => Auth::id(),
        ]);
        $setting = Setting::where('createdby', Auth::id())->first();
    }
    $settingArray = $setting->toArray();

    if ($settingArray['custom_color'] != '#000000') {
        $custom_color = $settingArray['custom_color'];
    } else {
        $custom_color = $settingArray['selected_color'];
    }

    // dd($custom_color);
    if ($settingArray['switch_state'] == 'on') {
        $theme_color = '#191C24';
        $dark_color = '#000';
        $head_color = '#FFF';
    } else {
        $theme_color = '#E6E3DB';
        $dark_color = '#f7efef';
        $head_color = '#000';
    }

    function fadeOutColor($hexColor, $alpha = 0.6)
    {
        // Remove the `#` if it exists
        $hexColor = ltrim($hexColor, '#');

        // Split the hex into RGB components
        if (strlen($hexColor) == 6) {
            $r = hexdec(substr($hexColor, 0, 2)); // Red
            $g = hexdec(substr($hexColor, 2, 2)); // Green
            $b = hexdec(substr($hexColor, 4, 2)); // Blue
        } elseif (strlen($hexColor) == 3) {
            // Shortened hex format, e.g., #FFF
            $r = hexdec(str_repeat(substr($hexColor, 0, 1), 2));
            $g = hexdec(str_repeat(substr($hexColor, 1, 1), 2));
            $b = hexdec(str_repeat(substr($hexColor, 2, 1), 2));
        } else {
            // Invalid HEX color
            return null;
        }

        // Return the color as an RGBA string
        return "rgba($r, $g, $b, $alpha)";
    }

    $faded_color = fadeOutColor($custom_color, 0.6);
    $pages = Template::activeStatus()
               ->parentOne()
                ->ordered()
            ->get();
@endphp
@php
    // ... (keep your existing PHP code here) ...
@endphp

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS Files -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        .nav-link-custom {
            flex-shrink: 0;
            /* Prevent items from shrinking */
            color: {{ $custom_color }} !important;
            padding: 0.8rem 1.2rem !important;
            margin: 0 0.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        /* Active nav-link styling */
        .nav-link-custom.active {
            color: {{ $custom_color }};
            background: transparent !important;
            position: relative;
        }

        .nav-link-custom.active::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 1.2rem;
            right: 1.2rem;
            height: 2px;
            background: {{ $faded_color }};
            animation: underlineSlide 0.3s ease;
        }

        @keyframes underlineSlide {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }
    </style>
    <style>
        .nav-glass {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px 0 rgba(68, 3, 115, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-collapse {
            min-width: 0;
            /* Crucial for flex container overflow */
        }

        .nav-scrollable {
            overflow-x: auto;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
            min-width: 0;
            /* Allow container to shrink */
            display: flex !important;
            /* Force flex layout */
            flex-wrap: nowrap;
            /* Prevent line breaks */
        }

        .nav-scrollable::-webkit-scrollbar {
            display: none;
        }

        .nav-link-custom {
            flex-shrink: 0;
            white-space: nowrap;
            /* Ensure text doesn't wrap */
        }

        .nav-link-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .nav-link-custom.active {
            background: {{ $faded_color }} box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        /* Custom hamburger color */
        .navbar-toggler-icon-custom {
            color: {{ $custom_color }} !important;
            font-size: 1.8rem;
        }

        @media (max-width: 991.98px) {
            .nav-scrollable {
                display: none;
            }

            .mobile-menu {
                position: fixed;
                top: 70px;
                right: 20px;
                background: {{ $custom_color }};
                border-radius: 16px;
                padding: 1rem;
                min-width: 200px;
                max-height: calc(100vh - 100px);
                /* Enable vertical scroll */
                overflow-y: auto;
                /* Add vertical scrolling */
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                z-index: 1000;
            }

            /* Ensure mobile menu is visible when .show is added */
            .mobile-menu.show {
                display: block;
            }

            .mobile-menu .nav-link {
                color: {{ $theme_color == '#191C24' ? '#fff' : '#000' }} !important;
            }
        }

        .spacing {
            height: 60px;
        }


        .custom-svg {
            width: 30px;
            height: 30px;
            filter: brightness(0) saturate(100%) invert(17%) sepia(46%) saturate(5325%) hue-rotate(267deg) brightness(80%) contrast(115%)
        }

        @media (min-width: 992px) {

            /* Optional: if you need more brand section width */
            .navbar>.container-fluid {
                flex-wrap: nowrap;
            }

            .navbar-brand-section {
                min-width: 300px;
            }
        }

        @media (max-width: 991.98px) {
            .mobile-menu .nav-link.active {
                position: relative;
                color: {{ $theme_color == '#191C24' ? '#fff' : '#000' }} !important;
            }

            .mobile-menu .nav-link.active::after {
                content: '';
                position: absolute;
                bottom: 8px;
                left: 1rem;
                right: 7rem;
                height: 2px;
                background: {{ $theme_color == '#191C24' ? '#fff' : '#000' }};
                animation: underlineSlide 0.3s ease;
            }
        }

        @keyframes underlineSlide {
            from {
                width: 0;
            }

            to {
                width: calc(100% - 15rem);
            }

        }

        .hidden-nav {
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .show-nav {
            transform: translateY(0);
            transition: transform 0.3s ease-in-out;
            /* Smooth transition */
        }
    </style>
</head>

<body>
    @php $route = 'pages.index'; @endphp
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg nav-glass fixed-top py-2" id="nav-glass">
        <div class="container-fluid">
            <!-- Wrap brand section in a div -->
            <div class="navbar-brand-section d-flex align-items-center">

                @can($route)
                    <h3 style="color: {{ $custom_color }};">
                        <a href="{{ route($route) }}" style="text-decoration: none; color: inherit;">
                            <img src="{{ asset('img/favicon.svg') }}" alt="Favicon" class="custom-svg">
                            {{ label('Visobotics') }}
                        </a>
                    </h3>
                @else
                    <h3 style="color: {{ $custom_color }};">
                        <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">
                            <img src="{{ asset('img/favicon.svg') }}" alt="Favicon" class="custom-svg">
                            {{ label('Visobotics') }}
                        </a>
                    </h3>
                @endcan
                <div class="d-none d-lg-flex align-items-center ms-4 border-start ps-4">
                    <img class="user-avatar" src="{{ asset($setting->profile_image ?? 'img/user.jpg') }}"
                        alt="User">
                    <div class="ms-3">
                        <p style="color:{{ $custom_color }};" class="mb-0 small">{{ Auth::user()->name }}</p>
                        <span style="color:{{ $custom_color }};" class="small">
                            @if (Auth::user()->roles->isNotEmpty())
                                {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                            @else
                                Normal User
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Hamburger Menu with Custom Color -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav"
                aria-controls="mobileNav">
                <i class="bi bi-list navbar-toggler-icon-custom"></i>
            </button>

            <!-- Desktop Navigation -->
            <div class="collapse navbar-collapse">
                <div class="d-flex nav-scrollable flex-grow-1">

                    @php $route = 'pages.view'; @endphp
                    @can($route)
                        @foreach ($pages as $page)
                            <a href="{{ route('templates.editVisually', ['id' => $page->templates_id]) }}"
                                class="nav-link nav-link-custom {{ Request::is('pages/view/' . $page->alias) ? 'active' : '' }}">
                                <i class="bi bi-window me-2"></i>{{ label($page->title) }}
                            </a>
                        @endforeach
                    @endcan
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu collapse" id="mobileNav">
        <div class="d-flex flex-column">
            <div class="px-3 py-2 text-white">
                <img class="user-avatar mb-2" src="{{ asset($setting->profile_image ?? 'img/user.jpg') }}"
                    alt="User">
                <p class="mb-0">{{ Auth::user()->name }}</p>
                <small class="text-white-50">
                    @if (Auth::user()->roles->isNotEmpty())
                        {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                    @else
                        Normal User
                    @endif
                </small>
            </div>
            <hr class="text-white-50 mx-3 my-2">
            @php $route = 'pages.index'; @endphp
            @can($route)
                <a href="{{ route($route) }}" class="nav-link py-2 px-3">
                    <i class="bi bi-speedometer2 me-2"></i>{{ label('Main Menu') }}
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="nav-link py-2 px-3">
                    <i class="bi bi-speedometer2 me-2"></i>{{ label('Main Menu') }}
                </a>
            @endcan

            @php $route = 'pages.view'; @endphp
            @can($route)
                @foreach ($pages as $page)
                    <a href="{{ route('pages.view', $page->alias) }}"
                        class="nav-link py-2 px-3 {{ Request::is('pages/view/' . $page->alias) ? 'active' : '' }}">
                        <i class="bi bi-window me-2"></i>{{ label($page->title) }}
                    </a>
                @endforeach
            @endcan
        </div>
    </div>

    <div class="spacing"></div>

    <script>
        // Mobile menu toggle animation
        const mobileMenu = document.getElementById('mobileNav');
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
            mobileMenu.classList.toggle('show');
        });
    </script>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var lastScrollTop = 0;
        var $nav = $('#nav-glass');
        var scrollThreshold = 50;
        var scrollDelta = 100; // Minimum movement required to toggle navbar

        $(window).on('scroll', function() {
            var currentScroll = $(this).scrollTop();
            var scrollDifference = Math.abs(currentScroll -
            lastScrollTop); // Get absolute scroll difference

            if (scrollDifference < scrollDelta) {
                return; // Ignore small scroll movements
            }

            if (currentScroll > lastScrollTop && currentScroll > scrollThreshold) {
                // Scrolling down - Hide the navbar smoothly
                if (!$nav.hasClass('hidden-nav')) {
                    $nav.removeClass('show-nav').addClass('hidden-nav');
                }
            } else if (currentScroll < lastScrollTop) {
                // Scrolling up - Show the navbar smoothly
                if ($nav.hasClass('hidden-nav')) {
                    $nav.removeClass('hidden-nav').addClass('show-nav');
                }
            }

            lastScrollTop = currentScroll;
        });
    });
</script>
