@foreach ($items as $item)
    <!--about-->
    <div class="about-area py-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left">
                        <div class="about-img">
                            <img src="{{ asset(explode(',', $item->thumb)[0]) }}" alt>
                        </div>
                        <div class="about-experience">
                            <h1>15 <span>+</span></h1>
                            <span class="about-experience-text">Years Experience</span>
                        </div>
                        <div class="about-shape">
                            <img src="assets/img/about/shape.svg" alt>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right">
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline">{{ $item->title }}</span>
                            <h2 class="site-title">{{ $item->subtitle }}</h2>
                        </div>
                        {!! $item->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endforeach
