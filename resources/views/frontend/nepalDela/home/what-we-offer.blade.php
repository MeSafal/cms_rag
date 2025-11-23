<!--what we offer-->
@if ($items->isNotEmpty())
    @php
        $parts = splitTitle($title, 2);
    @endphp
    <div class="service-area bg py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">{{ $subtitle }}</span>
                        <h2 class="site-title">{{ $parts[0] }} <span>{{ $parts[1] }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset(explode(',', $item->thumb)[0]) }}" alt>
                            </div>
                            <div class="service-icon">
                                <i class="flaticon-people-1"></i>
                            </div>
                            <div class="service-content">
                                <h4 class="service-title">
                                    <a href="student.php">{{ $item->title }}</a>
                                </h4>
                                <p class="service-text">
                                    {!! Str::words($item->description, 20) !!}
                                </p>
                                <div class="service-arrow">
                                    <!-- <a href="student.php" class="service-read-btn">Learn More<i
                                    class="far fa-arrow-right"></i></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
