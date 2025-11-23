@if ($items->isNotEmpty())
    @foreach ($items as $item)
    @php
        $link = dynamicRoute($item);
    @endphp
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
                            {!! Str::words($item->description, 50, ' ...') !!}
                        </div>
                        <a href="{{$link['url']  }}" class="theme-btn" target="{{$link['target']}}">{{$link['title']}} <i
                                class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
@endif
