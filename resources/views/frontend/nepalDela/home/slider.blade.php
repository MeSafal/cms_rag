@if ($items->isNotEmpty())
    <div class="hero-section hero-slider owl-carousel owl-theme">
        <!-- Slide 1 -->
        @foreach ($items as $item)
            @php
                $parts = splitTitle($item->title, 3);
        $link = dynamicRoute($item, '_self', 'View Detail');
            @endphp
            <div class="hero-single" style="background-image: url({{ asset(explode(',', $item->cover)[0]) }});">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-7 col-lg-7">
                            <div class="hero-content">
                                <h6 class="hero-sub-title wow animate__animated animate__fadeInUp" data-wow-duration="1s"
                                    data-wow-delay=".50s">{{ $item->subtitle }}</h6>
                                <h1 class="hero-title wow animate__animated animate__fadeInUp" data-wow-duration="1s"
                                    data-wow-delay=".50s">
                                    {{ $parts[0] }} <span>{{ $parts[1] }}</span> {{ $parts[2] }}
                                </h1>
                                <p class="wow animate__animated animate__fadeInUp" data-wow-duration="1s"
                                    data-wow-delay=".75s">
                                    {{ $item->remarks }} </p>
                                <div class="hero-btn wow animate__animated animate__fadeInUp" data-wow-duration="1s"
                                    data-wow-delay="1s">
                                    <a href="{{ $link['url'] }}" target="{{ $link['target'] }}" class="theme-btn">{{ $link['title'] }}<i class="far fa-arrow-right"></i></a>
                                    <!-- <a href="about.php" class="theme-btn theme-btn2">About Us<i class="far fa-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
