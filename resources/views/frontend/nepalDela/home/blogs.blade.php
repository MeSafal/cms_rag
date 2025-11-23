<!--blogs-->
@if ($items->isNotEmpty())
    @php
        $parts = splitTitle($title, 2);
    @endphp
    <div class="blog-area pt-120">
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
                    @php
                        $link = dynamicRoute($item, '_self', 'View Detail');
                    @endphp
                    @php $button = $item->buttons->first(); @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item">
                            <div class="blog-item-img">
                                <img src="{{ asset(explode(',', $item->thumb)[0]) }}" alt="Thumb">
                            </div>
                            <div class="blog-item-info">
                                <h4 class="blog-title">
                                    <a href="{{ $link['url'] }}">{{ $item->title }}</a>
                                </h4>
                                {!! Str::words($item->description, 20, ' ....') !!}
                                <a class="theme-btn" href="{{ $link['url'] }}" target="{{ $link['target'] }}">
                                    {{ $link['title'] }} <i class="far fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
