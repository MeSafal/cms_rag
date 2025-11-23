<!--coaching-->
@if ($items->isNotEmpty())
    @php
        $parts = splitTitle($title, 2);
    @endphp
    <div class="coaching-area bg py-120">
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
                    <div class="col-md-6 col-lg-4">
                        <div class="coaching-item">
                            <div class="coaching-img">
                                <img src="{{ asset(explode(',', $item->thumb)[0] ?? null) }}" alt>
                            </div>
                            <div class="coaching-content">
                                <h4><a href="{{ $link['url'] }}">{{ $link['title'] }}</a></h4>
                                {!! Str::words($item->description, 20, ' .....') !!}
                                <a href="{{ $link['url'] }}" target="{{ $link['target'] }}" class="theme-btn">
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
